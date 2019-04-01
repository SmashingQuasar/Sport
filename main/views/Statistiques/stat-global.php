<!-- Elie Bismuth -->
<?php $parameters = $this->getParameters();?>

<div class="container">
    <div class="alert alert-info" role="alert" align="center">
        <span id='nbTotal'><?=$parameters['nbTotal'];?></span> adhérents <br>
        <span id='nbHommes'><?=$parameters['adherents']['hommes'];?></span>  hommes <br>
        <span id='nbFemmes'><?=$parameters['adherents']['femmes'];?> </span> femmes 
    </div>
    <div align="center" id="chart-container"></div>
</div>

<script>
    let nbTotal = document.querySelector('#nbTotal').innerHTML;
    let nbHommes = document.querySelector('#nbHommes').innerHTML;
    let nbFemmes = document.querySelector('#nbFemmes').innerHTML;

    let pourcentHomme = nbHommes * 100 / nbTotal ; 
    let pourcentFemme = nbFemmes * 100 / nbTotal ;

    const dataSource = {
    "chart": {
        "caption": "Statisques globales",
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
        "value": pourcentHomme
        },
        {
        "label": "Femme",
        "value": pourcentFemme
        }
    ]
    };

    FusionCharts.ready(function() {
        var myChart = new FusionCharts({
            type: "pie2d",
            renderAt: "chart-container",
            width: "70%",
            height: "70%",
            dataFormat: "json",
            dataSource
        }).render();
    });

</script>