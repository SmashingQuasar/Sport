

<!-- On crée la div qui va contenir les camemberts-->
<div id="chart-container"></div>


<!-- On encode en json le tableau contentant toutes les informations   -->
<script id="data"><?=  json_encode($data) ?></script>

<script>

var data = document.querySelector('#data').innerHTML;
var values = JSON.parse(data);

console.log(values);

var chartData = [];

for (var i = 0; i < values.length; i++) {
    chartData.push(
        {
            "label": "Hommes",
            "value": parseFloat(ist[i].MyProperty_Test_Chargers)                
        },
        {
            "label": "Femmes",
            "value": parseFloat(ist[i].MyProperty_Test_Chargers)   
        }
    
    )
}

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