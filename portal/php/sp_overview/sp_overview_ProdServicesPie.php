<?php require_once("../../php/dbconn.php"); ?>


<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

$sql='call getResellerServices('.$resellerId.');';

if ( $result=mysqli_query($conn,$sql) ) {

    $row=mysqli_fetch_assoc($result);

    $resellerId = $row['in_resellerId'];
    $didCount = $row['v_didCount'];
    $extCount = $row['v_extCount'];
    $mailCount = $row['v_mailCount'];
    $aaCount = $row['v_aaCount'];
    $timeFrameCount = $row['v_timeFrameCount'];
    $groupCount = $row['v_groupCount'];
    $confCount = $row['v_confCount'];

if ( $didCount == 0 ) {
    echo "<br><br>".$companyName." has no data available for DID Count.";
}
if ( $extCount == 0 ) {
    echo "<br><br>".$companyName." has no data available for Extension Count.";
}
if ( $mailCount == 0 ) {
    echo "<br><br>".$companyName." has no data available for Mailbox Count.";
}
if ( $aaCount == 0 ) {
    echo "<br><br>".$companyName." has no data available for Auto Attendant Count.";
}
if ( $timeFrameCount == 0 ) {
    echo "<br><br>".$companyName." has no data available for Time Frame Count.";
}
if ( $groupCount == 0 ) {
    echo "<br><br>".$companyName." has no data available for Groups Count.";
}
if ( $confCount == 0 ) {
    echo "<br><br>".$companyName." has no data available for Conferences Count.";
}

}
   

mysqli_close($conn);
    
?> 

  <script>

            var didCount = <?php echo $didCount;?>;
            var extCount = <?php echo $extCount;?>;
            var mailCount = <?php echo $mailCount;?>;
            var aaCount = <?php echo $aaCount;?>;
            var timeFrameCount = <?php echo $timeFrameCount;?>;
            var groupCount = <?php echo $groupCount;?>;
            var confCount = <?php echo $confCount;?>;

            var chart;
            var chartData = [
                {
                    "service": "Phone Numbers (DID)",
                    "visits": didCount
                },
                {
                    "service": "Extensions",
                    "visits": extCount
                },
                {
                    "service": "Mailboxes",
                    "visits": mailCount
                },
                {
                    "service": "Auto Attendants",
                    "visits": aaCount
                },
                {
                    "service": "Time Frames",
                    "visits": timeFrameCount
                },
                {
                    "service": "Groups",
                    "visits": groupCount
                },
                {
                    "service": "Conference Bridges",
                    "visits": confCount
                }
                
            ];


            AmCharts.ready(function () {
                // PIE CHART
                chart = new AmCharts.AmPieChart();

                // title of the chart
                //chart.addTitle("", 16);

                chart.dataProvider = chartData;
                chart.titleField = "service";
                chart.valueField = "visits";
                chart.sequencedAnimation = true;
                chart.startEffect = "elastic";
                chart.innerRadius = "30%";
                chart.startDuration = 2;
                chart.labelRadius = 15;
                chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                // the following two lines makes the chart 3D
                chart.depth3D = 10;
                chart.angle = 15;

                // WRITE
                chart.write("chartdiv");
            });
        </script>


        <div id="chartdiv" style="width:100%; height:550px;"></div>

