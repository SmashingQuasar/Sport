<!--- Elie Bismuth -->

<?php if($error) : ?>

    <div class="alert alert-danger">
        <?= $error ?>
    </div>

<?php else : ?>

<div class="container">
    <div class="row">
        <div class="col-sm-4">
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
        </div>
    </div>
</div>

<?php endif; ?>