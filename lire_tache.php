<?php
require __DIR__ . '/fonctions.php';

$fichier = 'C:/xampp/donnees_privees/taches.json';

// on verifie est ce que le fichier existe ?
if (!file_exists($fichier)) {
    echo "Le fichier taches.json est introuvable. Lancez d'abord l'export.";
    exit;
}

// on lit le contenu du fichier JSON
$contenu = file_get_contents($fichier);

// on transforme le JSON en tableau PHP
$taches = json_decode($contenu, true);
if (!is_array($taches)) {
    echo "Le fichier JSON est invalide.";
    exit;
}

// on affiche les titres échappés
echo '<ul>';
foreach ($taches as $tache) {
    echo '<li>' . echapper($tache['titre']) . '</li>';
}
echo '</ul>';