# Atelier 5 : Programmation Asynchrone

## Objectif
L'objectif principal de cet atelier est de se familiariser avec les concepts de la programmation asynchrone en JavaScript, notamment les Promises, `fetch`, et les interactions avec une API Laravel. Les exercices couvrent également l'utilisation de WebSockets pour des mises à jour en temps réel.

---

## Exercice 1 : Gestion des données utilisateur
### Initialisation de la Récupération des Données: 

Lorsque l'utilisateur sélectionne l'option "Voir Profil", une fonction asynchrone appelée recupererDonneesUtilisateur est activée.
Cette fonction simule une attente de 3 secondes à l'aide de setTimeout(), pendant lesquelles les informations de l'utilisateur sont récupérées en arrière-plan.
Durant ce délai, un message "Chargement des informations..." s'affiche pour informer l'utilisateur que l’opération est en cours.
### Présentation du Profil:

Une fois les données récupérées avec succès, celles-ci sont instantanément affichées à l'écran, présentant les informations de l'utilisateur de manière claire et détaillée.
### Récupération et Affichage des Commandes: 
Après avoir affiché le profil, un autre processus de récupération des commandes de l'utilisateur est lancé.
Un message "Chargement des commandes..." est affiché durant cette phase.
Une fois les données des commandes obtenues, elles sont affichées dans un tableau organisé, prêt à être consulté par l'utilisateur.
Ajouter plus de données à l'objet utilisateur (ex: login, mot de passe, adresse, etc.) et les afficher dans un tableau.
Enchaîner les Promises pour simuler une séquence d'actions asynchrones (ex : récupérer les données utilisateur puis leurs commandes).

---

## Exercice 2 : Interaction avec une API Laravel - Téléchargement de fichiers
### Instructions
- Création du formulaire de téléchargement:
Utiliser la vue welcome pour afficher un formulaire permettant de télécharger des fichiers.
- Implémentation du téléchargement de fichiers: 
Utiliser fetch() dans le fichier upload.js pour envoyer une requête POST avec le fichier sélectionné vers la route /upload.
- Récupération des fichiers:
Utiliser fetch() pour récupérer la liste des fichiers via la route /files.
Les fichiers sont affichés dynamiquement dans la vue welcome.
- Suppression des fichiers
La fonction deleteFile() permet de supprimer un fichier via la route /file/delete/{id} en envoyant une requête DELETE.
- Routes configurées dans web.php:
/ → Affiche la vue welcome.
/upload → Gère le téléchargement des fichiers via FileController@upload.
/files → Récupère la liste des fichiers via FileController@getFiles.
/file/delete/{id} → Supprime un fichier spécifique.
Fichiers pertinents :
- welcome.blade.php
- upload.js
- web.php
- FileController.php
  
---

## Exercice 3 : Gestion des salles avec une API Laravel
### Instructions:
- Créer une migration pour la table rooms avec les colonnes suivantes :
id
name
capacity
- Implémenter les méthodes CRUD dans le RoomController.
- Configurer les routes dans le fichier web.php pour gérer les différentes opérations CRUD:
  Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('rooms.show');
Route::put('/rooms/{id}', [RoomController::class, 'update'])->name('rooms.update');
Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])->name('rooms.destroy');

- Créer une interface utilisateur simple avec :
- Un affichage des salles basé sur la vue welcome, qui présente :La liste des salles avec leur nom et capacité.
- Des options pour ajouter, modifier ou supprimer une salle.
  Acceder a l'app : http://127.0.0.1:8000/rooms
---

## Exercice 4 : Suivi des stocks en temps réel avec WebSockets
### Instructions
Configuration de Pusher et Laravel WebSockets
- Fichier .env :
PUSHER_APP_ID=your-app-id
PUSHER_APP_KEY=your-app-key
PUSHER_APP_SECRET=your-app-secret
PUSHER_APP_CLUSTER=mt1
PUSHER_HOST=127.0.0.1
PUSHER_PORT=6001
PUSHER_SCHEME=http
- Fichier config/broadcasting.php
- Implémentation des WebSockets et Pusher
Création d’un événement StockUpdated déclenché lors de l’ajout, la mise à jour ou la suppression d’un stock.
- StockController
Émission des événements vers Pusher lors des opérations CRUD sur les stocks.
- Affichage des Stocks avec Highcharts
Intégration de Highcharts et Pusher.
Affichage des stocks sous forme de graphique.
Écoute des événements avec Pusher et mise à jour du graphique en temps réel.
- Accéder à l’application: http://127.0.0.1:8000/stocks
