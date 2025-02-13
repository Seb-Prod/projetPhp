<?php
$pageTitle = "Accueil";
require_once 'includes/header.php';

// Connection à la base de données
define('SECURE_ACCESS', true);
require_once 'config.php';
$pdo = getDBConnection();

require_once 'functionFiltres.php'; // Fichier contenant la fonction getItem()

$moteurs = getItem($pdo, 'moteurs'); // Récupère les moteurs
$marques = getItem($pdo, 'marques'); // Récupère les marques
$types = getItem($pdo, 'types'); // Récupère les types de véhicules


$sql = "SELECT v.ID AS voiture_id, v.nom AS voiture_nom, v.description, v.date_sortie, 
       m.nom AS marque_nom, t.nom AS type_nom, mo.nom AS moteur_nom, MAX(p.nom) AS photo_nom
FROM voitures v
INNER JOIN marques m ON v.id_marque = m.ID
INNER JOIN types t ON v.id_type = t.ID
INNER JOIN voitures_moteurs vm ON v.ID = vm.id_voiture
INNER JOIN moteurs mo ON vm.id_moteur = mo.ID
LEFT JOIN voitures_photos vp ON v.ID = vp.id_voiture
LEFT JOIN photos p ON vp.id_photo = p.ID
GROUP BY v.ID, v.nom, v.description, v.date_sortie, m.nom, t.nom, mo.nom";



$stmt = $pdo->prepare($sql);
$stmt->execute();
$voitures = $stmt->fetchAll();
// echo '<pre>';
// var_dump($voitures);
// echo '</pre>';
$typesSelectionnes = $_GET['types'] ?? [];
$marquesSelectionnees = $_GET['marques'] ?? [];
$moteursSelectionnes = $_GET['moteurs'] ?? [];

// Filtrer les voitures
$voituresFiltrees = array_filter($voitures, function ($voiture) use ($typesSelectionnes, $marquesSelectionnees, $moteursSelectionnes) {
    $typeMatch = empty($typesSelectionnes) || (isset($voiture['type_nom']) && in_array($voiture['type_nom'], $typesSelectionnes));
    $marqueMatch = empty($marquesSelectionnees) || (isset($voiture['marque_nom']) && in_array($voiture['marque_nom'], $marquesSelectionnees));
    $moteurMatch = empty($moteursSelectionnes) || (isset($voiture['moteur_nom']) && in_array($voiture['moteur_nom'], $moteursSelectionnes));

    return $typeMatch && $marqueMatch && $moteurMatch;
});
// echo '<pre>';
// var_dump($_GET);
// echo '</pre>';
// ?>

    <div class="page-container">
        <section class="my-5 content vh-100">
            <div class="container">
                <div class="row justify-content-center gy-4 gy-md-0 vh-100">
                    <div class="col-12 col-md-3 bg-light filtres-colonne">
                        <div class="titre mt-0 d-flex align-items-center">
                            <i class="bi bi-filter-square me-2 mt-3"></i>
                            <h4 class="mb-0 mt-3">Filtres</h4>
                        </div>
                        <form method="GET" action="index.php">
                            <div class="dropdown mt-3">
                            <button class="btn bg-white text-dark dropdown-toggle w-100 d-flex justify-content-between align-items-center border" type="button" data-bs-toggle="dropdown">
                                    <span>Type de véhicules</span>
                                    <span id="type-counter" class="badge bg-light text-dark ms-auto">0</span>
                            </button>
                                <ul class="dropdown-menu">
                                    <?php foreach ($types as $type) : ?>
                                        <li>
                                            <label class="dropdown-item">
                                                <input type="checkbox" name="types[]" class="type-checkbox"
                                                    value="<?php echo htmlspecialchars($type); ?>">
                                                <?php echo htmlspecialchars($type); ?>
                                            </label>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                            <div class="dropdown mt-3">
                                <button class="btn bg-white text-dark dropdown-toggle w-100 d-flex justify-content-between align-items-center border" type="button" data-bs-toggle="dropdown">
                                    Marques <span id="marque-counter" class="badge bg-light text-dark ms-auto">0</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <?php foreach ($marques as $marque) { ?>
                                        <li>
                                            <label class="dropdown-item">
                                                <input type="checkbox" name="marques[]" value="<?php echo htmlspecialchars($marque); ?>" class="marque-checkbox">
                                                <?php echo htmlspecialchars($marque); ?>
                                            </label>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="dropdown mt-3">
                                <button class="btn bg-white text-dark dropdown-toggle w-100 d-flex justify-content-between align-items-center border" type="button" data-bs-toggle="dropdown">
                                    Moteur <span id="moteur-counter" class="badge bg-light text-dark ms-auto">0</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <?php foreach ($moteurs as $moteur) { ?>
                                        <li>
                                            <label class="dropdown-item">
                                                <input type="checkbox" name="moteurs[]" value="<?php echo htmlspecialchars($moteur); ?>" class="moteur-checkbox">
                                                <?php echo htmlspecialchars($moteur); ?>
                                            </label>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <button type="submit" class="btn mt-3 w-100 btn-primary">Rechercher</button>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 bg-light ms-md-4 voitures-container">
                        <div class="titres">
                            <h3 class="mt-3">Les voitures</h3>
                        </div>
                        <?php foreach ($voituresFiltrees as $voiture) : ?>
                            <div class="car-item card mt-3 col-md-5 mx-md-1">
                                <img src="img/<?php echo htmlspecialchars($voiture['photo_nom'] ?? 'default.jpg'); ?>" class="card-img-top shadow" alt="<?php echo htmlspecialchars($voiture['voiture_nom'] ?? ''); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($voiture['voiture_nom'] ?? ''); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($voiture['description'] ?? ''); ?></p>
                                    <p><strong>Marque :</strong> <?php echo htmlspecialchars($voiture['marque_nom'] ?? ''); ?></p>
                                    <p><strong>Date de sortie :</strong> <?php echo htmlspecialchars($voiture['date_sortie'] ?? ''); ?></p>
                                    <a href="voiture.php?idVoiture=<?php echo $voiture['voiture_id'] ?>" class="btn btn-primary">Voir plus</a>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </section>  
    </div>


    <!-- Fin du contenu de la page -->
    <?php
    require_once 'includes/footer.php';
    ?>