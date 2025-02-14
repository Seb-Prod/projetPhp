Site vente de voiture

Projet PHP pour mettre en oeuvre les connaissance aquise en PHP et SQL.
Création d'un site de vente de voiture.
    Avec une connection utilisateur/administrateur.
    Visialisation des models de voiture disponible.
    Filtre sur les marques, type, et motorisation des voitures.
    Possibilité d'ajouter, éditer et supprimer des model de voiture (Administrateur)

Prérequis :
- PHP
- MYSQL

Installation :
1. Clonez le dépôt :
    git clone https://github.com/Seb-Prod/projetPhp.git

2. Installer la BDD :
    sql/base_voiture.sql

3. Modifier les lignes suivante dans le fichier config.php :
    define('DB_HOST', 'adresseDuServer'); // Adresse du serveur
    define('DB_USER', 'user');      // Nom d'utilisateur MySQL
    define('DB_PASS', 'pass'); // Mot de passe
    define('DB_NAME', 'base_voiture');   // Nom de la base de données

4. Création du compte administrateur :
    Lors de la première ouverture du site aller sur la page LogIn et créer le compte administrateur


