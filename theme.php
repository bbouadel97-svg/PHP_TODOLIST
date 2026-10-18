<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') // Vérifie que le formulaire a été soumis via la méthode POST
{ 
    $choix = $_POST['theme'] ?? '';
    if (in_array($choix, ['clair', 'sombre'], true)) // Vérifie que le choix est soit 'clair' soit 'sombre'
    {
        setcookie('theme', $choix, time() + 7 * 24 * 3600, '/');
    }
}
header('Location: index.php');
exit;