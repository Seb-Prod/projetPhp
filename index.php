<?php
$pageTitle = "Accueil";
require_once 'includes/header.php';

// Connection à la base de données
define('SECURE_ACCESS', true);
require_once 'config.php';
$pdo = getDBConnection();

?>
<!<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<section class="my-5" id="">
        <div class ="container">
            <div class="row gy-4 gy-md-0 ">
                <div class="col-12 col-md-4 bg-light"  >
                <div class="titre mt-0 d-flex align-items-center">
                    <i class="bi bi-filter-square me-2"></i>
                    <h3 class="mb-0">Filtres</h3>
                </div>
                
                        <div class="dropdown mt-3">
                            <button class="btn btn-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                                Type de véhicule
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <label class="dropdown-item">
                                        <input type="checkbox"> Action
                                    </label>
                                </li>
                                <li>
                                    <label class="dropdown-item">
                                        <input type="checkbox"> Another action
                                    </label>
                                </li>
                                <li>
                                    <label class="dropdown-item">
                                        <input type="checkbox"> Something else here
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown mt-3">
                            <button class="btn btn-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                                Marques
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <label class="dropdown-item">
                                        <input type="checkbox"> Action
                                    </label>
                                </li>
                                <li>
                                    <label class="dropdown-item">
                                        <input type="checkbox"> Another action
                                    </label>
                                </li>
                                <li>
                                    <label class="dropdown-item">
                                        <input type="checkbox"> Something else here
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown mt-3">
                            <button class="btn btn-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                                Moteur
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <label class="dropdown-item">
                                        <input type="checkbox"> Action
                                    </label>
                                </li>
                                <li>
                                    <label class="dropdown-item">
                                        <input type="checkbox"> Another action
                                    </label>
                                </li>
                                <li>
                                    <label class="dropdown-item">
                                        <input type="checkbox"> Something else here
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <button type="submit" class="btn mt-3 w-100 btn-primary">Rechercher</button>
                </div>
                <div class="col-12 offset-1 col-md-7 bg-light">
                    <div class="titres">
                        <h3>Les voitures</h3>
                    </div>
                    <div class="card mt-3" style="width: w-100;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    <div class="card mt-3" style="width: w-100;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    <div class="card mt-3" style="width: w-100;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
    </section>
</body>
</html>



<!-- Fin du contenu de la page -->
<?php
require_once 'includes/footer.php';
?>


