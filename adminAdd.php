<?php
// Inportation du header
$pageTitle  = "Ajout de nouveaux model";
require_once 'includes/header.php';


//unset($_SESSION["admin"]);
// Vérification si est admin
if ($_SESSION["admin"] === 1) {
} else {
    header("Location:index.php");
    exit();
}

// Connection à la base de données
define('SECURE_ACCESS', true);
require_once 'config.php';

require_once 'functions/functionsAdmin.php';
$pdo = getDBConnection();

// initialisation des variables
$marques = [];
$couleurs = [];
$jantes = [];
$motorisation = [];
$type = [];


function chargeItemBdd($item, $values)
{
    global $pdo;
    $items = getItem($pdo, $item);
    $itemCount = $items['data']['total'];

    //On remplie avec les valeurs
    if ($itemCount == 0) {
        ajoutValue($pdo, $item, $values);
        header("Location:adminAdd.php");
        exit();
    } else {
        $return = $items['data']['noms'];
        return $return;
    }
}

//Chargement des données des tables (ajoutes des données par défaut si inexistante)
function initialisation()
{
    global $types, $couleurs, $jantes, $motorisation, $marques;
    $types = chargeItemBdd("types", ["SUV", "Breack", "Berline", "Roadster"]);
    $couleurs = chargeItemBdd("couleurs", ["Rouge", "Vert", "Blanc", "Noir"]);
    $jantes = chargeItemBdd("jantes", ["16 pouces", "18 pouces", "19 pouces"]);
    $marques = chargeItemBdd("marques", ["Nissan", "Fiat"]);
    $motorisation = chargeItemBdd("moteurs", ["Essence", "Diesel", "Electrique"]);
}

function genererBlocSelection($titre, $elements, $type)
{
    echo '<div class="col">';
    echo '<div class="card container p-3">';
    echo "<h6 class='card-title'>$titre</h6>";

    foreach ($elements as $key => $value) {
        $checked = '';
        $prix = '0';


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

initialisation();

?>
<!-- Début du contenu de la page -->
<form action="adminAddResult.php" method="post" enctype="multipart/form-data">
    <div class="card container p-3 bg-light mt-3 mb-3">
        <h4 class="card-title mb-3">Ajout d'un nouveau Model</h4>
        <div class="row">
            <div class="col">
                <div class="form-group mb-1">
                    <label class="form-label" for="inputModel">Model</label>
                    <input id="inputModel" class="form-control" type="text" name="model" required >
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group mb-1">
                    <label class="form-label" for="selectMarque">Marque</label>
                    <select class="form-control" name="marque" id="selectMarque">
                        <?php foreach ($marques as $key => $value) : ?>
                            <option value="<?php echo $key ?>"><?php echo $value ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group mb-1">
                    <label class="form-label" for="selectType">Type</label>
                    <select class="form-control" name="type" id="selectType">
                        <?php foreach ($types as $key => $value) : ?>
                            <option value="<?php echo $key ?>"><?php echo $value ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-1">
                    <label class="form-label" for="inputDate">Date de sortie</label>
                    <input id="inputDate" class="form-control" type="date" name="date" required >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group mb-2">
                    <label class="form-label" for="inputDescription">Description</label>
                    <textarea class="form-control" name="description" id="inputDescription"></textarea>
                </div>
            </div>
        </div>
        <!-- ajout des photos -->
        <div class="row">
            <div class="col">
                <div class="card container p-3">
                    <h6 class="card-title">Images du véhicule</h6>
                    <div class="mb-3">
                        <input type="file" class="form-control" name="imagesGalerie[]" id="imagesGalerie"
                            accept="image/jpeg,image/png,image/webp" multiple>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <?php
            genererBlocSelection('Motorisations', $motorisation, 'motorisation');
            genererBlocSelection('Couleurs', $couleurs, 'couleur');
            genererBlocSelection('Jantes', $jantes, 'jante');
            ?>
        </div>
        <div class="row">
            <div class="mb-1">
                <button type="submit" class="btn btn-primary">Valider</button>
            </div>
        </div>

    </div>




</form>


<!-- Fin du contenu de la page -->
<?php
require_once 'includes/footer.php';
?>