<?php
$pageTitle = "Description voiture";
require_once 'includes/header.php';
define('SECURE_ACCESS', true);
require_once 'config.php';
$id_voiture = 4; //Remplacé par un get lié sur la page de Moussa
$pdo = getDBConnection();
try {
    $pdo = getDBConnection();
    
    $sql = "SELECT vc.id_couleur, c.nom, vc.prix 
    FROM voitures_couleurs vc
    INNER JOIN couleurs c ON vc.id_couleur = c.id 
    WHERE vc.id_voiture = :id_voiture";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_voiture' => $id_voiture]);

    $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($resultat)) {
        echo "Données récupérées avec succès :";
        print_r($resultat);
    } else {
        echo "Aucun résultat trouvé.";
    }

} catch (PDOException $e) {
    echo "Erreur SQL : " . $e->getMessage();
}
?>

<div id="pageVoiture">

<div class="container">
    <article class="colonne">
        <!-- Début du contenu de la page -->
        <div class="carousel">
            <div class="carousel-inner">
                <div class="slide">
                    <img src="photos/dodgeviper.avi" alt="Image 1">
                </div>
                <div class="slide">
                    <img src="photos/dodgeviper2.avif" alt="Image 2">
                </div>
                <div class="slide">
                    <img src="photos/dodgeviper3.avif" alt="Image 3">
                </div>
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
            <?php foreach($resultat as $couleur) : ?>
                <option value="<?php echo $couleur['id_couleur']?>"><?php echo $couleur['nom']. ' prix : '. $couleur['prix'] . '€'?></option>
                <?php endforeach?>
      
        </select>
        
        <label for="jantes">Jantes :</label>
        <select id="jantes">
            <option value="17\Alliage" data-price="700">17" Alliage (+700€)</option>
            <option value="18\Alliage" data-price="800">18" Alliage (+800€)</option>
            <option value="19\Alliage" data-price="900">19" Alliage (+900€)</option>
            <option value="17\Chrome" data-price="1000">17" Chrome (+1000€)</option>
            <option value="18\Chrome" data-price="1100">18" Chrome (+1100€)</option>
            <option value="19\Chrome" data-price="1200">19" Chrome (+1200€)</option>
        </select>
        
        <label for="motorisation">Motorisation :</label>
        <select id="motorisation">
            <option value="Essence" data-price="2000">Essence (+2000€)</option>
            <option value="Diesel" data-price="2500">Diesel (+2500€)</option>
            <option value="Hybride" data-price="3000">Hybride (+3000€)</option>
            <option value="Électrique" data-price="3500">Électrique (+3500€)</option>
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
            <?php for($i = 1; $i <= 5; $i++): ?>
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
