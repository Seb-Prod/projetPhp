<?php
function getItem($pdo, $item) {
    try {
        $sql = "SELECT nom FROM {$item}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $name = $stmt->fetchAll(PDO::FETCH_COLUMN); // Récupère uniquement les noms

        return $name;
    } catch (PDOException $e) {
        return []; // Retourne un tableau vide en cas d'erreur
    }
}

?>

