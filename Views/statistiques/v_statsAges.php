
<div class="container">
  <h2>Statistiques des adhérents par tranches d'âges</h2>
  <div id="chart-container"></div>
</div>

<script>

const dataSource = {
  "chart": {
    "caption": "Statistiques des adhérents par tranches d'ages",
    "subcaption": "For the year 2017",
    "yaxisname": "Deforested Area{br}(in Hectares)",
    "decimals": "1",
    "theme": "fusion"
  },
  "data": [
    {
      "label": "Homme",
      "value": "70"
    },
    {
      "label": "Femme",
      "value": "30"
    },
  ]
};

FusionCharts.ready(function() {
   var myChart = new FusionCharts({
      type: "column3d",
      renderAt: "chart-container",
      width: "70%",
      height: "70%",
      dataFormat: "json",
      dataSource
   }).render();
});






</script>