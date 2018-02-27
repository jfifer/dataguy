<?php require_once("../../php/dbconn.php");

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

$sql='call getDeviceCounts('.$resellerId.');';

if ( $result=mysqli_query($conn,$sql) ) {

    while ( $row=mysqli_fetch_array($result) ) {

     $arrayData[] = array(
                  "device" => $row["device"],
                  "deviceCount" => $row["deviceCount"]
                );
    }

    $jsonEncodedData = json_encode($arrayData);

}

mysqli_close($conn);
    
?> 
        <script>
            var peers = <?php echo $jsonEncodedData; ?>;
            console.log(peers);
            var chart;
            var legend;

            var peersData = peers;

            AmCharts.ready(function () {
                // PIE CHART
                chart = new AmCharts.AmPieChart();
                chart.dataProvider = peersData;
                chart.titleField = "device";
                chart.valueField = "deviceCount";
                //chart.depth3D = 10;
                //chart.angle = 10;

                // LEGEND
                legend = new AmCharts.AmLegend();
                legend.align = "center";
                legend.markerType = "circle";
                chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                chart.addLegend(legend);

                // WRITE
                chart.write("peers_pie");
            });

            // changes label position (labelRadius)
            function setLabelPosition() {
                if (document.getElementById("rb1").checked) {
                    chart.labelRadius = 30;
                    chart.labelText = "[[title]]: [[value]]";
                } else {
                    chart.labelRadius = -30;
                    chart.labelText = "[[percents]]%";
                }
                chart.validateNow();
            }


            // makes chart 2D/3D
            function set3D() {
                if (document.getElementById("rb3").checked) {
                    chart.depth3D = 10;
                    chart.angle = 10;
                } else {
                    chart.depth3D = 0;
                    chart.angle = 0;
                }
                chart.validateNow();
            }

            // changes switch of the legend (x or v)
            function setSwitch() {
                if (document.getElementById("rb5").checked) {
                    legend.switchType = "x";
                } else {
                    legend.switchType = "v";
                }
                legend.validateNow();
            }
        </script>

        <div id="peers_pie" style="width: 100%; height: 600px;"></div>