<?php
$pageTitle = "Page Admin";
require_once 'includes/header.php';
require_once 'functions/functionsAdmin.php';

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
<div class="container d-flex flex-column justify-content-center align-items-center vh-100">
    <div class="card p-4 border admin bg-light">
        <h4 class="card-title text-center">Admin</h4>
        <div class="form-group mb-2">
            <a class="btn btn-primary w-100" href="adminAdd.php" role="button">Ajout d'un nouveau model</a>
        </div>
        <div class="form-group mb-2">
            <button class="btn btn-warning dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                <span>Choisir les models à modifier</span>
            </button>
            <ul class="dropdown-menu">
                <?php foreach ($models as $model) : $nom = $model['nom_marque'] . ' ' .  $model['nom_voiture']; ?>
                    <li>
                        <a class="dropdown-item" href="adminEdit.php?id=<?php echo $model['ID'] ?>&model=<?php echo $model['nom_voiture'] ?>&marque=<?php echo $model['nom_marque'] ?>"><?php echo $nom ?></a>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
        <div class="form-group">
            <button class="btn btn-danger dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                <span>Choisir les models à supprimer</span>
            </button>
            <ul class="dropdown-menu">
                <?php foreach ($models as $model) : $nom = $model['nom_marque'] . ' ' .  $model['nom_voiture']; ?>
                    <li>
                        <a class="dropdown-item" href="adminSupprime.php?id=<?php echo $model['ID'] ?>&model=<?php echo $model['nom_voiture'] ?>&marque=<?php echo $model['nom_marque'] ?>"><?php echo $nom ?></a>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</div>



<!-- Fin du contenu de la page -->
<?php
require_once 'includes/footer.php';
?>