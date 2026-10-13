<?php
require __DIR__ . '/connexion.php';

$stmt = $pdo->query('SELECT * FROM taches');
$taches = $stmt->fetchAll();
