# To-do list PHP — Première séance

Version corrigée pour découvrir PHP, sans dépendance, JavaScript ni base de données.
Les tâches sont définies dans un tableau : cette version affiche la liste, les états,
les priorités et les compteurs. L'ajout, la modification et la suppression se font
dans le code. Les formulaires et PDO seront abordés dans la séance suivante.

## Lancer le projet

PHP 8 ou supérieur doit être installé et accessible dans le terminal.
Ouvrir un terminal dans le dossier `todolist-php`, puis exécuter :

```bash
php -S localhost:8000
```

Ouvrir http://localhost:8000 dans le navigateur. Arrêter le serveur avec Ctrl+C.
Avec XAMPP : placer le dossier dans `htdocs`, démarrer Apache, puis ouvrir
http://localhost/todolist-php/ (adapter le port si nécessaire).
Avec MAMP : utiliser le dossier racine et le port configurés dans MAMP.
Ne pas ouvrir index.php par double-clic et ne pas utiliser Live Server pour PHP.
Le serveur intégré convient à un exercice local.

## Les fichiers

| Fichier | Rôle |
| --- | --- |
| index.php | Charge les données, calcule les compteurs et affiche la liste |
| donnees.php | Tableau contenant cinq tâches |
| fonctions.php | Comptage, libellé de priorité et échappement HTML |
| includes/entete.php | Début du document et en-tête |
| includes/pied.php | Pied de page et fin du document |
| assets/style.css | Présentation visuelle |

`require` est utilisé pour les fichiers indispensables ; `include` permet ici
d'illustrer l'inclusion de morceaux de page. `<?= ... ?>` équivaut à un `echo`.

## Progression à faire construire aux étudiants

1. Afficher une tâche avec des variables et `echo`.
2. Afficher cinq tâches avec un tableau et `foreach`.
3. Afficher l'état avec une condition.
4. Compter les tâches restantes avec une fonction qui retourne un entier.
5. Extraire les données, les fonctions, l'en-tête et le pied de page.
6. Échapper les titres avec `htmlspecialchars` avant de les insérer dans le HTML.

La feuille de style peut être fournie dès le début pour concentrer le TP sur PHP.
Ce dossier contient le résultat final ; distribuer le corrigé après la recherche
si l'objectif est de vérifier leur capacité à construire eux-mêmes la logique.

## Vérifications à effectuer

- Au départ : 5 tâches, 3 à faire, 2 terminées.
- Passer une tâche de `false` à `true` : les compteurs et son état changent.
- Remplacer le tableau par `$taches = [];` : afficher le message de liste vide.
- Passer toutes les tâches à `true` : afficher le message de félicitations.
- Mettre `<strong>Test</strong>` dans un titre : les balises doivent s'afficher
  comme du texte, sans être interprétées.

Les compteurs lisent des booléens : utiliser `true` et `false`, pas les chaînes
`'true'` et `'false'`. Priorités admises pour l'exercice : haute, moyenne, basse.

## Pourquoi les données reviennent-elles après rechargement ?

À chaque requête, PHP relit le tableau défini dans donnees.php. Il n'existe ici
aucun stockage des actions utilisateur. Les données du navigateur et les données
du serveur ne se synchronisent pas automatiquement. C'est le point de départ
de la séance sur les formulaires et la persistance avec PDO.

## Travail en autonomie : transfert au covoiturage

Créer une seconde page à partir de ce modèle avec cinq trajets : identifiant,
départ, horaire, conducteur, places disponibles. Afficher un message « Complet »
si aucune place ne reste, et compter les trajets ayant des places disponibles.
Attendus : fichiers organisés, boucle, condition, fonction de comptage,
échappement des textes et explication orale du fonctionnement.
