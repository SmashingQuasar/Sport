
<div class="container">

  <div id="chart-container"></div>
</div>

<script>

const dataSource = {
  "chart": {
    "caption": "Countries with Highest Deforestation Rate",
    "subcaption": "For the year 2017",
    "yaxisname": "Deforested Area{br}(in Hectares)",
    "decimals": "1",
    "theme": "fusion"
  },
  "data": [
    {
      "label": "Brazil",
      "value": "1466000"
    },
    {
      "label": "Indonesia",
      "value": "1147800"
    },
    {
      "label": "Russian Federation",
      "value": "532200"
    },
    {
      "label": "Mexico",
      "value": "395000"
    },
    {
      "label": "Papua New Guinea",
      "value": "250200"
    },
    {
      "label": "Peru",
      "value": "224600"
    },
    {
      "label": "U.S.A",
      "value": "215200"
    },
    {
      "label": "Bolivia",
      "value": "135200"
    },
    {
      "label": "Sudan",
      "value": "117807"
    },
    {
      "label": "Nigeria",
      "value": "82000"
    }
  ]
};

FusionCharts.ready(function() {
   var myChart = new FusionCharts({
      type: "column3d",
      renderAt: "chart-container",
      width: "70%",
      height: "0%",
      dataFormat: "json",
      dataSource
   }).render();
});






</script>