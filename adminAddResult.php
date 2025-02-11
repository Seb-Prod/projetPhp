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

$upload_dir = "img2/";
$max_file_size = 5 * 1024 * 1024; // 5 MB
$allowed_types = ['image/jpeg', 'image/png', 'image/webp'];

if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

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
varDump($_POST);
echo "ok";



// Fonction de validation et upload d'image
function handleImageUpload($file, $upload_dir) {
    global $max_file_size, $allowed_types;
    
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'error' => 'Erreur lors du téléversement'];
    }
    
    if ($file['size'] > $max_file_size) {
        return ['success' => false, 'error' => 'Fichier trop volumineux'];
    }
    
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    if (!in_array($mime_type, $allowed_types)) {
        return ['success' => false, 'error' => 'Type de fichier non autorisé'];
    }
    
    $filename = time() . '_' . basename($file['name']);
    $filepath = $upload_dir . $filename;
    
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        return ['success' => true, 'path' => $filepath];
    }
    
    return ['success' => false, 'error' => 'Erreur lors de la sauvegarde'];
}

// Traitement de l'image principale
if (isset($_FILES['imageAccueil'])) {
    $result = handleImageUpload($_FILES['imageAccueil'], $upload_dir);
    if (!$result['success']) {
        die($result['error']);
    }
    $main_image_path = $result['path'];
}

// Traitement des images de galerie
$gallery_images = [];
if (isset($_FILES['imagesGalerie'])) {
    foreach ($_FILES['imagesGalerie']['tmp_name'] as $key => $tmp_name) {
        if ($_FILES['imagesGalerie']['error'][$key] === UPLOAD_ERR_OK) {
            $file = [
                'name' => $_FILES['imagesGalerie']['name'][$key],
                'type' => $_FILES['imagesGalerie']['type'][$key],
                'tmp_name' => $tmp_name,
                'error' => $_FILES['imagesGalerie']['error'][$key],
                'size' => $_FILES['imagesGalerie']['size'][$key]
            ];
            
            $result = handleImageUpload($file, $upload_dir);
            if ($result['success']) {
                $gallery_images[] = $result['path'];
            }
        }
    }
}


function varDump($var){
echo '<pre>';
var_dump($var);
echo '</pre>';
}