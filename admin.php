<?php
$pageTitle = "Page Admin";
require_once 'includes/header.php';

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

$theme = "light";
if (isset($_SESSION['theme']) and $_SESSION["theme"] != "") {
    $theme = $_SESSION["theme"];
}


$voitures = getVoitures($pdo);

if ($voitures['success']) {
    $models = $voitures['data']["items"];
}

?>
<!-- Début du contenu de la page -->
<div class="card container p-1" data-bs-theme="<?php echo $theme ?>">
    <div class="card-body">
        <h4 class="card-title">Admin</h4>
        <div class="form-group mb-1">
            <a class="btn btn-primary" href="adminAdd.php" role="button">Ajout d'un nouveau model</a>
        </div>
        <div class="form-group">
            <div class="dropdown">
                <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <span>Choisir les models à modifier</span>
                </button>
                <ul class="dropdown-menu">
                    <?php foreach ($models as $model) : $nom = $model['nom_marque'] . ' ' .  $model['nom_voiture']; ?>
                        <li>
                            <a class="dropdown-item" href="adminSupprime.php?id=<?php echo $model['ID'] ?>&model=<?php echo $nom ?>"><?php echo $nom ?></a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
        <div class="form-group">
            <div class="dropdown">
                <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <span>Choisir les models à supprimer</span>
                </button>
                <ul class="dropdown-menu">
                    <?php foreach ($models as $model) : $nom = $model['nom_marque'] . ' ' .  $model['nom_voiture']; ?>
                        <li>
                            <a class="dropdown-item" href="adminSupprime.php?id=<?php echo $model['ID'] ?>&model=<?php echo $nom ?>"><?php echo $nom ?></a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>


</div>
</div>



<!-- Fin du contenu de la page -->
<?php
require_once 'includes/footer.php';
?>