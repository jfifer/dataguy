<?php
require_once("../../php/dbconn.php");
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

$jan='call getJanuaryDID('.$resellerId.');';

if ( $result=mysqli_query($conn,$jan) ) {

    $row=mysqli_fetch_row($result);
      
     $janDID = json_encode($row[0]);
}

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$feb='call getFebDID('.$resellerId.');';

if ( $result=mysqli_query($conn,$feb) ) {

    $row=mysqli_fetch_row($result);
      
     $febDID = json_encode($row[0]);
}

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$march='call getMarchDID('.$resellerId.');';

if ( $result=mysqli_query($conn,$march) ) {

    $row=mysqli_fetch_row($result);
      
     $marchDID = json_encode($row[0]);
}

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$april='call getAprilDID('.$resellerId.');';

if ( $result=mysqli_query($conn,$april) ) {

    $row=mysqli_fetch_row($result);
      
     $aprilDID = json_encode($row[0]);
}

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$may='call getMayDID('.$resellerId.');';

if ( $result=mysqli_query($conn,$may) ) {

    $row=mysqli_fetch_row($result);
      
     $mayDID = json_encode($row[0]);
}

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$june='call getJuneDID('.$resellerId.');';

if ( $result=mysqli_query($conn,$june) ) {

    $row=mysqli_fetch_row($result);
      
     $juneDID = json_encode($row[0]);
}

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$july='call getJulyDID('.$resellerId.');';

if ( $result=mysqli_query($conn,$july) ) {

    $row=mysqli_fetch_row($result);
      
     $julyDID = json_encode($row[0]);
}

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$aug='call getAugDID('.$resellerId.');';

if ( $result=mysqli_query($conn,$aug) ) {

    $row=mysqli_fetch_row($result);
      
     $augDID = json_encode($row[0]);
}

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$sept='call getSeptDID('.$resellerId.');';

if ( $result=mysqli_query($conn,$sept) ) {

    $row=mysqli_fetch_row($result);
      
     $septDID = json_encode($row[0]);
}

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$oct='call getOctDID('.$resellerId.');';

if ( $result=mysqli_query($conn,$oct) ) {

    $row=mysqli_fetch_row($result);
      
     $octDID = json_encode($row[0]);
}

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$nov='call getNovDID('.$resellerId.');';

if ( $result=mysqli_query($conn,$nov) ) {

    $row=mysqli_fetch_row($result);
      
     $novDID = json_encode($row[0]);
}

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$dec='call getDecDID('.$resellerId.');';

if ( $result=mysqli_query($conn,$dec) ) {

    $row=mysqli_fetch_row($result);
      
     $decDID = json_encode($row[0]);
}

mysqli_close($conn);
?>


<script>

            var janDID = <?php echo $janDID; ?>;
            var febDID = <?php echo $febDID; ?>;
            var marchDID = <?php echo $marchDID; ?>;
            var aprilDID = <?php echo $aprilDID; ?>;
            var mayDID = <?php echo $mayDID; ?>;
            var juneDID = <?php echo $juneDID; ?>;
            var julyDID = <?php echo $julyDID; ?>;
            var augDID = <?php echo $augDID; ?>;
            var septDID = <?php echo $septDID; ?>;
            var octDID = <?php echo $octDID; ?>;
            var novDID = <?php echo $novDID; ?>;
            var decDID = <?php echo $decDID; ?>;
            var chart;

            var cleanData = [
                {
                  "month": "Jan",
                    "did": janDID
                    ,
                    "extensions": 12,
                    "mailboxes": 43
                    // "aa": 146,
                    // "timeframe": 146,
                    // "groups": 146,
                    // "confbridges": 146
                },
                {
                  "month": "Feb",
                    "did": febDID
                    ,
                    "extensions": 1,
                    "mailboxes": 34
                    // "aa": 146,
                    // "timeframe": 146,
                    // "groups": 146,
                    // "confbridges": 146
                },
                {
                   "month": "March",
                    "did": marchDID
                    ,
                    "extensions": 3,
                    "mailboxes": 53
                    // "aa": 146,
                    // "timeframe": 146,
                    // "groups": 146,
                    // "confbridges": 146
                },
                {
                    "month": "April",
                    "did": aprilDID
                    ,
                    "extensions": 5,
                    "mailboxes": 21
                    // "aa": 146,
                    // "timeframe": 146,
                    // "groups": 146,
                    // "confbridges": 146
                },
                {
                   "month": "May",
                    "did": mayDID
                    ,
                    "extensions": 7,
                    "mailboxes": 11
                    // "aa": 146,
                    // "timeframe": 146,
                    // "groups": 146,
                    // "confbridges": 146
                },
                {
                    "month": "June",
                    "did": juneDID
                    ,
                    "extensions": 68,
                    "mailboxes": 23
                    // "aa": 146,
                    // "timeframe": 146,
                    // "groups": 146,
                    // "confbridges": 146
                },
                {
                    "month": "July",
                    "did": julyDID
                    ,
                    "extensions": 11,
                    "mailboxes": 43
                    // "aa": 146,
                    // "timeframe": 146,
                    // "groups": 146,
                    // "confbridges": 146
                },
                {
                     "month": "Aug",
                    "did": augDID
                    ,
                    "extensions": 9,
                    "mailboxes": 2
                    // "aa": 146,
                    // "timeframe": 146,
                    // "groups": 146,
                    // "confbridges": 146
                },
                {
                     "month": "Sept",
                    "did": septDID
                    ,
                    "extensions": 7,
                    "mailboxes": 14
                    // "aa": 146,
                    // "timeframe": 146,
                    // "groups": 146,
                    // "confbridges": 146
                },
                {
                  "month": "Oct",
                    "did": octDID
                    ,
                    "extensions": 12,
                    "mailboxes": 1
                    // "aa": 146,
                    // "timeframe": 146,
                    // "groups": 146,
                    // "confbridges": 146
                },
                {
                  "month": "Nov",
                    "did": 0 ,           //novDID,
                    "extensions": 0,
                    "mailboxes": 0
                    // "aa": 146,
                    // "timeframe": 146,
                    // "groups": 146,
                    // "confbridges": 146
                },
                {
                  "month": "Dec",
                    "did": 0  // decDID
                    ,
                    "extensions": 0,
                    "mailboxes": 0
                    // "aa": 146,
                    // "timeframe": 146,
                    // "groups": 146,
                    // "confbridges": 146
                }
            ];

            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();

                chart.dataProvider = cleanData;
                chart.categoryField = "month";

                //chart.addTitle("", 15);

                // AXES
                // Category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.gridAlpha = 0.07;
                categoryAxis.axisColor = "#DADADA";
                categoryAxis.startOnAxis = true;

                // Value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.title = ""; // this line makes the chart "stacked"
                valueAxis.stackType = "100%";
                valueAxis.gridAlpha = 0.07;
                chart.addValueAxis(valueAxis);

                // GRAPHS
                // first graph
                var graph = new AmCharts.AmGraph();
                graph.type = "line"; // it's simple line graph
                graph.title = "DIDs";
                graph.valueField = "did";
                graph.lineAlpha = 0;
                graph.fillAlphas = 0.6; // setting fillAlphas to > 0 value makes it area graph
                graph.balloonText = "<b>[[value]]</b></span>";
                chart.addGraph(graph);

                // // second graph
                graph = new AmCharts.AmGraph();
                graph.type = "line";
                graph.title = "Extensions";
                graph.valueField = "extensions";
                graph.lineAlpha = 0;
                graph.fillAlphas = 0.6;
                graph.balloonText = "<b>[[value]]</b></span>";
                chart.addGraph(graph);

                // // third graph
                graph = new AmCharts.AmGraph();
                graph.type = "line";
                graph.title = "Mailboxes";
                graph.valueField = "mailboxes";
                graph.lineAlpha = 0;
                graph.fillAlphas = 0.6;
                graph.balloonText = "<b>[[value]]</b></span>";
                chart.addGraph(graph);

                // // 4 graph
                // graph = new AmCharts.AmGraph();
                // graph.type = "line";
                // graph.title = "Auto Attendant";
                // graph.valueField = "aa";
                // graph.lineAlpha = 0;
                // graph.fillAlphas = 0.6;
                // graph.balloonText = "<b>[[value]]</b></span>";
                // chart.addGraph(graph);

                // // 5 graph
                // graph = new AmCharts.AmGraph();
                // graph.type = "line";
                // graph.title = "Time Frames";
                // graph.valueField = "timeframe";
                // graph.lineAlpha = 0;
                // graph.fillAlphas = 0.6;
                // graph.balloonText = "<b>[[value]]</b></span>";
                // chart.addGraph(graph);

                // // 6 graph
                // graph = new AmCharts.AmGraph();
                // graph.type = "line";
                // graph.title = "Groups";
                // graph.valueField = "groups";
                // graph.lineAlpha = 0;
                // graph.fillAlphas = 0.6;
                // graph.balloonText = "<b>[[value]]</b></span>";
                // chart.addGraph(graph);

                // // 7 graph
                // graph = new AmCharts.AmGraph();
                // graph.type = "line";
                // graph.title = "Conference Bridges";
                // graph.valueField = "confbridges";
                // graph.lineAlpha = 0;
                // graph.fillAlphas = 0.6;
                // graph.balloonText = "<b>[[value]]</b></span>";
                // chart.addGraph(graph);

                // LEGEND
                var legend = new AmCharts.AmLegend();
                legend.align = "center";
                legend.valueText = "[[value]] ([[percents]]%)";
                legend.valueWidth = 100;
                legend.valueAlign = "left";
                legend.equalWidths = false;
                legend.periodValueText = "total: [[value.sum]]"; // this is displayed when mouse is not over the chart.
                chart.addLegend(legend);

                // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                chartCursor.zoomable = false; // as the chart displayes not too many values, we disabled zooming
                chartCursor.cursorAlpha = 0;
                chart.addChartCursor(chartCursor);

                // WRITE
                chart.write("prodServices");
            });
        </script>

        <div id="prodServices" style="width:100%; height:625px;"></div>