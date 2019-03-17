<!--- Elie Bismuth -->

<div class="container mt-5">
    <h2>Sélectionnez un club pour voir ses adhérents</h2>
    <form class="mt-3" action="Index.php?action=listerClubAdherents" method="post">
        <select name="selectedClub" class="browser-default custom-select">
            <?php foreach($clubs as $club) : ?>
                <option value="<?=  $club['id_club'] ?>"><?= $club['nom_club'] ?> </option>       
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>

<?php if(!empty($adherentsClub)) : ?>
    <div class="container">
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
                        <td><?= ucfirst($adherent['nom']) ?></td>
                        <td><?= ucfirst($adherent['prenom']) ?></td>
                        <td><?= $adherent['date_naissance'] ?></td>
                        <td><?= $adherent['genre'] ?></td>
                    </tr>    
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
