<?php
require __DIR__ . '/connexion.php';

$dossier = 'C:/xampp/donnees_privees';
$fichier = $dossier . '/taches.json';

// Récupérer les tâches
$stmt = $pdo->query('SELECT id_tache AS id, nom_tache AS titre, LOWER(priorite_tache) AS priorite, etat_tache AS terminee FROM taches');
$taches = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Transformer en JSON
$json = json_encode($taches, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

//  Écrire le fichier
if (!is_dir($dossier)) {
    mkdir($dossier, 0777, true);
}
if ($json === false || file_put_contents($fichier, $json) === false) {
    echo "Erreur : l'export a échoué.";
} else {
    echo "Export réussi : " . count($taches) . " tâche(s).";
}