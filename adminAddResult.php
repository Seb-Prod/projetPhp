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
$prixMotorisation = [];

// Champs attendu
$requiredFields = ['model', 'marque', 'type', 'date', 'description'];
// Affectation des valeurs
function setValues()
{
    global $model, $marque, $type, $date, $description, $motorisations, $prixMotorisations;
    $model = htmlspecialchars($_POST["model"]);
    $marque = filter_input(INPUT_POST, 'marque', FILTER_VALIDATE_INT);
    $type = filter_input(INPUT_POST, 'type', FILTER_VALIDATE_INT);
    $date = htmlspecialchars($_POST["date"]);
    $description = htmlspecialchars($_POST["description"]);
    $motorisations = $_POST['motorisation'] ?? [];
    $prixMotorisations = $_POST['prix'] ?? [];
    var_dump($motorisations);
    var_dump($prixMotorisations);
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
    ajoutVoiture($pdo, $model, $type, $marque, $description, $date);
}
