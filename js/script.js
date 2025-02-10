
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
