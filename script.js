// Ceci est une fonction auto - exécutable.Les fonctions auto - exécutables
// sont des fonctions qui s'exécutent immédiatement après leur déclaration,
// sans avoir besoin d'être appelées.Les accolades immédiatement après la 
// déclaration de la fonction et les parenthèses à la fin de la déclaration 
// définissent la fonction et permettent de l'exécuter immédiatement.
(function () {
    // Utilisation de la directive "use strict" pour activer le mode strict en JavaScript
    // Cela implique une meilleure gestion des erreurs et une syntaxe plus stricte pour le code
    "use stict"
    // Déclare la constante pour la durée de chaque slide
    const slideTimeout = 5000;
    // Récupère les boutons de navigation
    const prev = document.querySelector('#prev');
    const next = document.querySelector('#next');
    // Récupère tous les éléments de type "slide"
    const $slides = document.querySelectorAll('.slide');
    // Initialisation de la variable pour les "dots"
    let $dots;
    // Initialisation de la variable pour l'intervalle d'affichage des slides
    let intervalId;
    // Initialisation du slide courant à 1
    let currentSlide = 1;
    // Fonction pour afficher un slide spécifique en utilisant un index
    function slideTo(index) {
        // Vérifie si l'index est valide (compris entre 0 et le nombre de slides - 1)
        currentSlide = index >= $slides.length || index < 1 ? 0 : index;
        // Boucle sur tous les éléments de type "slide" pour les déplacer
        $slides.forEach($elt => $elt.style.transform = `translateX(-${currentSlide * 100}%)`);
        // Boucle sur tous les "dots" pour mettre à jour la couleur par la classe "active" ou "inactive"
        $dots.forEach(($elt, key) => $elt.classList = `dot ${key === currentSlide? 'active': 'inactive'}`);
    }
    // Fonction pour afficher le prochain slide
    function showSlide() {
        slideTo(currentSlide);
        currentSlide++;
    }
    // Boucle pour créer les "dots" en fonction du nombre de slides
    for (let i = 1; i <= $slides.length; i++) {
        let dotClass = i == currentSlide ? 'active' : 'inactive';
        let $dot = `<span data-slidId="${i}" class="dot ${dotClass}"></span>`;
        document.querySelector('.carousel-dots').innerHTML += $dot;
    }
    // Récupère tous les "dots"
    $dots = document.querySelectorAll('.dot');
    // Boucle pour ajouter des écouteurs d'événement "click" sur chaque "dot"
    $dots.forEach(($elt, key) => $elt.addEventListener('click', () => slideTo(key)));
    // Ajout d'un écouteur d'événement "click" sur le bouton "prev" pour afficher le slide précédent
    prev.addEventListener('click', () => slideTo(--currentSlide))
    // Ajout d'un écouteur d'événement "click" sur le bouton "next" pour afficher le slide suivant
    next.addEventListener('click', () => slideTo(++currentSlide))
    // Initialisation de l'intervalle pour afficher les slides
    intervalId = setInterval(showSlide, slideTimeout)
    // Boucle sur tous les éléments de type "slide" pour ajouter des écouteurs d'événement pour les interactions avec la souris et le toucher
    $slides.forEach($elt => {
        let startX;
        let endX;
        // Efface l'intervalle d'affichage des slides lorsque la souris passe sur un slide
        $elt.addEventListener('mouseover', () => {
            clearInterval(intervalId);
        }, false)
        // Réinitialise l'intervalle d'affichage des slides lorsque la souris sort d'un slide
        $elt.addEventListener('mouseout', () => {
            intervalId = setInterval(showSlide, slideTimeout);
        }, false);
        // Enregistre la position initiale du toucher lorsque l'utilisateur touche un slide
        $elt.addEventListener('touchstart', (event) => {
            startX = event.touches[0].clientX;
        });
        // Enregistre la position finale du toucher lorsque l'utilisateur relâche son doigt
        $elt.addEventListener('touchend', (event) => {
            endX = event.changedTouches[0].clientX;
            // Si la position initiale est plus grande que la position finale, affiche le prochain slide
            if (startX > endX) {
                slideTo(currentSlide + 1);
                // Si la position initiale est plus petite que la position finale, affiche le slide précédent
            } else if (startX < endX) {
                slideTo(currentSlide - 1);
            }
        });
    })
})()


document.addEventListener('DOMContentLoaded', function() {
    const ajouterBtn = document.getElementById('ajouter');
    const panierList = document.getElementById('panier');
    const totalSpan = document.getElementById('total');
    let total = 0;

    ajouterBtn.addEventListener('click', function() {
        // Récupérer les valeurs sélectionnées
        const couleur = document.getElementById('couleur');
        const jantes = document.getElementById('jantes');
        const motorisation = document.getElementById('motorisation');

        const couleurSelected = couleur.options[couleur.selectedIndex];
        const jantesSelected = jantes.options[jantes.selectedIndex];
        const motorisationSelected = motorisation.options[motorisation.selectedIndex];

        // Récupérer les prix
        const prixCouleur = parseInt(couleurSelected.getAttribute('data-price'));
        const prixJantes = parseInt(jantesSelected.getAttribute('data-price'));
        const prixMotorisation = parseInt(motorisationSelected.getAttribute('data-price'));

        // Calculer le total
        total += prixCouleur + prixJantes + prixMotorisation;

        // Ajouter les options au panier
        const liCouleur = document.createElement('li');
        liCouleur.textContent = `Couleur: ${couleurSelected.textContent}`;
        panierList.appendChild(liCouleur);

        const liJantes = document.createElement('li');
        liJantes.textContent = `Jantes: ${jantesSelected.textContent}`;
        panierList.appendChild(liJantes);

        const liMotorisation = document.createElement('li');
        liMotorisation.textContent = `Motorisation: ${motorisationSelected.textContent}`;
        panierList.appendChild(liMotorisation);

        // Mettre à jour le total
        totalSpan.textContent = total;
    });
});


//Dark Mode 

document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.getElementById("darkModeToggle");
    const body = document.body;

    // Vérifier si le mode sombre est activé (stocké dans localStorage)
    if (localStorage.getItem("darkMode") === "enabled") {
        body.classList.add("dark-mode");
        toggleButton.textContent = "☀️ Mode Clair";
    }

    // Basculer le mode sombre/clair au clic
    toggleButton.addEventListener("click", function () {
        body.classList.toggle("dark-mode");

        if (body.classList.contains("dark-mode")) {
            localStorage.setItem("darkMode", "enabled");
            toggleButton.textContent = "☀️ Mode Clair";
        } else {
            localStorage.setItem("darkMode", "disabled");
            toggleButton.textContent = "🌙 Mode Sombre";
        }
    });
});