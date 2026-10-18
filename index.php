<?php
session_start(); // démarre la session pour gérer les messages flash ou autres données de session
// __DIR__ désigne le dossier de ce fichier, quel que soit le dossier de lancement.
require __DIR__ . '/donnees.php';
require __DIR__ . '/fonctions.php';

$titrePage = 'Ma liste de tâches';
$total = count($taches);
$restantes = compterTachesRestantes($taches);
$terminees = $total - $restantes;
    
$filtre = $_GET['filtre'] ?? 'toutes'; // Filtre par défaut 
if(!in_array($filtre, ['toutes', 'restantes', 'terminees'])) { // Si le filtre n'est pas valide, on remet le filtre par défaut
    $filtre = 'toutes'; // On remet le filtre par défaut
}
// Requête SQL adaptée au filtre (la valeur est transmise via une requête préparée)
$sql = 'SELECT id_tache AS id, nom_tache AS titre, LOWER(priorite_tache) AS priorite, etat_tache AS terminee FROM taches';
$parametres = [];
if ($filtre !== 'toutes') {
    $sql .= ' WHERE etat_tache = :etat';
    $parametres['etat'] = $filtre === 'terminees' ? 1 : 0;
}
$stmtFiltre = $pdo->prepare($sql); // prépare la requête SQL avec les paramètres éventuels
$stmtFiltre->execute($parametres); // exécute la requête SQL avec les sous-paramètres fournis
$tachesAffichees = $stmtFiltre->fetchAll(); // récupère toutes les tâches correspondant au filtre
 
$messageFlash = $_SESSION['message'] ?? '';
unset($_SESSION['message']); // supprime le message flash après l'avoir récupéré
$theme = ($_COOKIE['theme'] ?? '') === 'sombre' ? 'sombre' : 'clair'; // Détermine le thème actuel, par défaut 'clair' sans cookie défini
include __DIR__ . '/includes/entete.php';
?>
<form action="theme.php" method="post"> 
    <button type="submit" name="theme" value="clair">Clair</button> 
    <button type="submit" name="theme" value="sombre">Sombre</button>
</form>
<?php if ($messageFlash): // Affiche le message flash s'il existe ?>
    <p class="message"><?= echapper($messageFlash) ?></p>
<?php endif; ?>

<section class="statistiques" aria-label="Résumé des tâches">
    <div><strong><?= $total ?></strong><span>Au total</span></div>
    <div><strong><?= $restantes ?></strong><span>À faire</span></div>
    <div><strong><?= $terminees ?></strong><span>Terminées</span></div>
</section>
<!-- inclusion du formulaire d'ajout de tâche -->
<?php include __DIR__ . '/formulaire.php'; ?>

<section class="liste" aria-labelledby="titre-liste">
    <h2 id="titre-liste">Mes tâches</h2>
    <nav class="filtres">
        <a href="index.php?filtre=toutes" class="<?= $filtre === 'toutes' ? 'active' : '' ?>">Toutes</a>
        <a href="index.php?filtre=restantes" class="<?= $filtre === 'restantes' ? 'active' : '' ?>">À faire</a>
        <a href="index.php?filtre=terminees" class="<?= $filtre === 'terminees' ? 'active' : '' ?>">Terminées</a>
    </nav>
    <?php if (empty($tachesAffichees)): ?>
        <p class="message">Aucune tâche pour le moment.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($tachesAffichees as $tache): ?>
                <li class="tache <?= $tache['terminee'] ? 'terminee' : '' ?>">
                    <div>
                        <h3><?= echapper($tache['titre']) ?></h3>
                        <p>Priorité : <?= echapper(libellePriorite($tache['priorite'])) ?></p>
                    </div>
                    <span class="etat"><?= $tache['terminee'] ? 'Terminée' : 'À faire' ?></span>
                </li>
            
            <?php endforeach; ?> 
        </ul>
        <?php if ($restantes === 0): ?>
            <p class="message">Bravo, toutes les tâches sont terminées !</p>
        <?php endif; ?>
    <?php endif; ?>
</section>


<?php include __DIR__ . '/includes/pied.php'; ?>
