<?php

$pageTitle = "Model de page vierge";
require_once 'includes/header.php';
define('SECURE_ACCESS', true);
require_once 'config.php';
// Se connecter à la base de données
$pdo = getDBConnection();

// Vérifier la connexion
if ($pdo) {
    echo "Connexion réussie à la base de données !";
}
?>
<!-- Début du contenu de la page -->

<div>
    <p>Identifier vous ou créer un compte</p>
    <form action="logIn.php" method="post">
        <label for="email">Saisissez votre e-mail</label>
        <input type="email" id="email" name="email">
        <input type="submit" value="Continuer">
    </form>
</div>

<!-- Fin du contenu de la page -->
<?php
require_once 'includes/footer.php';
?>