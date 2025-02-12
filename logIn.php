<?php
// Initialisation des variable
$pageTitle = "Model de page vierge";
$cardTitle = "Se connecter";
$nom = null;
$prenom = null;
$pseudo = null;
$newUser = false;

// Inportation du header
require_once 'includes/header.php';


//Initialisation des variable de session
unset($_SESSION['newUser_admin']);
if(isset($_SESSION["newUser_nom"])){
    $nom = $_SESSION["newUser_nom"];
}
if(isset($_SESSION["newUser_prenom"])){
    $prenom = $_SESSION["newUser_prenom"];
}
if(isset($_SESSION["newUser_pseudo"])){
    $pseudo= $_SESSION["newUser_pseudo"];
}


// Connection à la base de données
define('SECURE_ACCESS', true);
require_once 'config.php';

require_once 'functions/functionsUser.php';
$pdo = getDBConnection();
$nbUsers = getUserCount($pdo);

// Si aucun user on créer un compte Admin
if ($nbUsers == 0) {
    $cardTitle = "Créer le compte Administrateur";
    $newUser = true;
    $_SESSION["newUser_admin"] = true;
}

// Si argument newUser === true' en GET
if (isset($_GET["newUser"]) and $_GET["newUser"] === "true") {
    $cardTitle = "Créer un compte";
    $newUser = true;
}


if (isset($_GET["message"]) and $_GET["message"] != '') {
    $message = $_GET["message"];
}





?>
<!-- Début du contenu de la page -->
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card container d-flex justify-content-center align-items-center" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"><?php echo $cardTitle ?></h5>
            <form action="logInResult.php" method="post">
                <!-- Pseudo -->
                <?php if (isset($_SESSION["newUser_errorPseudo"])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION["newUser_errorPseudo"] ?>
                    </div>
                <?php endif ?>
                <div class="form-group mb-1">
                    <label class="form-label" for="inputPseudo">Pseudo</label>
                    <input id="inputPseudo" class="form-control" type="text" name="pseudo" required value="<?php echo $pseudo ?>"/>
                </div>

                <?php if ($newUser) : ?>
                    <!-- Nom -->
                    <div class="form-group mb-1">
                        <label class="form-label" for="inputNom">Nom</label>
                        <input id="inputNom" class="form-control" type="text" name="nom" required value="<?php echo $nom ?>" />
                    </div>
                    <!-- Prénom -->
                    <div class="form-group mb-1">
                        <label class="form-label" for="inputPrenom">Prénom</label>
                        <input id="inputPrenom" class="form-control" type="text" name="prenom" required value="<?php echo $prenom ?>"/>
                    </div>
                <?php endif ?>

                <!-- Mot de passe -->
                <?php if (isset($_SESSION["newUser_errorPass"]))  : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION["newUser_errorPass"] ?>
                    </div>
                <?php endif ?>
                <div class="form-group mb-1">
                    <label class="form-label" for="inputPass">Mot de passe</label>
                    <input id="inputPass" class="form-control" type="password" name="pass" required />
                </div>

                <?php if ($newUser) : ?>
                    <!-- Confimation du mot de passe -->
                    <div class="form-group mb-1">
                        <label class="form-label" for="inputConfirmPass">Confirmer le mot de passe</label>
                        <input id="inputConfirmPass" class="form-control" type="password" name="confirmPass" required />
                    </div>
                <?php endif ?>

                <div class="mb-1">
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>

                <?php if (!$newUser) : ?>
                    <div class="mb-1">
                        <a href="logIn.php?newUser=true">Créer un compte</a>
                    </div>
                <?php endif ?>
            </form>
        </div>
    </div>
</div>

<!-- Fin du contenu de la page -->
<?php
razLogIn();
require_once 'includes/footer.php';
?>