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


require_once 'functions/functionsAdmin.php';


// Fonction qui check la présence des champs
function checkRequiredFields($requiredFields)
{
    foreach ($requiredFields as $field) {
        if (!isset($_GET[$field]) || empty(trim($_GET[$field]))) {
            return false;
        }
    }
    return true;
}

//Initatilsation des variables
$couleurs = [];
$jantes = [];
$motorisation = [];
$description = null;

function chargeItemBdd($item)
{
    global $pdo;
    $items = getItem($pdo, $item);
    $itemCount = $items['data']['total'];

    //On remplie avec les valeurs
    if ($itemCount > 0) {
        $return = $items['data']['noms'];
        return $return;
    }
}

function genererBlocSelection($titre, $elements, $elementsAssocies, $type)
{
    echo '<div class="col">';
    echo '<div class="card container p-3 admin">';
    echo "<h6 class='card-title'>$titre</h6>";

    foreach ($elements as $key => $value) {
        $checked = '';
        $prix = '0';

        foreach ($elementsAssocies as $elementAssocie) {
            if ($elementAssocie["id_$type"] == $key) {
                $checked = 'checked';
                $prix = $elementAssocie['prix'];
                break;
            }
        }

        echo '<div class="form-check d-flex">';
        echo "<input class='form-check-input me-2' type='checkbox' id='{$titre}$key' name='{$type}[$key]' value='$key' $checked>";
        echo "<label class='form-check-label' for='{$titre}$key'>$value</label>";
        echo '</div>';
        echo '<div class="form-group mb-2 d-flex align-items-center">';
        echo "<input class='form-control' type='number' name='prix{$type}[$key]' value='$prix' min='0'>";
        echo '<span class="ms-2">€</span>';
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
}







// Si les champs sont présents
if (checkRequiredFields(['id', 'model', 'marque'])) {
    $model = $_GET['model'];
    $marque = $_GET['marque'];
    $id = $_GET['id'];

    $couleurs = chargeItemBdd("couleurs");
    $jantes = chargeItemBdd("jantes");
    $motorisation = chargeItemBdd("moteurs");
    
    $requetteDescription = getDescription($pdo, $id);
    if($requetteDescription['success']){
        $description = $requetteDescription['data'][0]["description"];
    }


    $requetteMoteursAssocies = getItemAndPrice($pdo, "voitures_moteurs", "id_moteur", $id);
    $requetteCouleurAssocies = getItemAndPrice($pdo, "voitures_couleurs", "id_couleur", $id);
    $requetteJanteAssocies = getItemAndPrice($pdo, "voitures_jantes", "id_jante", $id);

    if ($requetteMoteursAssocies['success']) {
        $moteursAssocies = $requetteMoteursAssocies['data'];
    }

    if ($requetteCouleurAssocies['success']) {
        $couleursAssocies = $requetteCouleurAssocies['data'];
    }

    if ($requetteJanteAssocies['success']) {
        $jantesAssocies = $requetteJanteAssocies['data'];
    }
} else {
    header("Location:admin.php");
    exit();
}



?>
<!-- Début du contenu de la page -->
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-3 border bg-light admin">
        <h4 class="card-title">Modifier les "<b><?php echo $marque . ' ' . $model ?></b>" dans la BDD</h4>
        <div class="form-group mb-1">
            <form action="adminEditResult.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="row">
                    <div class="col">
                        <div class="form-group mb-2">
                            <label class="form-label" for="inputDescription">Description</label>
                            <textarea class="form-control" name="description" id="inputDescription"><?php echo $description ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    genererBlocSelection("Motorisations", $motorisation, $moteursAssocies, "moteur");
                    genererBlocSelection("Couleurs", $couleurs, $couleursAssocies, "couleur");
                    genererBlocSelection("Jantes", $jantes, $jantesAssocies, "jante");
                    ?>

                </div>
                <div class="row">
                    <div class="mb-1">
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>









<!-- Fin du contenu de la page -->
<?php
require_once 'includes/footer.php';
?>