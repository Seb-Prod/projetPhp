<?php
$pageTitle = "Description voiture";
require_once 'includes/header.php';
define('SECURE_ACCESS', true);
require_once 'config.php';

$pdo = getDBConnection();

function getOption($pdo, $id, $option)
{
    try {
        $sql = "SELECT vc.id_{$option}, c.nom, vc.prix 
        FROM voitures_{$option}s vc
        INNER JOIN {$option}s c ON vc.id_{$option} = c.id 
        WHERE vc.id_voiture = :id_voiture";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id_voiture' => $id]);

        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($resultat)) {
            return [
                'success' => true,
                'message' => 'Données récupérées avec succès',
                'data' => $resultat
            ];
        } else {
            return [
                'success' => false,
                'message' => 'rien de touvé',
                'data' => $resultat
            ];
        }
    } catch (PDOException $e) {
        return [
            'success' => false,
            'message' => 'Erreur BDD'
        ];
    }
}

function getCarInfo($pdo, $id)
{
    $query = "SELECT 
        v.ID,
        v.nom AS nom_voiture,
        v.description,
        v.date_sortie,
        t.nom AS type,
        m.nom AS marque,
        GROUP_CONCAT(DISTINCT p.nom) AS photos
    FROM voitures v
    LEFT JOIN types t ON v.id_type = t.ID 
    LEFT JOIN marques m ON v.id_marque = m.ID
    LEFT JOIN voitures_photos vp ON v.ID = vp.id_voiture
    LEFT JOIN photos p ON vp.id_photo = p.ID
    WHERE v.ID = :carId
    GROUP BY v.ID";

    try {
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':carId', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Convertir la chaîne de photos en tableau
            $result['photos'] = $result['photos'] ? explode(',', $result['photos']) : [];
            return $result;
        }

        return null;
    } catch (PDOException $e) {
        // Gérer l'erreur selon vos besoins
        error_log("Erreur lors de la récupération des informations de la voiture : " . $e->getMessage());
        return null;
    }
}



if (isset($_GET['idVoiture']) and $_GET['idVoiture'] != "") {
    $id = $_GET['idVoiture'];

    $couleurs = getOption($pdo, $id, "couleur");
    $jantes = getOption($pdo, $id, "jante");

    $carInfo = getCarInfo($pdo, $id);

    if ($carInfo) {
        echo "Nom : " . $carInfo['nom_voiture'] . "\n";
        echo "Marque : " . $carInfo['marque'] . "\n";
        echo "Type : " . $carInfo['type'] . "\n";
        echo "Description : " . $carInfo['description'] . "\n";
        echo "Date de sortie : " . $carInfo['date_sortie'] . "\n";

        echo "Photos : \n";
        foreach ($carInfo['photos'] as $photo) {
            echo "- " . $photo . "\n";
        }
    }
} else {
    // retour à index
}



?>

<div id="pageVoiture">

    <div class="container">
        <article class="colonne">
            <!-- Début du contenu de la page -->
            <div class="carousel">
                <div class="carousel-inner">
                    <?php foreach ($carInfo['photos'] as $photo) : ?>
                        <div class="slide">
                            <img src="img/<?php echo $photo ?>" alt="Image 1">
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="carousel-controls">
                    <button id="prev">Précédent</button>
                    <button id="next">Suivant</button>
                </div>
                <div class="carousel-dots">
                    <span class="dot active"></span>
                </div>
            </div>
        </article>
        <article class="colonne">
            <div class="options">
                <h2>Personnalisez votre voiture</h2>
                <p>Choisissez parmi nos différentes options :</p>

                <label for="couleur">Couleur :</label>
                <select id="couleur">
                    <?php foreach ($couleurs['data'] as $item) : ?>
                        <option value="<?php echo $item['id_couleur'] ?>"><?php echo $item['nom'] . ' prix : ' . $item['prix'] . '€' ?></option>
                    <?php endforeach ?>

                </select>

                <label for="jantes">Jantes :</label>
                <select id="jantes">
                    <?php foreach ($jantes['data'] as $item) : ?>
                        <option value="<?php echo $item['id_jante'] ?>"><?php echo $item['nom'] . ' prix : ' . $item['prix'] . '€' ?></option>
                    <?php endforeach ?>
                </select>

                <button id="ajouter">Ajouter au panier</button>
            </div>

            <div class="panier-container">
                <h2>Votre Panier</h2>
                <ul id="panier"></ul>
                <p>Total: <span id="total">0</span>€</p>
            </div>
        </article>
    </div>


    <h2>À vendre : Dodge Viper – Puissance et élégance incomparables !</h2>
    <p>
        Découvrez cette magnifique Dodge Viper, un bijou de performance et de design.
        Son coloris rouge éclatant, rehaussé par ses bandes blanches emblématiques,
        lui confère une allure agressive et racée.
    </p>
    <ul>
        <li>✅ Moteur V10 offrant des performances exceptionnelles</li>
        <li>✅ Design iconique avec un long capot et des lignes aérodynamiques</li>
        <li>✅ Jantes sport et pneus haute performance</li>
        <li>✅ Intérieur raffiné et sportif, conçu pour les passionnés de vitesse</li>
    </ul>
    <p>
        Cette Viper est photographiée sous un magnifique ciel bleu, avec un décor automnal
        qui met en valeur son éclat et son charisme. Un véhicule unique, prêt à faire
        tourner les têtes et à offrir des sensations inégalées.
    </p>
    <p>📍 Disponible immédiatement – Contactez-nous pour plus d’informations ou pour un essai ! 🚗💨</p>

    <div class="avis-section">
        <h2>Avis clients</h2>

        <!-- Formulaire d'ajout d'avis -->
        <form action="ajouter_avis.php" method="POST">
            <input type="text" name="nom" placeholder="Votre nom" required>
            <textarea name="commentaire" placeholder="Votre commentaire" required></textarea>
            <select name="note" required>
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?> étoiles</option>
                <?php endfor; ?>
            </select>
            <button type="submit">Publier l'avis</button>
        </form>

    </div>
</div>
<?php
//require_once 'includes/db.php';
?>

<script src="script.js"></script>

<?php
require_once 'includes/footer.php';
?>