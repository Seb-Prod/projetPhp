<?php
function getItem($pdo, $item)
{
    try {
        $sql = "SELECT COUNT(*) OVER() as total, nom as nom, id as id FROM {$item}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($result)) {
            return [
                'sucess' => true,
                'message' => 'requette vide',
                'data' => ['total' => 0, 'noms' => []]
            ];
        }

        $noms = array_combine(
            array_column($result, 'id'),
            array_column($result, 'nom')
        );

        $response = [
            'sucess' => true,
            'message' => 'requette ok',
            'data' => ['total' => $result[0]['total'], 'noms' => $noms]
        ];
    } catch (PDOException $e) {
        $response = [
            'sucess' => false,
            'message' => 'requette KO',
            'data' => $e->getCode()
        ];
    }

    return $response;
}

function ajoutValue($pdo, $item, $values)
{
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

function ajoutVoiture($pdo, $nom, $type, $marque, $description, $date)
{
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
            $response = [
                'sucess' => true,
                'message' => "L'ajout de voiture à réussi",
                'value' => $pdo->lastInsertId()
            ];
            //$message = true;
        } else {
            $response = [
                'sucess' => false,
                'message' => "L'ajout de voiture à échoué"
            ];
        }
    } catch (PDOException $e) {
        $response = [
            'sucess' => false,
            'message' => "Erreur BDD : " . $e
        ];
    }
    return $response;
}

function ajoutOptionVoiture($pdo, $table, $idVoiture, $nomOption, $idOption, $prix)
{
    try {
        // Préparation de la requête
        $sql = "INSERT INTO {$table} (id_voiture, {$nomOption}, prix) VALUES (:idVoiture, :nomOption, :prix)";
        $stmt = $pdo->prepare($sql);

        // Exécution de la requête avec les paramètres
        $result = $stmt->execute([
            ':idVoiture' => $idVoiture,
            ':nomOption' => $idOption,
            ':prix' => $prix
        ]);

        if ($result) {
            $response = [
                'sucess' => true,
                'message' => "L'ajout de l'option à réussie'"
            ];
            //$message = true;
        } else {
            $response = [
                'sucess' => false,
                'message' => "L'ajout de l'option à échoué"
            ];
        }
    } catch (PDOException $e) {
        $response = [
            'sucess' => false,
            'message' => "Erreur BDD : " . $e
        ];
    }
    return $response;
}

function ajoutPhoto($pdo, $name)
{
    echo "j'ajoute photo";
    try {
        // Préparation de la requête
        $sql = "INSERT INTO photos (nom) VALUES (:nom)";
        $stmt = $pdo->prepare($sql);

        // Exécution de la requête avec les paramètres
        $result = $stmt->execute([':nom' => $name]);

        if ($result) {
            $response = [
                'sucess' => true,
                'message' => "L'ajout de la photo à réussi",
                'value' => $pdo->lastInsertId()
            ];
            //$message = true;
        } else {
            $response = [
                'sucess' => false,
                'message' => "L'ajout de la photo à échoué"
            ];
        }

    } catch (PDOException $e) {
        $response = [
            'sucess' => false,
            'message' => "Erreur BDD : " . $e
        ];
    }
    return $response;
}

function ajoutPhotoVoiture($pdo, $idVoiture, $idPhoto){
    try {
        // Préparation de la requête
        $sql = "INSERT INTO voitures_photos (id_voiture, id_photo) VALUES (:idVoiture, :idPhoto)";
        $stmt = $pdo->prepare($sql);

        // Exécution de la requête avec les paramètres
        $result = $stmt->execute([
            ':idVoiture' => $idVoiture,
            ':idPhoto' => $idPhoto
        ]);

        if ($result) {
            $response = [
                'sucess' => true,
                'message' => "L'ajout a réussie'"
            ];
            //$message = true;
        } else {
            $response = [
                'sucess' => false,
                'message' => "L'ajout a échoué"
            ];
        }
    } catch (PDOException $e) {
        $response = [
            'sucess' => false,
            'message' => "Erreur BDD : " . $e
        ];
    }
    return $response;
}

function getVoitures($pdo) {
    try {
        $sql = "SELECT COUNT(*) OVER() as total, 
                voitures.ID, 
                voitures.nom as nom_voiture, 
                marques.nom as nom_marque 
                FROM voitures 
                INNER JOIN marques ON voitures.id_marque = marques.ID";
 
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
        if (empty($result)) {
            return [
                'success' => true,
                'message' => 'requête vide',
                'data' => ['total' => 0, 'items' => []]
            ];
        }
 
        $response = [
            'success' => true,
            'message' => 'requête ok',
            'data' => [
                'total' => $result[0]['total'],
                'items' => $result
            ]
        ];
    } catch (PDOException $e) {
        $response = [
            'success' => false,
            'message' => 'requête KO',
            'data' => $e->getCode()
        ];
    }
 
    return $response;
 }

 function deleteVoiture($pdo, $id) {
    try {
        $sql = "DELETE FROM voitures WHERE ID = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
 
        $response = [
            'success' => true,
            'message' => 'Voiture supprimée avec succès',
            'data' => $id
        ];
    } catch (PDOException $e) {
        $response = [
            'success' => false,
            'message' => 'Erreur lors de la suppression',
            'data' => $e->getCode()
        ];
    }
 
    return $response;
 }
