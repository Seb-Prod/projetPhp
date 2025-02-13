<?php
session_start();
$admin = false;
if (isset($_SESSION['admin']) and $_SESSION["admin"] === 1) {
    $admin = true;
} else {
    $admin = false;
}

if(isset($_SESSION['nom']) and $_SESSION['nom'] != ""){
    $lien = "logOut.php";
    $txt = "LogOut";
}else{
    $lien = "logIn.php";
    $txt = 'LogIn';
}



?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title><?php echo $pageTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    
</head>

<body>
    <header>
        <nav>
            <ul>
                <li>
                    <a href="index.php">Accueil</a>
                    <button id="darkModeToggle">🌙 Mode Sombre</button>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo htmlspecialchars($lien); ?>"><?php echo htmlspecialchars($txt); ?></a>
                </li>
                <?php if (isset($admin) && $admin): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php">Admin</a>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- Theme switcher button - visible only on desktop -->
            <div class="d-none d-lg-block">
                <button class="btn btn-primary" id="themeSwitcher-desktop">
                    <i class="bi bi-moon-stars"></i> Changer le thème
                </button>
            </div>
        </div>
    </div>
</nav>
    </header>
    <script src="script.js"></script>
    <main>
 