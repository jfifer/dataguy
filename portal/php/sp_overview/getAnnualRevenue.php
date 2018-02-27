<?php require_once("../../php/dbconn.php"); ?>


<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

$sql='call getAnnualRevByMonth('.$resellerId.', 2017);';

if ( $result=mysqli_query($conn,$sql) ) {

    //$arrayData = array();

   while ( $row=mysqli_fetch_array($result) ) {

     $data[] = array(
                  "date" => $row["date"],
                  "value" => $row["value"]
                );
    }

    $clean = json_encode($data);
}

mysqli_close($conn);

?>

        <script>
            var clean = <?php echo $clean; ?>;
            var chart;
console.log(clean);
            var revenueData = clean;

            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = revenueData;
                chart.categoryField = "date";
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
                valueAxis.minimum=45;

                valueAxis.autoGridCount = false;
                valueAxis.gridCount = 50;
                valueAxis.labelFrequency = 5;

                valueAxis.axisAlpha = 0;
                valueAxis.gridAlpha = 0;

                valueAxis.position = "top";
                chart.addValueAxis(valueAxis);

                // GRAPHS
                // first graph
                var graph1 = new AmCharts.AmGraph();
                graph1.type = "column";
                graph1.title = "2017 End User Billing";
                graph1.valueField = "value";
                graph1.balloonText = "Billing In [[date]]: [[value]]";
                graph1.lineAlpha = 0;
                graph1.fillColors = "blue"; //"#ADD981";
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
                chart.write("revenue");
            });
        </script>



        <div id="revenue" style="width:500px; height:600px;"></div>


