<!-- Vue Déconnexion -->
<?php
// Je détruis la session
session_destroy();

// Je redirige vers l'accueil
header('Location: index.php');
exit;
?>