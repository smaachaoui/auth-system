/*
 * Création de la base de données auth_module
 * 
 * Je crée la structure de la base de données pour le module d'authentification
 * Table : users (id, username, email, password, role, created_at, updated_at)
 */

-- Je crée la base de données si elle n'existe pas
CREATE DATABASE IF NOT EXISTS auth_module
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- Je sélectionne la base de données
USE auth_module;

-- Je supprime la table users si elle existe déjà
DROP TABLE IF EXISTS users;

-- Je crée la table users
CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uk_username (username),
    UNIQUE KEY uk_email (email),
    INDEX idx_role (role),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
