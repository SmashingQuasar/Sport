<!-- Elie Bismuth -->


<div class="alert alert-info" role="alert" align="center">
    <span id='nbTotal'><?= $nbTotal ?></span> adhérents <br>
    <span id='nbHommes'><?= $nbHommes[0] ?></span>  hommes <br>
    <span id='nbFemmes'><?= $nbFemmes[0] ?> </span> femmes 
</div>
<div align="center" id="chart-container"></div>

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
        "theme": "zune"
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
        width: "50%",
        height: "50%",
        dataFormat: "json",
        dataSource
    }).render();
    });

</script>