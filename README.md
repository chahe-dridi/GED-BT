# GED-BT

Application GED (Gestion Électronique des Documents) pour la Banque de Tunisie.

## Prérequis

- PHP 8.x
- MySQL/MariaDB
- XAMPP (ou équivalent)

## Installation

1. Cloner le projet dans le répertoire web de XAMPP (ex: `C:\xampp\htdocs\GED-BT`).
2. Configurer la base de données dans [config/database.php](config/database.php).
3. Importer le schéma SQL (si applicable).
4. Démarrer Apache et MySQL.

## Lancer l’application

- Ouvrir: http://localhost/GED-BT/public/index.php

## Structure

- [app/controllers](app/controllers) : contrôleurs
- [app/models](app/models) : modèles
- [app/views](app/views) : vues
- [config](config) : configuration
- [public](public) : point d’entrée et uploads

## Comptes & Permissions

- Les permissions modules sont gérées via l’interface admin (Super Admin).
- Les rôles/permissions sont stockés dans les tables `users` et `permissions`.

## Notes

- Les fichiers uploadés sont stockés dans [public/uploads](public/uploads).
