<?php
echo '<pre>';
var_dump($_POST);
echo '</pre>';

// Connection à la base de données
define('SECURE_ACCESS', true);
require_once 'config.php';
$pdo = getDBConnection();

$idVoiture = null;


if (isset($_POST['id']) and $_POST['id'] != "") {
    $idVoiture = $_POST['id'];
    if (isset($_POST['moteur'])) {
        echo "moteur";
        updateVoitureOptions($pdo, $idVoiture, 'moteur', $_POST);
    }else{
        delVoitureOptions($pdo, $idVoiture, "voitures_moteurs");
    }
    if (isset($_POST['couleur'])) {
        updateVoitureOptions($pdo, $idVoiture, 'couleur', $_POST);
    }else{
        delVoitureOptions($pdo, $idVoiture, "voitures_couleurs");
    }
    if (isset($_POST['jante'])) {
        updateVoitureOptions($pdo, $idVoiture, 'jante', $_POST);
    }else{
        delVoitureOptions($pdo, $idVoiture, "voitures_jantes");
    }
    updateVoitureDescription($pdo, $idVoiture);
    header("Location:admin.php");
    exit();
}

function updateVoitureDescription($pdo, $idVoiture){
    if(isset($_POST['description'])){
        $txt = $_POST['description'];
        $sql = "UPDATE  voitures
                   SET description = ? 
                   WHERE ID = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$txt, $idVoiture]);
    }
}

function updateVoitureOptions($pdo, $idVoiture, $type, $data) {
    // Configuration des paramètres selon le type
    $config = [
        'moteur' => [
            'table' => 'voitures_moteurs',
            'id_column' => 'id_moteur',
            'prix_field' => 'prixmoteur'
        ],
        'couleur' => [
            'table' => 'voitures_couleurs',
            'id_column' => 'id_couleur',
            'prix_field' => 'prixcouleur'
        ],
        'jante' => [
            'table' => 'voitures_jantes',
            'id_column' => 'id_jante',
            'prix_field' => 'prixjante'
        ]
    ];

    if (!isset($config[$type])) {
        throw new Exception("Type d'option non valide");
    }

    $table = $config[$type]['table'];
    $id_column = $config[$type]['id_column'];
    $prix_field = $config[$type]['prix_field'];

    


    // Récupérer les options actuelles
    $sql_actuels = "SELECT $id_column FROM $table WHERE id_voiture = ?";
    $stmt = $pdo->prepare($sql_actuels);
    $stmt->execute([$idVoiture]);
    $options_actuelles = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Pour chaque option cochée
    foreach ($data[$type] as $idOption) {
        $prix = intval($data[$prix_field][$idOption]);

        if (in_array($idOption, $options_actuelles)) {
            // Mise à jour du prix si existe déjà
            $sql = "UPDATE $table 
                   SET prix = ? 
                   WHERE id_voiture = ? AND $id_column = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$prix, $idVoiture, $idOption]);
        } else {
            // Insertion si nouveau
            $sql = "INSERT INTO $table (id_voiture, $id_column, prix) 
                   VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$idVoiture, $idOption, $prix]);
        }
    }
    
    // Supprimer les options qui ne sont plus cochées
    $options_a_garder = array_map('intval', array_keys($data[$type]));
    if (!empty($options_a_garder)) {
        $sql = "DELETE FROM $table 
                WHERE id_voiture = ? 
                AND $id_column NOT IN (" . implode(',', $options_a_garder) . ")";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idVoiture]);
    }
    
}

function delVoitureOptions($pdo, $idVoiture, $table){
        $sql = "DELETE FROM $table WHERE id_voiture = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idVoiture]);
}


