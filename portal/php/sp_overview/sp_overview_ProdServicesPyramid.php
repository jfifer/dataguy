<?php require_once("../../php/dbconn.php"); ?>


<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

$sql='call getProductionServices('.$resellerId.');';

if ( $result=mysqli_query($conn,$sql) ) {

    $row=mysqli_fetch_assoc($result);

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

            var ext = <?php echo $extCount; ?>;
            var mail = <?php echo $mailCount; ?>;
            var aa = <?php echo $aaCount; ?>;
            var timeFrame = <?php echo $timeFrameCount; ?>;
            var group = <?php echo $groupCount; ?>;
            var confB = <?php echo $confCount; ?>;

            var chart;
            var data = [
                {
                    "title": "Extensions",
                    "value": ext
                },
                {
                    "title": "Mailboxes",
                    "value": mail
                },
                {
                    "title": "Auto Attendant",
                    "value": aa
                },
                {
                    "title": "Time Frames",
                    "value": timeFrame
                },
                {
                    "title": "Groups",
                    "value": group
                },
                {
                    "title": "Conference Bridges",
                    "value": confB
                }

			];

            AmCharts.ready(function () {

                chart = new AmCharts.AmFunnelChart();
                chart.rotate = true;
                chart.titleField = "title";
                chart.balloon.fixedPosition = true;
                chart.marginRight = 210;
                chart.marginLeft = 15;
                chart.labelPosition = "right";
                chart.funnelAlpha = 0.9;
                chart.valueField = "value";
                chart.startX = -500;
                chart.dataProvider = data;
                chart.startAlpha = 0;
                chart.write("services");
            });
     </script>



        <div id="services" style="width: 100%; height: 525px;"></div>
