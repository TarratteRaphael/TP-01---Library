# Library – Catalogue de livres (PHP / SQLite)

Application web qui présente un catalogue de livres et leurs auteurs.
Ce projet s'inscrit dans un **fil rouge** : un même site que l'on fait évoluer au fil des exercices. Le site était déjà fonctionnel au départ, mais sa structure de fichiers était mal organisée. Cette étape consistait à **implémenter l'architecture MVC**, sans changer ses fonctionnalités, pour le rendre plus lisible et plus facile à faire évoluer.

---

## Note d'intention

### Objectif

Le projet de départ fonctionnait, mais il reposait sur des pages indépendantes (une page pour la liste, une pour un livre, une pour un auteur, une pour la suppression) dont l'organisation n'était pas adaptée.

Mon travail a consisté à ajouter les fichiers nécessaires à l'architecture MVC et à supprimer les anciennes pages devenues inutiles. Ma proposition est de **séparer les responsabilités** :

- les **models** parlent à la base de données ;
- les **controllers** vérifient les paramètres, appellent les models et préparent les données ;
- les **templates** affichent uniquement le HTML ;
- un **point d'entrée unique** (`index.php`) décide quel controller appeler.

### Proposition de modélisation

La base de données SQLite contient deux tables reliées par une clé étrangère.

**`authors`**

| Champ       | Type                | Rôle                    |
| ----------- | ------------------- | ----------------------- |
| `id`        | INTEGER, clé primaire | Identifiant de l'auteur |
| `name`      | varchar(255)        | Nom de l'auteur         |
| `biography` | text                | Biographie              |

**`books`**

| Champ         | Type                | Rôle                                 |
| ------------- | ------------------- | ------------------------------------ |
| `id`          | INTEGER, clé primaire | Identifiant du livre                 |
| `title`       | varchar(255)        | Titre                                |
| `subtitle`    | varchar(255)        | Sous-titre                           |
| `author_id`   | integer, clé étrangère | Référence vers `authors.id`          |
| `published`   | date                | Date de publication                  |
| `publisher`   | varchar(255)        | Éditeur                              |
| `pages`       | integer             | Nombre de pages                      |
| `description` | text                | Résumé                               |
| `website`     | varchar(255)        | Lien vers le site du livre           |

**Relation** : un auteur peut avoir écrit plusieurs livres, et chaque livre est rattaché à un seul auteur (relation un-à-plusieurs). Un index est posé sur `books.author_id` pour accélérer la récupération des livres d'un auteur.

**Limite connue et évolution possible** : certains livres ont plusieurs auteurs (par exemple *Pro Git*). Dans cette version, ils sont enregistrés comme une seule ligne dans `authors` (« Scott Chacon and Ben Straub »). Une évolution propre serait une table de liaison `book_author` (relation plusieurs-à-plusieurs).

---

## Nouvelle structure du code

```
/
├── index.php            # Point d'entrée et routeur
├── config/
│   └── config.php       # Constante DOCUMENT_ROOT
├── database/
│   └── db_connect.php   # Connexion PDO à SQLite
├── models/
│   ├── authors.php      # Requêtes SQL sur les auteurs
│   └── books.php        # Requêtes SQL sur les livres
├── controllers/
│   ├── authors.php      # Logique de la page auteur
│   └── books.php        # Logique des pages livres (liste, détail, suppression)
├── templates/
│   ├── partials/        # header.php et footer.php communs
│   ├── authors/         # showAuthors.php
│   └── books/           # index.php (liste) et showBooks.php (détail)
└── assets/
    ├── css/             # Feuilles de style (SCSS compilé en CSS)
    ├── js/              # scripts.js (confirmation de suppression)
    ├── img/             # Logo
    └── sql/             # Base SQLite
```

### Fonctionnement

1. Toutes les requêtes passent par `index.php`.
2. `index.php` charge la configuration, la connexion à la base, les models et les controllers, puis lit le paramètre `page` de l'URL.
3. Un `match` appelle le controller correspondant :

| URL                    | Controller         | Résultat                                  |
| ---------------------- | ------------------ | ----------------------------------------- |
| `index.php`            | `listBookCtrl()`   | Liste de tous les livres                  |
| `?page=book&id=3`      | `showBookCtrl()`   | Détail d'un livre                         |
| `?page=author&id=2`    | `showAuthorCtrl()` | Page d'un auteur et de ses livres         |
| `?page=delete` (POST)  | `deleteBookCtrl()` | Suppression d'un livre puis redirection   |

4. Le controller vérifie les paramètres, appelle le model, prépare `$title` et `$heading`, puis inclut le template.
5. Le template affiche les données dans le HTML.

### Sécurité et qualité

- **Requêtes préparées** (PDO) pour éviter les injections SQL.
- **Validation des identifiants** reçus dans l'URL (`ctype_digit`) avant toute requête.
- **Échappement de l'affichage** avec `htmlspecialchars` dans les templates.
- **Suppression en POST** avec **confirmation** via SweetAlert2.
- **Erreur 404** si un livre ou un auteur n'existe pas.
- Fonctions **documentées** avec des commentaires PHPDoc.

---

## Fonctionnalités

Les fonctionnalités du site de départ sont conservées avec la nouvelle structure :

- Afficher le catalogue des livres, triés par titre.
- Consulter la fiche détaillée d'un livre (sous-titre, description, éditeur, date, pages, site).
- Consulter la page d'un auteur avec sa biographie et la liste de ses ouvrages.
- Supprimer un livre après confirmation.

---

## Installation

1. Cloner le dépôt et se placer dans le dossier du projet.
2. Vérifier que l'extension PHP `pdo_sqlite` est activée.
3. La base se trouve dans `assets/sql/database.sqlite`. Elle peut être recréée avec le script `library.sql`.
4. Lancer un serveur local depuis la racine du projet :

```bash
php -S localhost:8000
```

5. Ouvrir `http://localhost:8000/index.php`.

---

## Historique du développement

La restructuration a été réalisée sur la branche `refactor/mvc`, en ajoutant les nouveaux fichiers MVC et en retirant les anciens, par étapes :

1. **Mise en place de la structure** : création des models et controllers pour les auteurs et les livres, puis des templates (header, footer, auteurs, livres).
2. **Récupération des données** : fonctions de lecture (`getAuthor`, `getAuthorsBooks`, `getBook`, `getAllBooks`) et correction des paramètres des requêtes.
3. **Gestion des erreurs et de la validation** : vérification des identifiants, messages d'erreur, ajout de la suppression d'un livre (`getDeleteBook`).
4. **Routage** : initialisation de `index.php` avec la connexion à la base et les imports des controllers, puis réécriture du routage pour plus de lisibilité.
5. **Nettoyage** : suppression des anciennes pages devenues inutiles, harmonisation des chemins de fichiers et des noms de variables.
6. **Documentation** : clarification des commentaires dans les models et les controllers.
