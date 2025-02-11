<?php
// démarage de la session
session_start();

// Connection à la base de données
define('SECURE_ACCESS', true);
require_once 'config.php';

// Inportation des fonctions
require_once 'functions/functionsUser.php';
$pdo = getDBConnection();

// Fonction qui retourne à la page de log
function returnLogIn()
{
    header("Location:logIn.php?newUser=true");
    exit();
}

// Fonction qui retourne à la page index
function returnIndex(){
    header("Location:index.php");
    exit();
}

// Initialisation des variables;
$requiredFieldsNewUser = ['pseudo', 'pass', 'nom', 'prenom', 'confirmPass'];
$requiredFieldsConect = ['pseudo', 'pass'];
$pseudo = null;
$nom = null;
$prenom = null;
$pass = null;
$confirmPass = null;
$admin = null;

// Affectation des valeurs
function setValues()
{
    global $pseudo, $pass;
    $pseudo = htmlspecialchars($_POST["pseudo"]);
    $pass = $_POST["pass"];
}

// Affectation des valeurs suplémentaire (new User)
function setValuesNewUser()
{
    global $nom, $prenom, $confirmPass, $admin;
    setValues();
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $confirmPass = $_POST["confirmPass"];
    $admin = password_verify("true", $_POST["admin"]);
}

// Vérification de la présence des champs
function checkRequiredFields($requiredFields)
{
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
            return false;
        }
    }
    return true;
}

// Gestion erreur de pseudo déjà existant
function errorUserExist()
{
    global $nom, $prenom;
    $_SESSION["newUser_errorPseudo"] = "Le pseudo existe déjà";
    $_SESSION["newUser_nom"] = $nom;
    $_SESSION["newUser_prenom"] = $prenom;
    returnLogIn();
}

// Gestion correspondance mot de passe et confirmation mot de passe
function errorPass()
{
    global $nom, $prenom, $pseudo;
    $_SESSION["newUser_errorPass"] = "Les mots de passe doivent être identiques";
    $_SESSION["newUser_pseudo"] = $pseudo;
    $_SESSION["newUser_nom"] = $nom;
    $_SESSION["newUser_prenom"] = $prenom;
    returnLogIn();
}

// Gestion erreur de BDD
function error(){
    $_SESSION["newUser_errorPseudo"] = "Une erreur avec la BDD s'est produite";
    returnLogIn();
}

// Gestion erreur de connection user
function errorUser(){
    $_SESSION["newUser_errorPseudo"] = "Pseudo ou mot de passe incorect";
    header("Location:logIn.php");
    exit();
}

// Ajout d'un user
if (checkRequiredFields($requiredFieldsNewUser)) {
    setValuesNewUser();
    // Vérifiaction si le pseudo existe déja
    if (userExist($pdo, $pseudo)) {
        errorUserExist();
    }
    // Vérification si les mots de passe sont identique
    if ($pass === $confirmPass) {
        $isAdmin = 0;
        
        //Vérification si création d'un compte admin
        if(isset($_SESSION['newUser_admin'])){
            $isAdmin = 1;
        }

        $message = addUser($pdo, $pseudo, $nom, $prenom, $pass, $isAdmin);
        unset($_SESSION['newUser_admin']);
        
        // Si une erreur est arrivé
        if(is_string($message) or $message = false){
            error();
        }else{
            returnIndex();
        }
    } else {
        errorPass();
    }
}

// Connection
if (checkRequiredFields($requiredFieldsConect)) {
    setValues();
    $message = userConect($pdo, $pseudo, $pass);
    // Si une erreur est arrivé
    if(is_string($message)){
        error();
    }elseif($message){
        returnIndex();
    }else{
        errorUser();
    }
}


