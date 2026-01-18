Voici ton texte réécrit en Markdown propre, structuré et cohérent :

```markdown
# Documentation technique – Auth System

## Présentation générale

J’ai développé ce projet comme un module d’authentification complet en **PHP** et **MySQL**.

Je l’ai conçu pour répondre aux besoins classiques de **gestion des utilisateurs** tout en respectant des principes de **sécurité** et de **maintenabilité**.

J’ai volontairement privilégié une **architecture simple et lisible** afin de faciliter la compréhension du code.

Ce module permet :

- l’inscription
- la connexion
- la gestion des sessions
- l’affichage du profil utilisateur
- la modification des informations personnelles
- l’accès à un espace administrateur sécurisé

---

## Organisation du projet

J’ai structuré le projet afin de **séparer clairement les responsabilités**.

- Le dossier `config` contient la configuration de la base de données.
- Le dossier `public` contient le point d’entrée de l’application ainsi que les ressources accessibles publiquement.
- Le dossier `assets` contient les modèles, les contrôleurs et les vues.
- Le dossier `schema` contient le script SQL de création de la base de données.

Cette organisation me permet de limiter l’exposition des fichiers sensibles et de maintenir une structure cohérente.

---

## Arborescence du projet

```bash
auth-system/
├── config/
│   └── database.php
├── public/
│   ├── index.php
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── main.js
│   └── img/
├── assets/
│   ├── controllers/
│   │   └── AuthController.php
│   ├── models/
│   │   └── User.php
│   └── views/
│       ├── components/
│       │   ├── header.php
│       │   └── footer.php
│       ├── home.php
│       ├── login.php
│       ├── register.php
│       ├── profile.php
│       ├── edit_profile.php
│       └── admin.php
└── schema/
    └── auth_module.sql
```

---

## Base de données

J’ai créé une base de données MySQL contenant une table `users`.

Cette table stocke les informations nécessaires à :

- l’authentification
- la gestion des rôles

Caractéristiques principales :

- Contrainte d’unicité sur le **nom d’utilisateur** et l’**email** (éviter les doublons).
- Champ `role` pour distinguer les utilisateurs standards des administrateurs.
- Champs de date pour suivre la **création** et la **mise à jour** des comptes.

### Schéma SQL

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE (username),
    UNIQUE (email)
);
```

---

## Connexion à la base de données

J’ai centralisé la connexion PDO dans le fichier `config/database.php`.

- Utilisation de **PDO** pour bénéficier des requêtes préparées et d’une meilleure gestion des erreurs.
- Configuration de PDO pour **lever des exceptions** en cas d’erreur.
- Désactivation de l’**émulation des requêtes préparées** pour renforcer la sécurité.

```php
function getDatabase(): ?PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;

        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    }

    return $pdo;
}
```

---

## Architecture MVC simplifiée

J’ai mis en place une architecture **MVC simplifiée** adaptée à un projet PHP sans framework.

- Le fichier `public/index.php` agit comme **contrôleur frontal**.
- Le contrôleur `AuthController` contient la **logique métier liée à l’authentification**.
- Le modèle `User` gère exclusivement les **interactions avec la base de données**.
- Les vues affichent les données **sans contenir de logique métier**.

---

## Point d’entrée et routage

Le fichier `public/index.php` est le **point d’entrée unique** de l’application.

- Démarrage de la session.
- Inclusion des dépendances.
- Instanciation du contrôleur.
- Récupération de la page demandée via le paramètre `page` dans l’URL.
- Vérification de cette valeur avec une **liste blanche** de pages autorisées pour éviter toute inclusion arbitraire.

```php
$page = $_GET['page'] ?? 'home';

$allowedPages = [
    'home',
    'login',
    'register',
    'profile',
    'edit_profile',
    'admin',
    'logout',
];

if (!in_array($page, $allowedPages)) {
    $page = 'home';
}
```

---

## Modèle `User`

La classe `User` est responsable de toutes les opérations liées aux utilisateurs en base de données :

- Création des utilisateurs avec un **mot de passe hashé**.
- Récupération d’un utilisateur par **email** ou par **identifiant**.
- Vérification de l’existence d’un email ou d’un nom d’utilisateur.
- Mise à jour des informations personnelles.
- Gestion des rôles utilisateurs.
- Fourniture de statistiques pour l’espace administrateur.

### Création d’un utilisateur

```php
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
```

---

## Contrôleur `AuthController`

Le contrôleur `AuthController` centralise toute la logique liée à l’authentification :

- Gestion de l’inscription avec **validation des données**.
- Gestion de la connexion avec **vérification du mot de passe hashé**.
- Création et destruction des **sessions utilisateur**.
- Vérification de l’**état de connexion**.
- Vérification du **rôle administrateur**.
- Gestion de la **modification du profil** utilisateur.
- Retour systématique de tableaux contenant `success`, `error` ou `message` afin de simplifier l’affichage côté vue.

---

## Sécurité des mots de passe

- Aucun mot de passe n’est stocké en clair.
- Utilisation de `password_hash` pour générer un hash sécurisé.
- Vérification du mot de passe avec `password_verify` lors de la connexion.

```php
if (!password_verify($password, $user['password'])) {
    return ['success' => false, 'error' => 'Email ou mot de passe incorrect.'];
}
```

---

## Gestion des sessions

- Utilisation des **sessions PHP** pour gérer l’état de connexion.
- Stockage uniquement des **informations nécessaires** en session.
- **Régénération de l’identifiant de session** après une connexion réussie afin de limiter la fixation de session.

---

## Protection CSRF

J’ai mis en place une protection **CSRF** sur tous les formulaires sensibles.

Principe :

1. Génération d’un token aléatoire stocké en session.
2. Inclusion de ce token dans chaque formulaire.
3. Vérification de sa validité avant tout traitement.

```php
$token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $token;

if (!$this->verifyCsrfToken($csrfToken)) {
    return ['success' => false, 'error' => 'Session expirée, veuillez réessayer.'];
}
```

---

## Validation des données

- Validation systématique des données côté serveur.
- Vérification de la présence des champs obligatoires.
- Contrôle du **format** et de la **longueur** des valeurs.
- Blocage de toute action si les données sont invalides.

---

## Vues et affichage

- Les vues contiennent uniquement de l’**HTML** et des **instructions PHP minimales**.
- Aucune logique métier n’est intégrée dans les vues.
- Utilisation de **Bootstrap** pour garantir une interface responsive.
- Protection de tous les affichages dynamiques avec `htmlspecialchars` afin d’éviter les **injections HTML**.

---

## Profil utilisateur et modification du profil

- La page `profile` est accessible uniquement aux **utilisateurs connectés**.
  - Affichage des informations stockées en session.
- La page `edit_profile` permet de modifier le **nom d’utilisateur** et l’**email**.
  - Vérification de l’unicité des données en excluant l’utilisateur courant.
  - Mise à jour de la session après la mise à jour en base afin que les changements soient visibles immédiatement.

---

## Administration

L’espace administrateur est protégé par une **vérification du rôle**.

- Blocage de l’accès aux utilisateurs ne possédant pas le rôle `admin`.
- Fourniture de **statistiques globales**.
- Liste des utilisateurs existants.
- Séparation claire entre l’interface **administrateur** et l’interface **utilisateur**.

---

## Tests de sécurité réalisés

J’ai réalisé plusieurs tests :

- Accès aux pages protégées **sans être connecté**.
- Accès à l’administration avec un **utilisateur standard**.
- Envoi de formulaires **sans token CSRF**.
- Modification du profil avec des **données existantes**.
- Vérification que **toutes les sorties sont échappées**.

---

## Conclusion

J’ai conçu ce module comme une **base fiable et sécurisée** pour un système d’authentification.

J’ai privilégié :

- la **clarté du code**
- la **sécurité**
- la **séparation des responsabilités**