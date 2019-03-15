<!----- Elie Bismuth !-->
<div class="container">
  <h2>Statistiques des adhérents par tranches d'âges</h2>
  <div id="chart-container"></div>
</div>



<!-- On encode en json le tableau contentant toutes les informations   -->
<script id="data"><?= json_encode($tranches) ?></script>

<script>

var data = document.querySelector('#data').innerHTML;
var values = JSON.parse(data);

const dataSource = {
  "chart": {
    "caption": "",
    "subcaption": "",
    "yaxisname": "Nombres d'adhérents",
    "decimals": "1",
    "theme": "fusion"
  },
  "data": [
    {
      "label": "Tranches 0 a 10",
      "value": values.tranches10
    },
    {
      "label": "Tranches 10 a 20",
      "value": values.tranches20
    },
    {
      "label": "Tranches 20 a 30",
      "value": values.tranches30
    },
    {
      "label": "Tranches 30 a 40",
      "value": values.tranches40
    },
    {
      "label": "Tranches 40 a 50",
      "value": values.tranches50
    },
    {
      "label": "Tranches 50 a 60",
      "value": values.tranches60
    },
    {
      "label": "Tranches 60 a 70",
      "value": values.tranches70
    },
    {
      "label": "Tranches 70 a 80",
      "value": values.tranches80
    },
    {
      "label": "Tranches 80 a 90",
      "value": values.tranches90
    },
    {
      "label": "Tranches 90 a 100",
      "value": values.tranches100
    },
  ]
};

FusionCharts.ready(function() {
   var myChart = new FusionCharts({
      type: "column3d",
      renderAt: "chart-container",
      width: "80%",
      height: "80%",
      dataFormat: "json",
      dataSource
   }).render();
});






</script>