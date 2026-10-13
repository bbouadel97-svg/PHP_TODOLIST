<form action="ajouter_tache.php" method="post" class="formulaire-ajout">
    <label for="titre">Titre :</label>
    <input type="text" id="titre" name="titre" required placeholder="Nouvelle tâche...">
    <label for="priorite">Priorité :</label>
    <select id="priorite" name="priorite" required>
        <option value="haute">Haute</option>
        <option value="moyenne" selected>Moyenne</option>
        <option value="basse">Basse</option>
    </select>   
    <button type="submit">Ajouter</button>
</form>
