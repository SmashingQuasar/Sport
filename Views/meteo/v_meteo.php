<!--- Elie Bismuth -->

<div class="container mt-5">
    <h2>Sélectionnez un département</h2>
    <form class="mt-3" action="Index.php?action=meteo" method="post">
        <select name="selectedDepartement" class="browser-default custom-select">
            <?php foreach($departements as $departement) : ?>
                <option value="<?= $departement['code'] ?>"> <?= $departement['nom']?> - <?= $departement['code'] ?>  </option>       
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>

<?php if(!empty($communes)) : ?>
    <div class="container mt-5">
        <h2>Sélectionnez une commune</h2>
        <form class="mt-3" action="Index.php?action=meteo" method="post">
            <select name="selectedCommune" class="browser-default custom-select">
                <?php foreach($communes as $commune) : ?>
                    <option value="<?= $commune['nom'] ?>"> <?= $commune['nom']?> - <?= $commune['code'] ?>  </option>       
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
<?php endif; ?>

<?php if(!empty($forecast) && !empty($today)) :  ?>
    <div class="container ">
        <div class="alert alert-info" role="alert" align="center">
           <h3>Météo pour <?= $commune ?></h3>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <?php if(!empty($today)) : ?>
                    <div class="card" style="width: 18rem;">
                        <img src="assets/image/soleil_degagé.jpg" class="card-img-top" alt="soleil">
                        <div class="card-body">
                            <p class="card-text">Informations concernant la température du jour</p>
                            <ul>
                                <li>Température : <?= $today['temp'] ?> degrés</li>
                                <li> Temps : <?= $today['description'] ?></li>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-sm-8 ">
                <h4>Prévisions météorologiques pour les 5 prochains jours , toutes les 3 heures</h4>
                <?php if(!empty($forecast)) : ?>
                    <?php foreach($forecast as $day) : ?>
                        <li>
                            <strong><?= $day['date']->format('d/m/y h:i:s')?> </strong> :  <?= $day['description'] ?> , <?= $day['temp'] ?> C
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>