<!-- <!DOCTYPE HTML> -->

         <!-- <link rel="stylesheet" href="../../../testStuff/AMcharts/samples/style.css" type="text/css"> -->
         <!-- <script src="../../../testStuff/AMcharts/amcharts/amcharts.js" type="text/javascript"></script>
         <script src="../../../testStuff/AMcharts/amcharts/pie.js" type="text/javascript"></script> -->

        <script>


            var chart;

            var servicesData = [
                {
                    "service": "Phone Numbers (DID)",
                    "visits": 9252
                },
                {
                    "service": "Extensions",
                    "visits": 1882
                },
                {
                    "service": "Mailboxes",
                    "visits": 1809
                },
                {
                    "service": "Auto Attendants",
                    "visits": 1322
                },
                {
                    "service": "Time Frames",
                    "visits": 1122
                },
                {
                    "service": "Groups",
                    "visits": 1114
                },
                {
                    "service": "Conference Bridges",
                    "visits": 984
                }
                
            ];


            AmCharts.ready(function () {
                
                // PIE CHART
                chart = new AmCharts.AmPieChart();
                chart.radius = 50;

                // title of the chart
                //chart.addTitle("", 16);

                chart.dataProvider = servicesData;
                chart.titleField = "service";
                chart.valueField = "visits";
                chart.sequencedAnimation = true;
                chart.startEffect = "elastic";
                //chart.innerRadius = "100%";
                chart.startDuration = 2;
                chart.labelRadius = 15;
                chart.balloonText = "[[title]]<br><span style='font-size:16px'><b>[[value]]</b> ([[percents]]%)</span>";
                // the following two lines makes the chart 3D
                chart.depth3D = 10;
                chart.angle = 15;

                // WRITE
                chart.write("services_pie");
            });
        </script>


        <div id="services_pie" style="width:100%; height:100%;"></div>

