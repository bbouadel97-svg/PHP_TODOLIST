<?php
session_start(); // démarre la session pour gérer les messages flash ou autres données de session
require __DIR__ . '/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {  // vérifie que le formulaire a été soumis via la méthode POST
    $titre = trim($_POST['titre'] ?? ''); // supprime les espaces inutiles au début et à la fin
    $priorite = ucfirst(strtolower($_POST['priorite'] ?? 'Basse')); // met la première lettre en majuscule et le reste en minuscule
    $terminee = 0; // initialise l'état de la tâche comme non terminée
    
    if (!empty($titre)) { // vérifie que le titre n'est pas vide avant d'insérer la tâche dans la base de données
        $stmt = $pdo->prepare('INSERT INTO taches (nom_tache, priorite_tache, etat_tache) VALUES (?, ?, ?)'); // prépare la requête d'insertion dans la base de données
        $stmt->execute([$titre, $priorite, $terminee]); // exécute la requête avec les valeurs fournies
        $_SESSION['message'] = 'La tâche a bien été ajoutée'; // ajoute un message flash pour indiquer que la tâche a été ajoutée
    }

}   
header('Location: index.php'); // redirige vers la page principale après l'ajout de la tâche
exit;



    