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

// Vérification de la présence des champs
function checkRequiredFields($requiredFields)
{
    foreach ($requiredFields as $field) {
        if (!isset($_GET[$field]) || empty(trim($_GET[$field]))) {
            return false;
        }
    }
    return true;
}


if (checkRequiredFields(['id', 'model'], 'marque')) {
    $model = $_GET['marque'] . ' ' . $_GET['model'];
    $id = $_GET['id'];
} else {
    $model = "";
}

?>
<!-- Début du contenu de la page -->
<div class="d-flex justify-content-center align-items-center">
    <div class="card container d-flex justify-content-center align-items-center bg-light border login ">
        <div class="card-body">
            <h5 class="card-title">Supprimer les "<b><?php echo $model ?></b>" de la BDD</h5>
            <div class="form-group mb-1">
                <form action="adminSupprimeResult.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <button type="submit" class="btn btn-danger">Oui</button>
                    <a class="btn btn-success" href="admin.php" role="button">Non</a>
                </form>
            </div>


        </div>
    </div>
</div>


<!-- Fin du contenu de la page -->
<?php
require_once 'includes/footer.php';
?>