<?php

function getUserCount($pdo)
{
    $sql = "SELECT COUNT(*) as total FROM users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function verifPseudo($pdo, $pseudo)
{
    $sql = "SELECT COUNT(*) FROM users WHERE pseudo = :pseudo";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn() > 0;
}

// Ajout d'un user à la bdd
function addUser($pdo, $pseudo, $nom, $prenom, $pass, $admin)
{
    try {
        // Hashage du mot de passe
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

        // Préparation de la requête
        $sql = "INSERT INTO users (pseudo, nom, prenom, password, admin) VALUES (:pseudo, :nom, :prenom, :password, :admin)";
        $stmt = $pdo->prepare($sql);

        // Exécution de la requête avec les paramètres
        $result = $stmt->execute([
            ':pseudo' => $pseudo,
            ':password' => $hashedPassword,
            ':admin' => $admin,
            ':nom' => $nom,
            ':prenom' => $prenom
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

// Connection d'un user
function userConect($pdo, $pseudo, $pass)
{
    $message = null;
    try {
        $sql = "SELECT pseudo,nom,prenom, password, admin FROM users WHERE pseudo = :pseudo LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':pseudo' => $pseudo]);


        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($pass, $user["password"])) {
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['prenom'] = $user['prenom'];
                $_SESSION['pseudo'] = $user['pseudo'];
                $_SESSION['admin'] = $user['admin'];
                $message = true;
            } else {
                $message = false;
            }
        } else {
            $message = false;
        }
    } catch (PDOException $e) {
        $message = "Erreur de base de données :(";
    }

    return $message;
}

// Vérifier si un pseudo existe
function userExist($pdo, $pseudo)
{
    $message = null;
    try {
        $sql = "SELECT COUNT(*) FROM users WHERE pseudo = :pseudo";
        $stmt = $pdo->prepare($sql);

        // Exécution de la requête
        $stmt->execute(['pseudo' => $pseudo]);

        // Récupération du résultat
        $existe = $stmt->fetchColumn() > 0;
        echo $existe;
        if ($existe) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        $message = "Erreur de base de données :(";
    }
}

// RAZ $_SESSION logIn
function razLogIn()
{
    unset($_SESSION["newUser_errorPseudo"]);
    unset($_SESSION["newUser_errorPass"]);
    unset($_SESSION["newUser_nom"]);
    unset($_SESSION["newUser_prenom"]);
    unset($_SESSION["newUser_pseudo"]);
}
