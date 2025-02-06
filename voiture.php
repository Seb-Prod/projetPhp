<?php
$pageTitle = "Description voiture";
require_once 'includes/header.php';
?>
<div class ="row">
    <div class="column">
            <!-- Début du contenu de la page -->
            <!-- Conteneur principal pour le carrousel -->
            <div class="container">
                    <!-- Élément carrousel -->
                    <div class="carousel">
                        <!-- Conteneur interne pour les diapositives -->
                        <div class="carousel-inner">
                            <!-- Première diapositive -->
                            <div class="slide">
                                <!-- Image de la première diapositive -->
                                <img src="photos/dodgeviper.avi"
                                    alt="Image 1">
                            </div>
                            <!-- Deuxième diapositive -->
                            <div class="slide">
                                <!-- Image de la deuxième diapositive -->
                                <img src="photos/dodgeviper2.avif"
                                    alt="Image 2">
                            </div>
                            <!-- Troisième diapositive -->
                            <div class="slide">
                                <!-- Image de la troisième diapositive -->
                                <img src="photos/dodgeviper3.avif"
                                    alt="Image 3">
                            </div>
                        <!-- Conteneur pour les boutons de navigation -->
                        <div class="carousel-controls">
                            <!-- Bouton pour passer à la diapositive précédente -->
                            <button id="prev">Précédent</button>
                            <!-- Bouton pour passer à la diapositive suivante -->
                            <button id="next">Suivant</button>
                        </div>
                        <!-- Conteneur pour les points de navigation -->
                        <div class="carousel-dots"></div>
                    </div>
            </div>
        </div>
        <div class="column">
            <article>
            À vendre : Dodge Viper – Puissance et élégance incomparables !

            Découvrez cette magnifique Dodge Viper, un bijou de performance et de design. Son coloris rouge éclatant, rehaussé par ses bandes blanches emblématiques, lui confère une allure agressive et racée.

            ✨ Caractéristiques principales :
            ✅ Moteur V10 offrant des performances exceptionnelles
            ✅ Design iconique avec un long capot et des lignes aérodynamiques
            ✅ Jantes sport et pneus haute performance
            ✅ Intérieur raffiné et sportif, conçu pour les passionnés de vitesse

            Cette Viper est photographiée sous un magnifique ciel bleu, avec un décor automnal qui met en valeur son éclat et son charisme. Un véhicule unique, prêt à faire tourner les têtes et à offrir des sensations inégalées.

            📍 Disponible immédiatement – Contactez-nous pour plus d’informations ou pour un essai ! 🚗💨
            </artcile>
        </div>
</div>

<script src="script.js"></script>
<!-- Fin du contenu de la page -->
<?php
require_once 'includes/footer.php';
?>