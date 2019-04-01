<!--- Elie Bismuth -->
<?php $parameters = $this->getParameters();?>

<?php if (!empty($parameters['departements'])):?>

    <div class="container mt-5">
        <h2>Sélectionnez un département</h2>
        <form class="mt-3" method="post">
            <select name="selectedDepartement" class="browser-default custom-select">

                <?php foreach ($parameters['departements'] as $departement):?>

                    <option value="<?=$departement['code'];?>"><?="{$departement['nom']} - {$departement['code']}";?></option>    

                <?php endforeach;?>

            </select>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>

<?php endif; ?>

<?php if (!empty($parameters['communes'])):?>

    <div class="container mt-5">
        <h2>Sélectionnez une commune</h2>
        <form class="mt-3" method="post">
            <select name="selectedCommune" class="browser-default custom-select">

                <?php foreach($parameters['communes'] as $commune):?>

                    <option value="<?=$commune['nom'];?>"><?="{$commune['nom']} - {$commune['code']}";?></option>

                <?php endforeach;?>

            </select>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>

<?php endif; ?>

<?php if (!empty($parameters['forecast']) && !empty($parameters['today'])):?>

    <?php if (!empty($parameters['error'])):?>

        <div class="alert alert-danger"><?=$error;?></div>

    <?php else:?>

        <div class="container ">
            <div class="alert alert-info" role="alert" align="center">
            <h3>Météo pour <?=$parameters['commune'];?></h3>
            </div>
            <div class="row">
                <div class="col-sm-4">

                    <?php if (!empty($parameters['today'])):?>

                        <div class="card" style="width: 18rem;">
                            <img src="assets/image/soleil_degagé.jpg" class="card-img-top" alt="soleil">
                            <div class="card-body">
                                <p class="card-text">Informations concernant la température du jour</p>
                                <ul>
                                    <li>Température : <?=$parameters['today']['temp'];?> degrés</li>
                                    <li> Temps : <?=$parameters['today']['description'];?></li>
                                </ul>
                            </div>
                        </div>

                    <?php endif;?>

                </div>
                <div class="col-sm-8 ">
                    <h4>Prévisions météorologiques pour les 5 prochains jours , toutes les 3 heures</h4>

                    <?php if (!empty($parameters['forecast'])):?>

                        <?php foreach ($parameters['forecast'] as $day):?>

                            <li>
                                <strong><?=$day['date']->format('d/m/y h:i:s');?> </strong> :  <?="{$day['description']} , {$day['temp']}";?> C
                            </li>

                        <?php endforeach;?>

                    <?php endif;?>

                </div>
            </div>
        </div>

    <?php endif;?>

<?php endif;?>