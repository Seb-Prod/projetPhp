<?php
// Connection à la base de données
define('SECURE_ACCESS', true);
require_once 'config.php';

// Inportation des fonctions
require_once 'functions/functionsAdmin.php';
$pdo = getDBConnection();


// Champs attendu pour l'ajout d'un nouveau model
$requiredFields = ['model', 'marque', 'type', 'date', 'description'];

// Initialisation des variables
$model = null;
$marque = null;
$type = null;
$date = null;
$description = null;

$max_file_size = 1 * 1024 * 1024; // 5 MB
$allowed_types = ['image/jpeg', 'image/png', 'image/webp'];




// Affectation des valeurs
function setValuesAddCar()
{
    global $model, $marque, $type, $date, $description;
    $model = htmlspecialchars($_POST["model"]);
    $marque = filter_input(INPUT_POST, 'marque', FILTER_VALIDATE_INT);
    $type = filter_input(INPUT_POST, 'type', FILTER_VALIDATE_INT);
    $date = htmlspecialchars($_POST["date"]);
    $description = htmlspecialchars($_POST["description"]);
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

// Ajout d'une voiture
function addNewCar()
{
    global $requiredFields, $pdo, $model, $type, $marque, $description, $date;
    if ($requiredFields) {
        setValuesAddCar();
        $message = ajoutVoiture($pdo, $model, $type, $marque, $description, $date);
        if ($message['sucess']) {
            $idVoiture = intval($message['value']);
            addOptions($idVoiture, ['motorisation', 'prixmotorisation'], 'voitures_moteurs', 'id_moteur');
            addOptions($idVoiture, ['couleur', 'prixmouleur'], 'voitures_couleur', 'id_couleur');
            addOptions($idVoiture, ['jante', 'prixjante'], 'voitures_jantes', 'id_jante');
            addImages($idVoiture);
        }
    }
    header("Location:adminAdd.php");
    exit();
}

// Ajout des options
function addOptions($idVoiture, $requiredFields, $table, $champs)
{
    global $pdo;
    if ($requiredFields) {
        $items = $_POST[$requiredFields[0]] ?? [];
        $prixItems = $_POST[$requiredFields[1]] ?? [];
        foreach ($items as $key => $value) {
            ajoutOptionVoiture($pdo, $table, $idVoiture, $champs, $key, $prixItems[$key]);
        }
    }
}

// Ajout des images
function addImages($idVoiture)
{
    global $pdo;
    if (isset($_FILES['imagesGalerie'])) {
        echo "ajout d'image";
        foreach ($_FILES['imagesGalerie']['tmp_name'] as $key => $tmp_name) {
            if ($_FILES['imagesGalerie']['error'][$key] === UPLOAD_ERR_OK) {
                $file = [
                    'name' => $_FILES['imagesGalerie']['name'][$key],
                    'type' => $_FILES['imagesGalerie']['type'][$key],
                    'tmp_name' => $tmp_name,
                    'error' => $_FILES['imagesGalerie']['error'][$key],
                    'size' => $_FILES['imagesGalerie']['size'][$key]
                ];
                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $newFileName = uniqid('image_', true) . '.' . $extension;
                $destination = "img/" . $newFileName;


                // déplacement de l'image dans le répertoire
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    $message = ajoutPhoto($pdo, $newFileName);
                    if ($message['sucess']) {
                        $idPhoto = intval($message['value']);
                        ajoutPhotoVoiture($pdo,$idVoiture, $idPhoto);
                    }
                    varDump($message);
                }
            }
        }
    }
}


addNewCar();






function varDump($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}
