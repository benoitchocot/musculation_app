# Application de Suivi de Musculation

Cette application permet de suivre vos entrées d'exercices de musculation. Elle utilise PHP et SQLite pour stocker les données.

## Prérequis

- PHP 7.4 ou supérieur
- SQLite

## Installation

1. Clonez le dépôt sur votre machine locale :

    ```bash
    git clone https://github.com/votre-utilisateur/votre-repo.git
    cd votre-repo
    ```

2. Installez les dépendances (si nécessaire) :

    ```bash
    composer install
    ```

3. Initialisez la base de données :

    ```bash
    php setup.php
    ```

## Utilisation

1. Démarrez le serveur PHP intégré :

    ```bash
    php -S localhost:8000
    ```

2. Ouvrez votre navigateur et accédez à l'URL suivante :

    ```
    http://localhost:8000
    ```

## Fonctionnalités

- Ajouter des entrées d'exercices
- Voir les entrées d'exercices
- Modifier et supprimer des entrées

## Demarrage rapide

Une image [docker](https://docs.docker.com/) et un fichier [compose](https://docs.docker.com/compose/) minimale est disponible pour démarrer rapidement l'application, pratique pour déployer ou pour éviter d'installer les dépendances:

```bash
docker compose up
```

## Contribuer

Les contributions sont les bienvenues ! Veuillez soumettre une pull request ou ouvrir une issue pour discuter des changements que vous souhaitez apporter.

## Licence

Ce projet est sous licence MIT. Voir le fichier LICENSE pour plus de détails.
