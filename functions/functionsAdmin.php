<?php
function getItem($pdo, $item)
{
    try{
        $sql = "SELECT COUNT(*) OVER() as total, nom as nom, id as id FROM {$item}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if(empty($result)){
            return[
                'sucess' => true,
                'message' => 'requette vide',
                'data' => ['total' => 0, 'noms' =>[]]
            ];
        }

        $noms = array_combine(
            array_column($result, 'id'),
            array_column($result, 'nom')
        );

        $response = [
            'sucess' => true,
            'message' => 'requette ok',
            'data' => ['total' => $result[0]['total'], 'noms' =>$noms]
        ];



    }catch(PDOException $e){
        $response = [
            'sucess' => false,
            'message' => 'requette KO',
            'data' => $e->getCode()
        ];
    }

    return $response; 
}

function ajoutValue($pdo, $item, $values){
    // Construire les placeholders pour les valeurs
    $placeholders = implode(',', array_fill(0, count($values), '(?)'));

    // Construire la requête SQL avec le nom de la table dynamique
    $query = "INSERT INTO $item (nom) VALUES $placeholders";

    // Préparer la requête
    $stmt = $pdo->prepare($query);

    // Exécuter la requête avec les valeurs
    $stmt->execute($values);

    return $pdo;      
}

function ajoutVoiture($pdo, $nom, $type, $marque, $description, $date){
    try {
        // Préparation de la requête
        $sql = "INSERT INTO voitures (nom, id_type, id_marque, description, date_sortie) VALUES (:nom, :id_type, :id_marque, :description, :date_sortie)";
        $stmt = $pdo->prepare($sql);

        // Exécution de la requête avec les paramètres
        $result = $stmt->execute([
            ':nom' => $nom,
            ':id_type' => $type,
            ':id_marque' => $marque,
            ':description' => $description,
            ':date_sortie' => $date
        ]);

        if ($result) {
            $message = true;
        } else {
            $message = false;
        }
    } catch (PDOException $e) {
        $message = "Erreur de base de données : " . $e->getMessage();
    }
    return $message;
}