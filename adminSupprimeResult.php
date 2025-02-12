<?php
// démarage de la session
session_start();

// Connection à la base de données
define('SECURE_ACCESS', true);
require_once 'config.php';
require_once 'functions/functionsAdmin.php';
$pdo = getDBConnection();

// Vérification si est admin
if ($_SESSION["admin"] === 1) {
} else {
    header("Location:index.php");
    exit();
}

if(isset($_POST['id']) and $_POST['id'] !=""){
    $id = intval($_POST['id']);
    deleteVoiture($pdo, $id);
    header("Location:admin.php");
    exit();
}

?>