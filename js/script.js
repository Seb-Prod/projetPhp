document.addEventListener('DOMContentLoaded', function() {
    // 1. Fonction des compteurs
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

    // Initialisation des compteurs
    updateCounter('.marque-checkbox', 'marque-counter');
    updateCounter('.moteur-checkbox', 'moteur-counter');
    updateCounter('.type-checkbox', 'type-counter');

    const body = document.body;
    const themeSwitcherMobile = document.getElementById("themeSwitcher");
    const themeSwitcherDesktop = document.getElementById("themeSwitcher-desktop");

    // Vérifier si un mode est déjà enregistré
    if (localStorage.getItem("darkMode") === "enabled") {
        body.classList.add("dark-mode");
    }

    function toggleDarkMode() {
        body.classList.toggle("dark-mode");
        
        // Sauvegarde de la préférence dans localStorage
        if (body.classList.contains("dark-mode")) {
            localStorage.setItem("darkMode", "enabled");
        } else {
            localStorage.setItem("darkMode", "disabled");
        }
    }

    // Ajouter les événements sur les boutons
    if (themeSwitcherMobile) {
        themeSwitcherMobile.addEventListener("click", toggleDarkMode);
    }
    if (themeSwitcherDesktop) {
        themeSwitcherDesktop.addEventListener("click", toggleDarkMode);
    }


});
