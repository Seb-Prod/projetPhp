<?php
$pageTitle = "Description voiture";
require_once 'includes/header.php';
define('SECURE_ACCESS', true);
require_once 'config.php';
echo '<pre>';
var_dump($_GET);
echo '</pre>';
$id_voiture = $_GET["idVoiture"]; //Remplacé par un get lié sur la page de Moussa
$pdo = getDBConnection();

function getVoitureCaracteristiques($id_voiture, $caracteristique) {
    try {
        $pdo = getDBConnection();
        
        $tables = [
            'couleur' => ['table' => 'voitures_couleurs', 'join' => 'couleurs', 'id' => 'id_couleur'],
            'jante' => ['table' => 'voitures_jantes', 'join' => 'jantes', 'id' => 'id_jante'],
            'moteur' => ['table' => 'voitures_moteurs', 'join' => 'moteurs', 'id' => 'id_moteur']
        ];
        
        if (!isset($tables[$caracteristique])) {
            return ['error' => "Caractéristique invalide."];
        }
        
        $table = $tables[$caracteristique]['table'];
        $join = $tables[$caracteristique]['join'];
        $id = $tables[$caracteristique]['id'];
        
        $sql = "SELECT vc.$id, c.nom, vc.prix 
                FROM $table vc
                INNER JOIN $join c ON vc.$id = c.id 
                WHERE vc.id_voiture = :id_voiture";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id_voiture' => $id_voiture]);
        
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $resultat;
    } catch (PDOException $e) {
        return ['error' => "Erreur SQL : " . $e->getMessage()];
    }
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
                <!-- //Exemple d'utilisation
                $id_voiture = 1; // Remplace par une valeur réelle
                $result = getVoitureCouleurs($id_voiture);
                print_r($result); -->
                <option value="<?php echo $couleur['id_couleur']?>"><?php echo $couleur['nom']. ' prix : '. $couleur['prix'] . '€'?></option>
                <?php endforeach?>
      
        </select>
        
        <label for="jantes">Jantes :</label>
        <select id="jantes">
        <?php foreach($resultat as $jantes) : ?>
                <option value="<?php echo $jantes['id_jantes']?>"><?php echo $jantes['nom']. ' prix : '. $jantes['prix'] . '€'?></option>
                <?php endforeach?>
        </select>
        
        <label for="motorisation">Motorisation :</label>
        <select id="motorisation">
        <?php foreach($resultat as $moteur) : ?>
                <option value="<?php echo $moteur['id_jantes']?>"><?php echo $moteur['nom']. ' prix : '. $moteur['prix'] . '€'?></option>
                <?php endforeach?>
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
