<?php

/*
SELECT r.resellerId,
       r.companyName,
       h.date as startDate,
       hist.date as endDate
       FROM reseller r
       JOIN historyEvent h on h.recordId=r.resellerId
       LEFT JOIN (SELECT recordId, date FROM historyEvent WHERE recordType=12 AND operationType=2) hist ON hist.recordId=r.resellerId
       WHERE h.recordType=12
       AND h.operationType=1
*/

  $conn = new mysqli("localhost", "root", "root", "bi_new");
  $sql = "SELECT CONCAT(YEAR(v_startDate),'-',MONTH(v_startDate),'-','01') as startDate, 
          COUNT(*) as total 
          FROM tmp_spa 
          WHERE v_companyName NOT LIKE '%demo%'
            AND v_companyName NOT LIKE '%test%'
            AND v_companyName NOT LIKE '%Test%'
            AND v_companyName NOT LIKE '%demo%'
            AND v_extCount !=0
          GROUP BY YEAR(v_startDate), 
          MONTH(v_startDate) ASC";

  if($result = mysqli_query($conn, $sql)){
    $total = 0;
    while($row = mysqli_fetch_assoc($result)) {
      $total += $row['total'];
      $SPdata[] = array(
                  "date" => $row['startDate'],
                  "value" => $total,
                );
    }
?>

<script type="text/javascript">

            var SPdata = <?php print_r(json_encode($SPdata)); ?>;
            console.log(SPdata);
            var SPchart;

            AmCharts.ready(function () {
                // SERIAL CHART
                SPchart = new AmCharts.AmSerialChart();
                SPchart.dataProvider = SPdata;
                SPchart.categoryField = "date";
                SPchart.startDuration = 1;
                SPchart.plotAreaBorderColor = "#DADADA";
                SPchart.plotAreaBorderAlpha = 1;
                // this single line makes the chart a bar chart
                SPchart.rotate = false;

                // AXES
                // Category
                var categoryAxis = SPchart.categoryAxis;
                categoryAxis.gridPosition = "start";
                categoryAxis.gridAlpha = 0.1;
                categoryAxis.axisAlpha = 0;

                // Value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.axisAlpha = 0;
                valueAxis.gridAlpha = 0.1;
                valueAxis.position = "top";
                SPchart.addValueAxis(valueAxis);

                // GRAPHS
                // first graph
                var graph1 = new AmCharts.AmGraph();
                graph1.type = "column";
                graph1.title = "Partners";
                graph1.valueField = "value";
                graph1.balloonText = "[[date]]:[[value]]";
                graph1.lineAlpha = 0;
                graph1.fillColors = "blue"; //"#ADD981";
                graph1.fillAlphas = 1;
                SPchart.addGraph(graph1);

                // second graph
                // var graph2 = new AmCharts.AmGraph();
                // graph2.type = "column";
                // graph2.title = "2016 End User Billing";
                // graph2.valueField = "value1";
                // graph2.balloonText = "Billed:[[value]]";
                // graph2.lineAlpha = 0;
                // graph2.fillColors = "#81acd9";
                // graph2.fillAlphas = 1;
                // chart.addGraph(graph2);

                // LEGEND
                var legend = new AmCharts.AmLegend();
                SPchart.addLegend(legend);

                SPchart.creditsPosition = "top-right";

                // WRITE
                SPchart.write("partnerGraph");
            });

</script>
<div id="partnerGraph" style="width:100%; height:600px;"></div>
<?php    
 
  } else {
    print_r("no bueno");
  } 
?>
