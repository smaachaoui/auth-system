<!-- Vue Profil -->
<?php
// Je récupère les infos de l'utilisateur connecté
$user = $_SESSION['user'];
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h1 class="text-center mb-4">Mon Profil</h1>
        
        <!-- Je crée la carte utilisateur -->
        <div class="card">
            <div class="card-body">
                <!-- Avatar avec initiale -->
                <div class="text-center mb-4">
                    <div class="bg-dark text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 2rem;">
                        <?= strtoupper(substr($user['username'], 0, 1)) ?>
                    </div>
                </div>
                
                <!-- Nom d'utilisateur -->
                <div class="mb-3">
                    <strong>Nom d'utilisateur :</strong>
                    <p><?= htmlspecialchars($user['username']) ?></p>
                </div>
                
                <!-- Email -->
                <div class="mb-3">
                    <strong>Email :</strong>
                    <p><?= htmlspecialchars($user['email']) ?></p>
                </div>
                
                <!-- Rôle -->
                <div class="mb-3">
                    <strong>Rôle :</strong>
                    <p><?= $user['role'] === 'admin' ? 'Administrateur' : 'Utilisateur' ?></p>
                </div>
                
                <!-- J'affiche le lien admin si l'utilisateur est admin -->
                <?php if ($user['role'] === 'admin'): ?>
                    <a href="index.php?page=admin" class="btn btn-dark w-100 mb-2">Accéder à l'administration</a>
                <?php endif; ?>
                
                <!-- Bouton déconnexion -->
                <a href="index.php?page=logout" class="btn btn-outline-dark w-100" id="logoutBtn">Se déconnecter</a>
            </div>
        </div>
    </div>
</div>