<!-- Elie Bismuth -->


<div class="container">
     
     <?php if(!empty($sucess)) : ?>
        <div class="alert alert-success" role="alert">
            L'inscription de l'adhérent a bien été enregistré
        </div>
    <?php endif; ?>

    <form name="formAjout" action="Index.php?action=ajouterAdherent" method="post">
        <legend>Ajouter un adhérent </legend>
        <div class="form-group mt-3">
            <label for="nom">Club</label>
            <select name="club" class="browser-default custom-select">
                <?php foreach($clubs as $club) : ?>
                    <option value="<?=  $club['id_club'] ?>"> <?= $club['nom_club'] ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" name="nom" required  >
        </div>
        <div class="form-group">
            <label for="prenom">Prenom</label>
            <input type="text" class="form-control" name="prenom" required>
        </div>
        <div class="form-group">
            <label for="prix">Date de naissance</label>
            <input type="date" class="form-control" name="date" required>
        </div>
        <div class="form-group">
            <label for="prix">Genre</label>
            <select name="genre" class="browser-default custom-select">
                <option>M</option>
                <option>F</option>
        </select>
        </div>
        <div class="form-group">
            <label for="nom">Année d'obtention de licence</label>
            <input type="text" class="form-control" name="licence" required pattern='^\d{4}$'>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
