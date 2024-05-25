## Documentation de l'API - Spectacles

### Installation

1. Cloner le dépôt git
2. Installer les dépendances
```bash
composer install
```
3. Créer un fichier `.env` à partir du fichier `.env.example`
4. Générer une clé d'application
```bash
php artisan key:generate
```
5. Créer une base de données et configurer les informations de connexion dans le fichier `.env`
6. Exécuter les migrations
```bash
php artisan migrate
```
7. Exécuter les seeders
```bash
php artisan db:seed
```
8. Démarrer le serveur
```bash
php artisan serve
```

### API Sanctum : step 0 

### API Sanctum : step 1 CSRF token
Avant de pouvoir effectuer une requête POST, PUT ou DELETE, il faut d'abord obtenir le xsrf-token
http://127.0.0.1:8000/api/sanctum/csrf-cookie

### API Sanctum : step 2 Login
Ajouter un utilisateur dans Authorization -> Basic Auth
Username :
Password :
http://127.0.0.1:8000/api/login

### API Sanctum : step 3 Logout
http://127.0.0.1:8000/api/logout

### API Sanctum : step 4 POST, PUT, DELETE
Ajouter le xsrf-token dans les headers de la requête
```json
{
    "Accept": "application",
    "Content-Type": "application/json",
    "X-XSRF-TOKEN": "xsrf-token"
}
```

## Endpoints

| Méthode | Endpoint             | Description                        |
|---------|----------------------|------------------------------------|
| GET     | `/api/show`          | Récupérer la liste des spectacles  |
| POST    | `/api/show`          | Ajouter un nouveau spectacle       |
| GET     | `/api/show/{id}`     | Afficher les détails d'un spectacle|
| PUT     | `/api/show/{id}`     | Mettre à jour un spectacle         |
| DELETE  | `/api/show/{id}`     | Supprimer un spectacle             |

| Méthode | URL                          | Query à ajouter            | Exemple de Query                  | Action                      |
|---------|------------------------------|----------------------------|-----------------------------------|-----------------------------|
| GET     | `/api/show`                  | `per_page`                 | `?per_page=10`                    | Afficher tous les spectacles |
| GET     | `/api/show/{id}`             |                            |                                   | Afficher les détails        |
| GET     | `/api/show/search`           | `search`                   | `?q=NomDuSpectacle`               | Rechercher par titre        |


## GET /api/show

### Réponses

| Code HTTP | Description           | Contenu de la réponse               |
|-----------|-----------------------|-------------------------------------|
| 200       | OK                    | Liste des spectacles au format JSON |
| 404       | Not Found             | Aucun spectacle trouvé              |
| 500       | Internal Server Error | Erreur interne du serveur           |

### Exemple de réponse (Code 200)

```json
[
    {
        "id": 1,
        "titre": "Spectacle 1",
        "description": "Description du spectacle 1",
        "date": "2024-04-17",
        "heure": "20:00",
        "lieu": "Lieu du spectacle 1"
    },
    {
        "id": 2,
        "titre": "Spectacle 2",
        "description": "Description du spectacle 2",
        "date": "2024-04-18",
        "heure": "19:30",
        "lieu": "Lieu du spectacle 2"
    }
]
```

### API theatre-contemporain.net et theatre-video.net 
Le point d'entrée de l'API theatre-contemporain.net est https://www.theatre-contemporain.net/api/
https://www.ressources-theatre.net/doc/api/ 

TODO : faire la page de documentation de l'API
fait le 3/05 TODO : faire une table db pour les archives des representations

TODO : http://127.0.0.1:8000/representation/6
fix le 05/05 TODO : fix bug representation/id url incorrect dans le fichier web.php

TODO : faire la page de documentation de l'API
TODO : faire la page contact et theatre salle de spectacle
fait le 3/05 page contat
TODO : ternimer le panel admin pour les spectacles très simples

TODO : ne pas afficher dans show show un spectale deja passé !!!
TODO : tag refaire bien
fait le 25/05 tag parfait sauf remove

TODO : la review en modal propre
TODO : refaire la partie review sans modal apres time, le faire via un simple bouton et un espace commentaire

