<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

$count='SELECT DISTINCT a.state,
               COUNT(customerId)
          FROM activeCustomer_view c
          JOIN address a ON (a.addressId = c.billingAddressId)
         WHERE c.statusId NOT IN (2,3)
           AND a.state !=""
           GROUP BY 1
           ORDER BY 1';

if ($result=mysqli_query($conn,$count) ) {

while ($row=mysqli_fetch_array($result)) {

             $arrayData[] = array(
                  "state0" => $row[0],
                  "count0" => $row[1],
                );

  $cleanData = json_encode($arrayData);

  }
}
?>

<script>
console.log('executed');
var clean = <?php echo $cleanData; ?>;
var chart;



            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = clean;
                chart.categoryField = "state0";
                chart.startDuration = 1;
                chart.plotAreaBorderColor = "#DADADA";
                chart.plotAreaBorderAlpha = 1;
                // this single line makes the chart a bar chart
                chart.rotate = false;

                // AXES
                // Category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.gridPosition = "start";
                categoryAxis.gridAlpha = 0.1;
                categoryAxis.axisAlpha = 0;

                // Value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.axisAlpha = 0;
                valueAxis.gridAlpha = 0.1;
                valueAxis.position = "top";
                chart.addValueAxis(valueAxis);

                // GRAPHS
                // first graph
                var graph1 = new AmCharts.AmGraph();
                graph1.type = "column";
                graph1.title = "Customer Count";
                graph1.valueField = "count0";
                graph1.balloonText = "Customers In [[state]]: [[count]]";
                graph1.lineAlpha = 0;
                graph1.fillColors = "blue";//"#ADD981";
                graph1.fillAlphas = 1;
                chart.addGraph(graph1);

                // second graph
                // var graph2 = new AmCharts.AmGraph();
                // graph2.type = "column";
                // graph2.title = "Expenses";
                // graph2.valueField = "expenses"; // 3rd Field in json revenueData
                // graph2.balloonText = "Expenses:[[value]]";
                // graph2.lineAlpha = 0;
                // graph2.fillColors = "#81acd9";
                // graph2.fillAlphas = 1;
                // chart.addGraph(graph2);

                // LEGEND
                var legend = new AmCharts.AmLegend();
                chart.addLegend(legend);

                chart.creditsPosition = "top-right";

                // WRITE
                chart.write("stateCount");
            });
</script>



<div id="stateCount" style="width:100%; height:600px;"></div>



