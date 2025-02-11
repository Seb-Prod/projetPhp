document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour mettre à jour un compteur
    function updateCounter(checkboxClass, counterId) {
        const checkboxes = document.querySelectorAll(checkboxClass);
        const counter = document.getElementById(counterId);

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const checkedCount = document.querySelectorAll(`${checkboxClass}:checked`).length;
                counter.textContent = checkedCount;
            });
        });
    }

    // Appliquer la fonction aux deux dropdowns
    updateCounter('.marque-checkbox', 'marque-counter'); // Pour les marques
    updateCounter('.moteur-checkbox', 'moteur-counter'); // Pour les moteurs
    updateCounter('.type-checkbox', 'type-counter');
});
    // document.addEventListener('DOMContentLoaded', function() {
    //     // Votre code existant pour les compteurs...
    
    //     // Ajout du filtrage
    //     document.querySelector('button[type="submit"]').addEventListener('click', function(e) {
    //         e.preventDefault(); // Empêcher l'envoi du formulaire
    
    //         // Récupérer les filtres sélectionnés
    //         const selectedTypes = Array.from(document.querySelectorAll('.type-checkbox:checked'))
    //             .map(cb => cb.value);
    //         const selectedMarques = Array.from(document.querySelectorAll('.marque-checkbox:checked'))
    //             .map(cb => cb.value);
    //         const selectedMoteurs = Array.from(document.querySelectorAll('.moteur-checkbox:checked'))
    //             .map(cb => cb.value);
    
    //         // Sélectionner tous les éléments à filtrer
    //         const items = document.querySelectorAll('.car-item');
    
    //         items.forEach(item => {
    //             const typeMatch = selectedTypes.length === 0 || 
    //                 selectedTypes.includes(item.dataset.type);
    //             const marqueMatch = selectedMarques.length === 0 || 
    //                 selectedMarques.includes(item.dataset.marque);
    //             const moteurMatch = selectedMoteurs.length === 0 || 
    //                 selectedMoteurs.includes(item.dataset.moteur);
    
    //             // Afficher/masquer l'élément selon les filtres
    //             item.style.display = (typeMatch && marqueMatch && moteurMatch) ? '' : 'none';
    //         });
    //     });
    // });