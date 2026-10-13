<?php
require __DIR__ . '/connexion.php';

$stmt = $pdo->query('
    SELECT 
        id_tache AS id,
        nom_tache AS titre,
        LOWER(priorite_tache) AS priorite,
        etat_tache AS terminee
    FROM taches
');
$taches = $stmt->fetchAll();


