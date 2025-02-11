<?php
// Connection à la base de données
define('SECURE_ACCESS', true);
require_once 'config.php';

// Inportation des fonctions
require_once 'functions/functionsAdmin.php';
$pdo = getDBConnection();


// Initialisation des variables
$model = null;
$marque = null;
$type = null;
$date = null;
$description = null;
$motorisations = [];
$prixMotorisations = [];
$couleurs = [];
$prixCouleurs = [];
$jantes = [];
$prixJantes = [];

// Champs attendu
$requiredFields = ['model', 'marque', 'type', 'date', 'description', 'motorisation', 'prixMotorisation', 'couleur', 'prixCouleur', 'jante', 'prixJante'];
// Affectation des valeurs
function setValues()
{
    global $model, $marque, $type, $date, $description, $motorisations, $prixMotorisations, $couleurs, $prixCouleurs, $jantes, $prixJantes;
    $model = htmlspecialchars($_POST["model"]);
    $marque = filter_input(INPUT_POST, 'marque', FILTER_VALIDATE_INT);
    $type = filter_input(INPUT_POST, 'type', FILTER_VALIDATE_INT);
    $date = htmlspecialchars($_POST["date"]);
    $description = htmlspecialchars($_POST["description"]);
    $motorisations = $_POST['motorisation'] ?? [];
    $prixMotorisations = $_POST['prixMotorisation'] ?? [];
    $couleurs = $_POST['couleur'] ?? [];
    $prixCouleurs = $_POST['prixCouleur'] ?? [];
    $jantes = $_POST['jante'] ?? [];
    $prixJantes = $_POST['prixJante'] ?? [];
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

if ($requiredFields) {
    setValues();
    varDump($_POST);
    $message = ajoutVoiture($pdo, $model, $type, $marque, $description, $date);
    if($message['sucess']){
        $idVoiture = intval($message['value']);
        // ajout des motorisations
        foreach($motorisations as $key => $value){
            ajoutOptionVoiture($pdo, 'voitures_moteurs', $idVoiture, 'id_moteur', $key, $prixMotorisations[$key]);
        }
        // ajout des couleurs
        foreach($couleurs as $key => $value){
            ajoutOptionVoiture($pdo, 'voitures_couleurs', $idVoiture, 'id_couleur', $key, $prixCouleurs[$key]);
        }
        // ajout des jantes
        foreach($jantes as $key => $value){
            ajoutOptionVoiture($pdo, 'voitures_jantes', $idVoiture, 'id_jante', $key, $prixJantes[$key]);
        }
    }
    
}




function varDump($var){
echo '<pre>';
var_dump($var);
echo '</pre>';
}