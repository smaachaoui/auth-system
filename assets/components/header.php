<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Je définis l'encodage des caractères en UTF8 -->
    <meta charset="UTF-8">

    <!-- Je configure le viewport pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Je définis le titre de la page -->
    <title><?= $pageTitle ?? 'Module de connexion' ?></title>
    
    <!-- J'importe Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- J'importe mes styles personnalisés -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<!-- Header -->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-black">
        <div class="container">
            <!-- Je crée le logo cliquable -->
            <a class="navbar-brand" href="index.php">AuthModule</a>
            
            <!-- Je crée le bouton burger pour mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Je crée le menu de navigation -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Accueil</a>
                    </li>
                    
                    <!-- J'affiche les liens selon l'état de connexion -->
                    <?php if (isset($_SESSION['user'])): ?>
                        <!-- Je suis connecté -->
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=profile">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=logout">Déconnexion</a>
                        </li>
                    <?php else: ?>
                        <!-- Je ne suis pas connecté -->
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=login">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=register">Inscription</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Contenu principal -->
<main class="container py-4">