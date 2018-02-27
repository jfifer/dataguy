<?php require_once("php/dbconn.php");

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

$sql='call getOverallExtensionCounts()';

if ( $result=mysqli_query($conn,$sql) ) {

   while ( $row=mysqli_fetch_array($result) ) {

     $extData[] = array(
                  "year" => $row["2017"],
                  "standard" => $row["v_std2017"],
                  "cloud" => $row["v_cloud2017"],
                  "sip" => $row["v_sip2017"]
                );
    }

    $ext = json_encode($extData);
}

mysqli_close($conn);

?>
        <script>

            var extData = <?php echo $ext; ?>;
            var chart;
            var chartData = extData;

            // [
            //     {
            //         "year": 2014,
            //         "standard": 2.5,
            //         "cloud": 2.5,
            //         "sip": 2.2
            //     },
            //     {
            //         "year": 2015,
            //         "standard": 2.6,
            //         "cloud": 2.7,
            //         "sip": 2.2
            //     }

            // ];

            AmCharts.ready(function () {
                // SERIALL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "year";
                chart.plotAreaBorderAlpha = 0.2;
                chart.rotate = false;

                // AXES
                // Category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.gridAlpha = 0.1;
                categoryAxis.axisAlpha = 0;
                categoryAxis.gridPosition = "start";

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.stackType = "regular";
                valueAxis.gridAlpha = 0.1;
                valueAxis.axisAlpha = 0;
                chart.addValueAxis(valueAxis);

                // GRAPHS
                // firstgraph
                var graph = new AmCharts.AmGraph();
                graph.title = "Standard";
                graph.labelText = "[[value]]";
                graph.valueField = "standard";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 1;
                graph.lineColor = "green";
                graph.balloonText = "<b><span style='color:#C72C95'>[[title]]</b></span><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>";
                graph.labelPosition = "middle";
                chart.addGraph(graph);

                // second graph
                graph = new AmCharts.AmGraph();
                graph.title = "Cloud";
                graph.labelText = "[[value]]";
                graph.valueField = "cloud";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 1;
                graph.lineColor = "#C8C8C8 ";//"#D8E0BD";
                graph.balloonText = "<b><span style='color:#afbb86'>[[title]]</b></span><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>";
                graph.labelPosition = "middle";
                chart.addGraph(graph);

                // third graph
                graph = new AmCharts.AmGraph();
                graph.title = "Sip";
                graph.labelText = "[[value]]";
                graph.valueField = "sip";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 1;
                graph.lineColor = "blue"; //"#B3DBD4";
                graph.balloonText = "<b><span style='color:#74bdb0'>[[title]]</b></span><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>";
                graph.labelPosition = "middle";
                chart.addGraph(graph);

                // fourth graph
                // graph = new AmCharts.AmGraph();
                // graph.title = "Latin America";
                // graph.labelText = "[[value]]";
                // graph.valueField = "lamerica";
                // graph.type = "column";
                // graph.lineAlpha = 0;
                // graph.fillAlphas = 1;
                // graph.lineColor = "#69A55C";
                // graph.balloonText = "<b><span style='color:#69A55C'>[[title]]</b></span><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>";
                // graph.labelPosition = "middle";
                // chart.addGraph(graph);

                // fifth graph
                // graph = new AmCharts.AmGraph();
                // graph.title = "Middle-East";
                // graph.labelText = "[[value]]";
                // graph.valueField = "meast";
                // graph.type = "column";
                // graph.lineAlpha = 0;
                // graph.fillAlphas = 1;
                // graph.lineColor = "#B5B8D3";
                // graph.balloonText = "<b><span style='color:#7a81be'>[[title]]</b></span><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>";
                // graph.labelPosition = "middle";
                // chart.addGraph(graph);

                // sixth graph
                // graph = new AmCharts.AmGraph();
                // graph.title = "Africa";
                // graph.labelText = "[[value]]";
                // graph.valueField = "africa";
                // graph.type = "column";
                // graph.lineAlpha = 0;
                // graph.fillAlphas = 1;
                // graph.lineColor = "#F4E23B";
                // graph.balloonText = "<b><span style='color:#c3b218'>[[title]]</b></span><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>";
                // graph.labelPosition = "middle";
                // chart.addGraph(graph);

                // LEGEND
                var legend = new AmCharts.AmLegend();
                legend.position = "bottom";
                legend.borderAlpha = 0.3;
                legend.horizontalGap = 10;
                legend.switchType = "v";
                chart.addLegend(legend);

                chart.creditsPosition = "top-right";

                // WRITE
                chart.write("ext");
            });

            // Make chart 2D/3D
            // function setDepth() {
            //     if (document.getElementById("rb1").checked) {
            //         chart.depth3D = 0;
            //         chart.angle = 0;
            //     } else {
            //         chart.depth3D = 20;
            //         chart.angle = 30;
            //     }
            //     chart.validateNow();
            // }
        </script>


            <div id="ext" style="width: 100%; height: 600px;"></div>
           <!--  <input type="radio" checked="true" name="group" id="rb1" onclick="setDepth()">2D
            <input type="radio" name="group" id="rb2" onclick="setDepth()">3D -->
