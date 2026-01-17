<?php
// Je démarre la session
session_start();

// Je récupère la page demandée via l'URL
$page = $_GET['page'] ?? 'home';

// Je définis les pages autorisées
$allowedPages = ['home', 'login', 'register', 'profile', 'admin', 'logout'];

// Je vérifie si la page demandée existe
if (!in_array($page, $allowedPages)) {
    $page = 'home';
}

// Je définis les titres des pages
$pageTitles = [
    'home' => 'Accueil',
    'login' => 'Connexion',
    'register' => 'Inscription',
    'profile' => 'Mon Profil',
    'admin' => 'Administration'
];
$pageTitle = $pageTitles[$page] ?? 'Auth Module';

// J'inclus le header
include '../assets/components/header.php';

// J'inclus la vue demandée
include '../assets/views/' . $page . '.php';

// J'inclus le footer
include '../assets/components/footer.php';
?>