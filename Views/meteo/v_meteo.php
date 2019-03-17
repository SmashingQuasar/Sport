<!--- Elie Bismuth -->

<?php if($error) : ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
<?php else : ?>
    <div class="container ">
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
                            <?= $day['date']->format('d/m/y')?> <?= $day['description'] ?> <?= $day['temp'] ?> C
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>