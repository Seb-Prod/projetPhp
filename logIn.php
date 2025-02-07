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
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<!-- Fin du contenu de la page -->
<?php
require_once 'includes/footer.php';
?>