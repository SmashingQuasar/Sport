
<!----- Elie Bismuth !-->
<div class="container mt-5">
    <h2>Sélectionnez un club pour voir ses statistiques</h2>
    <form class="mt-3" action="statsController.php?action=statClub" method="post">
        <select name="selectedClub" class="browser-default custom-select">
            <?php foreach($clubs as $club) : ?>
                <option> <?=  $club['id_club'] . " - " .$club['nom_club'] ?> </option>       
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>


<?php if(!empty($data)) : ?>
  
    <!-- On crée la div qui va contenir les camemberts-->
    <div class="container mt-5">
        <div class="alert alert-info" role="alert" align="center">
            <span id='nbHommes'><?= $data[0]['hommes'] ?></span>  hommes <br>
            <span id='nbFemmes'><?= $data[0]['femmes'] ?> </span> femmes 
        </div>
        <div align="center" id="chart-container"></div>
    </div>

    <!-- On encode en json le tableau contentant toutes les informations   -->
    <script id="data"><?= json_encode($data) ?></script>

    
    <script>

        var data = document.querySelector('#data').innerHTML;
        var values = JSON.parse(data);


        const dataSource = {
            "chart": {
                "caption": "Statisques pour le club" +values[0].nom_club,
                "plottooltext": "<b>$percentValue</b> des adhérents sont des $label",
                "showlegend": "1",
                "showpercentvalues": "1",
                "legendposition": "bottom",
                "usedataplotcolorforlabels": "1",
                "theme": "candy"
            },
            "data": [
                {
                "label": "Homme",
                "value": values[0].hommes * 100 / ( values[0].hommes +  values[0].femmes)
                },
                {
                "label": "Femme",
                "value": values[0].femmes * 100 / ( values[0].hommes +  values[0].femmes)
                }
            ]
        };

        FusionCharts.ready(function() {
            var myChart = new FusionCharts({
                type: "pie2d",
                renderAt: "chart-container",
                width: "50%",
                height: "50%",
                dataFormat: "json",
                dataSource
            }).render();
        });


    </script>

<?php endif ; ?>

