# Auth System

Ce projet est un module d’authentification développé en PHP avec une base de données MySQL.
Je l’ai conçu comme un socle réutilisable permettant de gérer l’inscription, la connexion, les profils utilisateurs et un espace administrateur sécurisé.

L’objectif principal est de proposer un système clair, sécurisé et facilement maintenable, tout en restant compréhensible dans un contexte pédagogique ou de projet personnel.

## Technologies utilisées

J’ai utilisé PHP pour la logique applicative et MySQL pour la persistance des données.
J’ai utilisé PDO afin de sécuriser les accès à la base de données.
J’ai utilisé Bootstrap pour la mise en page responsive et la cohérence visuelle.

## Fonctionnalités principales

Je permets à un utilisateur de créer un compte via un formulaire d’inscription sécurisé.
Je permets à un utilisateur de se connecter avec vérification du mot de passe hashé.
Je gère les sessions utilisateurs de manière sécurisée.
Je propose une page de profil affichant les informations de l’utilisateur connecté.
Je permets à l’utilisateur de modifier ses informations personnelles.
Je distingue les utilisateurs classiques des administrateurs.
Je propose un espace administrateur avec des statistiques et une liste des utilisateurs.
Je protège les formulaires avec un token CSRF.
Je valide systématiquement les données côté serveur.

## Rôles utilisateurs

J’ai défini deux rôles distincts.
Le rôle user correspond à un utilisateur standard.
Le rôle admin correspond à un utilisateur disposant de droits d’administration.

Les accès aux pages sensibles sont contrôlés côté serveur en fonction du rôle stocké en session.

## Sécurité

J’ai choisi d’utiliser password_hash et password_verify pour garantir la sécurité des mots de passe.
Je ne stocke jamais de mot de passe en clair en base de données.
Je protège les formulaires contre les attaques CSRF.
Je valide les entrées utilisateur afin d’éviter les injections SQL et les données incohérentes.
Je régénère l’identifiant de session lors de la connexion pour limiter les risques de session fixation.

## Installation

Je commence par créer une base de données MySQL.
J’importe le fichier SQL fourni pour créer la table users.
Je configure les accès à la base de données dans le fichier database.php.
Je place le dossier public comme point d’entrée du serveur.
Je lance le projet via un serveur local compatible PHP.

## Accès administrateur

Je peux créer un compte via l’inscription puis modifier le rôle en base de données pour le passer en admin.
Je peux ensuite accéder à l’interface d’administration après connexion.

## Auteur

Projet réalisé par moi dans un objectif d’apprentissage et de démonstration d’un système d’authentification sécurisé.
