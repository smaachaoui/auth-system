<!-- Vue Administration -->
<?php
// Je redirige si l'utilisateur n'est pas connecté
if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit;
}

// Je redirige si l'utilisateur n'est pas admin
if ($_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php?page=profile');
    exit;
}
?>

<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Administration</h1>
        
        <!-- Je crée les cartes de statistiques -->
        <div class="row mb-4">
            <!-- Total utilisateurs -->
            <div class="col-md-4">
                <div class="card bg-dark text-white">
                    <div class="card-body text-center">
                        <h3 id="totalUsers">0</h3>
                        <p class="mb-0">Utilisateurs</p>
                    </div>
                </div>
            </div>
            
            <!-- Total admins -->
            <div class="col-md-4">
                <div class="card bg-dark text-white">
                    <div class="card-body text-center">
                        <h3 id="totalAdmins">0</h3>
                        <p class="mb-0">Administrateurs</p>
                    </div>
                </div>
            </div>
            
            <!-- Nouveaux utilisateurs -->
            <div class="col-md-4">
                <div class="card bg-dark text-white">
                    <div class="card-body text-center">
                        <h3 id="newUsers">0</h3>
                        <p class="mb-0">Nouveaux (7j)</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Je crée le tableau des utilisateurs -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Liste des utilisateurs</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom d'utilisateur</th>
                                <th>Email</th>
                                <th>Rôle</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="usersTableBody">
                            <!-- Les utilisateurs seront chargés ici -->
                            <tr>
                                <td colspan="5" class="text-center">Chargement...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>