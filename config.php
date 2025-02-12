<?php
// Empêcher l'accès direct au fichier
if (!defined('SECURE_ACCESS')) {
    die('Accès interdit');
}

// Configuration de la base de données
define('DB_HOST', 'localhost'); // Adresse du serveur
define('DB_USER', 'root');      // Nom d'utilisateur MySQL
define('DB_PASS', 'root'); // Mot de passe
define('DB_NAME', 'base_voiture');   // Nom de la base de données

// Fonction pour se connecter à la base de données
function getDBConnection() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        return new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        //header("Location:index.php");
        //exit();
        die("Erreur de connexion : " . $e->getMessage());
    }
}
?>