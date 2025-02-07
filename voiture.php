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
    </article>
</div>

<script src="script.js"></script>

<?php
require_once 'includes/footer.php';
?>
