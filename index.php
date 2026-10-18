<?php
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
$tachesAffichees = []; // Tableau des tâches à afficher après application du filtre
foreach ($taches as $tache) // On parcourt toutes les tâches
{
    if ($filtre === 'toutes' ||
        ($filtre === 'restantes' && !$tache['terminee']) ||
        ($filtre === 'terminees' && $tache['terminee'])) {
        $tachesAffichees[] = $tache;
    }
}


include __DIR__ . '/includes/entete.php';
?>

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
