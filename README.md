# Auth System

Ce projet est un module d’authentification développé en **PHP** avec une base de données **MySQL**.

Je l’ai conçu comme un **socle réutilisable** permettant de gérer :

- l’inscription
- la connexion
- les profils utilisateurs
- un espace administrateur sécurisé

L’objectif principal est de proposer un système **clair**, **sécurisé** et **facilement maintenable**, tout en restant compréhensible dans un contexte **pédagogique** ou de **projet personnel**.

---

## Technologies utilisées

- **PHP** pour la logique applicative
- **MySQL** pour la persistance des données
- **PDO** afin de sécuriser les accès à la base de données (requêtes préparées, gestion des erreurs)
- **Bootstrap** pour la mise en page responsive et la cohérence visuelle

---

## Fonctionnalités principales

- Création de compte via un **formulaire d’inscription sécurisé**
- Connexion avec **vérification du mot de passe hashé**
- **Gestion sécurisée des sessions** utilisateurs
- Page de **profil** affichant les informations de l’utilisateur connecté
- **Modification** des informations personnelles (nom d’utilisateur, email, etc.)
- Distinction entre **utilisateurs classiques** et **administrateurs**
- Espace **administrateur** avec statistiques et liste des utilisateurs
- Protection des formulaires avec un **token CSRF**
- **Validation systématique** des données côté serveur

---

## Rôles utilisateurs

J’ai défini **deux rôles** distincts :

- `user` : utilisateur standard
- `admin` : utilisateur disposant de **droits d’administration**

Les accès aux pages sensibles sont **contrôlés côté serveur** en fonction du rôle stocké en session.

---

## Sécurité

- Utilisation de `password_hash` et `password_verify` pour garantir la sécurité des mots de passe
- Aucun mot de passe n’est **jamais stocké en clair** en base de données
- Protection des formulaires contre les attaques **CSRF**
- Validation des entrées utilisateur afin d’éviter les **injections SQL** et les données incohérentes
- **Régénération de l’identifiant de session** lors de la connexion pour limiter les risques de *session fixation*

---

## Installation locale

1. Cloner le dépôt sur la machine locale.
2. Créer une base de données **MySQL** vide.
3. Importer le fichier SQL fourni dans le dossier `schema` afin de créer la table `users`.
4. Configurer les accès à la base de données dans le fichier `config/database.php`.
5. Renseigner les constantes de connexion à MySQL selon l’environnement local.
6. Configurer le serveur local afin que le **document root** pointe vers le dossier `public`.

Si j’utilise le serveur PHP intégré, je peux lancer la commande suivante depuis la racine du projet :

```bash
php -S localhost:8000 -t public
```

Je peux ensuite accéder à l’application via l’URL suivante :

- http://localhost:8000

---

## Comment tester l’application

- Tester l’inscription en créant un **nouveau compte** via la page d’inscription.
- Après l’inscription, se connecter avec les **identifiants créés**.
- Une fois connecté, accéder à la page **profil** afin de consulter les informations utilisateur.
- Modifier le **nom d’utilisateur** et l’**email** depuis la page de modification du profil.
- Vérifier que les changements sont **immédiatement visibles** après la mise à jour.
- Tester la **déconnexion** et vérifier que l’accès aux pages protégées est bloqué après celle-ci.

---

## Tester le rôle administrateur

1. Créer un compte utilisateur via le formulaire d’inscription.
2. Modifier ensuite le rôle de cet utilisateur **directement en base de données** en passant la valeur du champ `role` à `admin`.
3. Après reconnexion, accéder à l’**espace administrateur**.
4. Consulter les **statistiques** et la **liste des utilisateurs**.
5. Vérifier que cet espace est **inaccessible** pour un utilisateur standard.

---

## Hébergement et limitations

- Ce projet utilise **PHP** et **MySQL**.
- Il ne peut pas être exécuté sur **GitHub Pages**, qui ne supporte que les sites statiques.
- Pour une démonstration fonctionnelle, il faut utiliser un **serveur local** ou un **hébergement compatible PHP et MySQL**.

---

## Auteur

C'est un projet que j'ai réalisé dans un objectif d’**apprentissage** et de **démonstration** d’un système d’authentification sécurisé.