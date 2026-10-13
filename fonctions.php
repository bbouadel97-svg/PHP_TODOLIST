<?php

// Une fonction retourne une valeur : elle ne l'affiche pas automatiquement.
function compterTachesRestantes(array $taches): int
{
    $nombre = 0;
    foreach ($taches as $tache) {
        if ($tache['terminee'] === false) {
            $nombre++;
        }
    }
    return $nombre;
}

function libellePriorite(string $priorite): string
{
    if ($priorite === 'haute') {
        return 'Haute';
    } elseif ($priorite === 'moyenne') {
        return 'Moyenne';
    }
    return 'Basse';
}

// Échapper le texte au moment de l'insérer dans du HTML.
function echapper(string $texte): string
{
    return htmlspecialchars($texte, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
