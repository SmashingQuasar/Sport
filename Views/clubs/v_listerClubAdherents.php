<!--- Elie Bismuth -->

<div class="container mt-5">
    <h2>Sélectionnez un club pour voir ses adhérents</h2>
    <form class="mt-3" action="Index.php?action=listerClub" method="post">
        <select name="selectedClub" class="browser-default custom-select">
            <?php foreach($clubs as $club) : ?>
                <option> <?=  $club->getId() . " - " .$club->getNom() ?> </option>       
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>

<?php if(!empty($adherentsClub)) : ?>

    <table class="table mt-5" id="myTable" >
        <thead class="thead-dark">
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Prenom</th>
            <th scope="col">Date de naissance</th>
            <th scope="col">Genre</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($adherentsClub as $adherent) : ?>
                <tr>
                    <td><?= ucfirst($adherent->getNom()) ?></td>
                    <td><?= ucfirst($adherent->getPrenom()) ?></td>
                    <td><?= $adherent->getDateNaissance() ?></td>
                    <td><?= $adherent->getGenre() ?></td>
                </tr>    
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>
