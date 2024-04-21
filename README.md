## Documentation de l'API - Spectacles

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
