<?php require_once("../../php/dbconn.php"); ?>


<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

$sql='call getAnuallRevByMonth('.$resellerId.');';

if ( $result=mysqli_query($conn,$sql) ) {

    $arrayData = array();

    //$arrayData["data"] = array();

    while ( $row=mysqli_fetch_array($result) ) {

     $arrayData[] = array(
                  "date" => $row["date"],
                  "value" => $row[0]
                );
     print_r($arrayData);
    }

    $jsonEncodedData = json_encode($arrayData);

    //var_dump($jsonEncodedData);

}

mysqli_close($conn);
    
?> 

        <script>


            var cleanData = <?php echo $jsonEncodedData; ?>;
            var chart;

            var salesData = [
                             {
                             "date": "2015-01-01",
                             "value": cleanData
                             },
                              {
                             "date": "2015-02-01",
                             "value": cleanData
                             }
            ];
            
                
               AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();

                chart.dataProvider = salesData;
                chart.dataDateFormat = "YYYY-MM-DD";
                chart.categoryField = "date";


                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
                categoryAxis.minPeriod = "DD"; // our data is daily, so we set minPeriod to DD
                categoryAxis.gridAlpha = 0.1;
                categoryAxis.minorGridAlpha = 0.1;
                categoryAxis.axisAlpha = 0;
                categoryAxis.minorGridEnabled = true;
                categoryAxis.inside = true;

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.tickLength = 0;
                valueAxis.axisAlpha = 0;
                valueAxis.showFirstLabel = false;
                valueAxis.showLastLabel = false;
                chart.addValueAxis(valueAxis);

                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.dashLength = 3;
                graph.lineColor = "#0033FF"; //#00CC00";
                graph.valueField = "value";
                graph.dashLength = 3;
                graph.bullet = "round";
                graph.balloonText = "[[category]]<br><b><span style='font-size:14px;'>Invoice(s):[[value]]</span></b>";
                chart.addGraph(graph);

                // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                chartCursor.valueLineEnabled = true;
                chartCursor.valueLineBalloonEnabled = true;
                chart.addChartCursor(chartCursor);

                // SCROLLBAR
                // var chartScrollbar = new AmCharts.ChartScrollbar();
                // chartScrollbar.
                // chart.addChartScrollbar(chartScrollbar);

                // HORIZONTAL GREEN RANGE
                var guide = new AmCharts.Guide();
                guide.value = 10;
                guide.toValue = 20;
                guide.fillColor = "#0033FF";//"#00CC00";
                guide.inside = true;
                guide.fillAlpha = 0.2;
                guide.lineAlpha = 0;
                valueAxis.addGuide(guide);

                // TREND LINES
                // first trend line
                var trendLine = new AmCharts.TrendLine();
                // note,when creating date objects 0 month is January, as months are zero based in JavaScript.
                trendLine.initialDate = new Date(2015, 0, 2, 12); // 12 is hour - to start trend line in the middle of the day
                trendLine.finalDate = new Date(2015, 0, 11, 12);
                trendLine.initialValue = 10;
                trendLine.finalValue = 19;
                trendLine.lineColor = "#CC0000";
                chart.addTrendLine(trendLine);

                // second trend line
                trendLine = new AmCharts.TrendLine();
                trendLine.initialDate = new Date(2015, 0, 17, 12);
                trendLine.finalDate = new Date(2015, 0, 22, 12);
                trendLine.initialValue = 16;
                trendLine.finalValue = 10;
                trendLine.lineColor = "#CC0000";
                chart.addTrendLine(trendLine);

                // WRITE
                chart.write("sp_sales");
            });
        </script>

        <div id="sp_sales" style="width: 100%; height: 400px;"></div>

