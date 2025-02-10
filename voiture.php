<?php
$pageTitle = "Description voiture";
require_once 'includes/header.php';
?>

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
            <div class="carousel-dots"></div>
        </div>
    </article>
    <article class="colonne">
    <div class="options">
        <h2>Personnalisez votre voiture</h2>
        <p>Choisissez parmi nos différentes options :</p>
        
        <label for="couleur">Couleur :</label>
        <select id="couleur">
            <option value="Rouge" data-price="500">Rouge (+500€)</option>
            <option value="Noir" data-price="600">Noir (+600€)</option>
            <option value="Blanc" data-price="400">Blanc (+400€)</option>
            <option value="Bleu" data-price="550">Bleu (+550€)</option>
            <option value="Gris" data-price="450">Gris (+450€)</option>
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
<script src="script.js"></script>

<?php
require_once 'includes/footer.php';
?>
