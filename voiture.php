<?php
$pageTitle = "Description voiture";
require_once 'includes/header.php';


$id_voiture = $_GET['idVoiture']; // Correction du paramètre

//Recupere les informations des voitures depuis la page index.php
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
        
        $sql = "SELECT vc.$id, c.nom, vc.prix FROM $table vc INNER JOIN $join c ON vc.$id = c.id WHERE vc.id_voiture = :id_voiture";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id_voiture' => $id_voiture]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return ['error' => "Erreur SQL : " . $e->getMessage()];
    }
}

//Récupération de la partie photo depuis la page indexp.php
function getCarPhoto($id_voiture) {
    try {
        $pdo = getDBConnection();
        
        $sql = "SELECT p.nom AS photo FROM voitures_photos vp INNER JOIN photos p ON vp.id_photo = p.ID WHERE vp.id_voiture = :id_voiture LIMIT 1";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id_voiture' => $id_voiture]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return ['error' => "Erreur SQL : " . $e->getMessage()];
    }
}

$couleurs = getVoitureCaracteristiques($id_voiture, 'couleur');
$jantes = getVoitureCaracteristiques($id_voiture, 'jante');
$moteurs = getVoitureCaracteristiques($id_voiture, 'moteur');
$photo = getCarPhoto($id_voiture);

?>

<div id="pageVoiture">
    <div class="container">
    <article class="car-preview">
                    <?php if (isset($photo) && file_exists('img/' . $photo['photo'])): ?>
                        <img src="img/<?php echo $photo['photo']; ?>" alt="Photo voiture" class="voiture-photo">
                    <?php else: ?>
                        <img src="img/default.jpg" alt="Photo non disponible" class="voiture-photo">
                    <?php endif; ?>
                </article>       
        <article class="colonne">
            <div class="options">
                <h2>Personnalisez votre voiture</h2>
                <label for="couleur">Couleur :</label>
                <select id="couleur">
                    <?php foreach ($couleurs as $couleur) : ?>
                        <option value="<?php echo $couleur['id_couleur'] ?>" data-price="<?php echo $couleur['prix']; ?>">
                            <?php echo $couleur['nom'] . ' (+ ' . $couleur['prix'] . '€)'; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <label for="jantes">Jantes :</label>
                <select id="jantes">
                    <?php foreach ($jantes as $jante) : ?>
                        <option value="<?php echo $jante['id_jante'] ?>" data-price="<?php echo $jante['prix']; ?>">
                            <?php echo $jante['nom'] . ' (+ ' . $jante['prix'] . '€)'; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <label for="motorisation">Motorisation :</label>
                <select id="motorisation">
                    <?php foreach ($moteurs as $moteur) : ?>
                        <option value="<?php echo $moteur['id_moteur'] ?>" data-price="<?php echo $moteur['prix']; ?>">
                            <?php echo $moteur['nom'] . ' (+ ' . $moteur['prix'] . '€)'; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <div id="panier"></div>
                <button id="ajouter">Ajouter au panier</button>
                <h3>Total: <span id="total">0</span>€</h3>
            </div>
        </article>
    </div>
</div>

<div class="avis-section">
    <h2>Avis clients</h2>
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
<script src="script.js"></script>
<?php require_once 'includes/footer.php'; ?>
