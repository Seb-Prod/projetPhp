document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.marque-checkbox');
    const counter = document.getElementById('marque-counter');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Compter le nombre de cases cochées
            const checkedCount = document.querySelectorAll('.marque-checkbox:checked').length;
            // Mettre à jour le compteur
            counter.textContent = checkedCount;
        });
    });
});