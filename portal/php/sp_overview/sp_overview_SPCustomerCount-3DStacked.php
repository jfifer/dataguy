<?php require_once("../../php/dbconn.php"); ?>


<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

$sql='call getCustomerGrowthCount('.$resellerId.');';

if ( $result=mysqli_query($conn,$sql) ) {

    $row=mysqli_fetch_assoc($result);

    $jan = $row['v_jan'];
    $feb = $row['v_feb'];
    $march = $row['v_mar'];
    $april = $row['v_apr'];
    $may = $row['v_may'];
    $june = $row['v_jun'];
    $july = $row['v_july'];
    $aug = $row['v_aug'];
    $sept = $row['v_sept'];
    $oct = $row['v_oct'];
    $nov = $row['v_nov'];
    $dec = $row['v_dec'];
// cancellations
    $c_jan = $row['v_janCan'];
    $c_feb = $row['v_febCan'];
    $c_march = $row['v_marCan'];
    $c_april = $row['v_aprCan'];
    $c_may = $row['v_mayCan'];
    $c_june = $row['v_junCan'];
    $c_july = $row['v_julyCan'];
    $c_aug = $row['v_augCan'];
    $c_sept = $row['v_septCan'];
    $c_oct = $row['v_octCan'];
    $c_nov = $row['v_novCan'];
    $c_dec = $row['v_decCan'];
}

mysqli_close($conn);

?>

<script>

            var jan = <?php echo $jan; ?>;
            var feb = <?php echo $feb; ?>;
            var march = <?php echo $march; ?>;
            var april = <?php echo $april; ?>;
            var may = <?php echo $may; ?>;
            var june = <?php echo $june; ?>;
            var july = <?php echo $july; ?>;
            var aug = <?php echo $aug; ?>;
            var sept = <?php echo $sept; ?>;
            var oct = <?php echo $oct; ?>;
            var nov = <?php echo $nov; ?>;
            var dec = <?php echo $dec; ?>;

            // cancellations
            var c_jan = <?php echo $c_jan; ?>;
            var c_feb = <?php echo $c_feb; ?>;
            var c_march = <?php echo $c_march; ?>;
            var c_april = <?php echo $c_april; ?>;
            var c_may = <?php echo $c_may; ?>;
            var c_june = <?php echo $c_june; ?>;
            var c_july = <?php echo $c_july; ?>;
            var c_aug = <?php echo $c_aug; ?>;
            var c_sept = <?php echo $c_sept; ?>;
            var c_oct = <?php echo $c_oct; ?>;
            var c_nov = <?php echo $c_nov; ?>;
            var c_dec = <?php echo $c_dec; ?>;

            var chart;

            var customerData = [
                {
                    "country": "Jan",
                    "year2004": jan,
                    "cancellations": c_jan
                },
                {
                    "country": "Feb",
                    "year2004": feb,
                    "cancellations": c_feb
                },
                {
                    "country": "Mar",
                    "year2004": march,
                    "cancellations": c_march
                },
                {
                    "country": "Apr",
                    "year2004": april,
                    "cancellations": c_april
                },
                {
                    "country": "May",
                    "year2004": may,
                    "cancellations": c_may
                },
                {
                    "country": "June",
                    "year2004": june,
                    "cancellations": c_june
                },
                {
                    "country": "July",
                    "year2004": july,
                    "cancellations": c_july

                },
                {
                    "country": "Aug",
                    "year2004": aug,
                    "cancellations": c_aug
                },
                {
                    "country": "Sept",
                    "year2004": sept,
                    "cancellations": c_sept
                },
                {
                    "country": "Oct",
                    "year2004": oct,
                    "cancellations": c_oct
                },
                 {
                    "country": "Nov",
                    "year2004": nov,
                    "cancellations": c_nov
                },
                 {
                    "country": "Dec",
                    "year2004": dec,
                    "cancellations": c_dec
                }
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = customerData;
                chart.categoryField = "country";
                chart.color = "black"; //"#FFFFFF";
                chart.fontSize = 14;
                chart.startDuration = 1;
                chart.plotAreaFillAlphas = 0.2;
                // the following two lines makes chart 3D
                //chart.angle = 30;
                //chart.depth3D = 60;

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.gridAlpha = 0.2;
                categoryAxis.gridPosition = "start";
                categoryAxis.gridColor = "black"; //"#FFFFFF";
                categoryAxis.axisColor = "black"; //"#FFFFFF";
                categoryAxis.axisAlpha = 0.5;
                categoryAxis.dashLength = 5;

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.stackType = "3d"; // This line makes chart 3D stacked (columns are placed one behind another)
                valueAxis.gridAlpha = 0.2;
                valueAxis.gridColor = "black"; //"#FFFFFF";
                valueAxis.axisColor = "black"; //"#FFFFFF";
                valueAxis.axisAlpha = 0.5;
                valueAxis.dashLength = 5;
                valueAxis.title = "";
                valueAxis.titleColor = "black"; //"#FFFFFF";
                //valueAxis.unit = "%";
                chart.addValueAxis(valueAxis);

                // GRAPHS
                // first graph
                var graph1 = new AmCharts.AmGraph();
                graph1.title = "2015";
                graph1.valueField = "year2004";
                graph1.type = "column";
                graph1.lineAlpha = 0;
                graph1.lineColor = "green";//"#33FF66";//"#BEDF66"; //"#D2CB00";
                graph1.fillAlphas = 1;
                graph1.balloonText = "Customer growth in [[category]] (2015): <b>[[value]]</b>";
                chart.addGraph(graph1);

                // second graph
                var graph2 = new AmCharts.AmGraph();
                graph2.title = "2016";
                graph2.valueField = "cancellations";
                graph2.type = "column";
                graph2.lineAlpha = 0;
                graph2.lineColor = "red"; //"#BEDF66";
                graph2.fillAlphas = 1;
                graph2.balloonText = "Cancellations in [[category]] (2017): <b>[[value]]</b>";
                chart.addGraph(graph2);

                chart.write("stackedChart");
            });


        </script>

        <div id="stackedChart" style="width: 100%; height: 355px;"></div>

