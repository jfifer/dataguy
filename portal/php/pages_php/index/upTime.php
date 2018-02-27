<script>
            var chart;

            var upTimeData = [
            {
                    "month": 'Jan 2015',
                    "count": 100.00,
                    "overall": 100.00
                },
                {
                    "month": 'Feb',
                    "count": 100.00,
                    "overall": 100.00
                },
                {
                    "month": 'Mar',
                    "count": 100.00,
                    "overall": 100.00
                },
                {
                    "month": 'Apr',
                    "count": 99.98,
                    "overall": 99.95
                },
                {
                    "month": 'May',
                    "count": 99.97,
                    "overall": 99.92
                },
                {
                    "month": 'June',
                    "count": 99.93,
                    "overall": 99.72
                },
                {
                    "month": 'July',
                    "count": 99.94,
                    "overall": 100.00
                },
                {
                    "month": 'Aug',
                    "count": 99.94,
                    "overall": 100.00
                },
                {
                    "month": 'Sept',
                    "count": 99.95,
                    "overall": 100.00
                },
                {
                    "month": 'Oct',
                    "count": 99.95,
                    "overall": 100.00
                },
                {
                    "month": 'Nov',
                    "count": 99.96,
                    "overall": 100.00
                },
                {
                    "month": 'Dec',
                    "count": 99.95,
                    "overall": 99.86
                },
                {
                    "month": 'Jan 2016',
                    "count": 100.00,
                    "overall": 100.00
                },
                {
                    "month": 'Feb',
                    "count": 100.00,
                    "overall": 100.00
                },
                {
                    "month": 'Mar',
                    "count": 100.00,
                    "overall": 100.00
                },
                {
                    "month": 'Apr',
                    "count": 100.0,
                    "overall": 100.00
                },
                {
                    "month": 'May',
                    "count": 100.00,
                    "overall": 100.00
                },
                {
                    "month": 'June',
                    "count": 100.00,
                    "overall": 100.00
                },
                {
                    "month": 'July',
                    "count": 0,
                    "overall": 0
                },
                {
                    "month": 'Aug',
                    "count": 0,
                    "overall": 0
                },
                {
                    "month": 'Sept',
                    "count": 0,
                    "overall": 0
                },
                {
                    "month": 'Oct',
                    "count": 0,
                    "overall": 0
                },
                {
                    "month": 'Nov',
                    "count": 0,
                    "overall": 0
                },
                {
                    "month": 'Dec',
                    "count": 0,
                    "overall": 0
                }

                // {
                //     "month": 'Jan',
                //     "count": 100.00,
                //     "overall": 100.00
                // },
                // {
                //     "month": 'Feb',
                //     "count": 100.00,
                //     "overall": 100.00
                // },
                // {
                //     "month": 'March',
                //     "count": 100.00,
                //     "overall": 100.00
                // },
                // {
                //     "month": 'April',
                //     "count": 99.95,
                //     "overall": 99.98
                // },
                // {
                //     "month": 'May',
                //     "count": 99.92,
                //     "overall": 99.97
                // },
                // {
                //     "month": 'June',
                //     "count": 99.72,
                //     "overall": 99.93
                // },
                // {
                //     "month": 'July',
                //     "count": 100.00,
                //     "overall": 99.94
                // },
                // {
                //     "month": 'Aug',
                //     "count": 100.00,
                //     "overall": 99.94
                // },
                // {
                //     "month": 'Sept',
                //     "count": 100.00,
                //     "overall": 99.95
                // },
                // {
                //     "month": 'Oct',
                //     "count": 100.00,
                //     "overall": 99.95
                // },
                // {
                //     "month": 'Nov',
                //     "count": 100.00,
                //     "overall": 99.97
                // },
                // {
                //     "month": 'Dec',
                //     "count": 100.00,
                //     "overall": 99.97
                // }


            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = upTimeData;
                chart.categoryField = "month";
                chart.startDuration = 1;
                chart.rotate = false;

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.gridPosition = "start";
                categoryAxis.axisColor = "#DADADA";
                categoryAxis.dashLength = 3;

                // value
                var valueAxis = new AmCharts.ValueAxis();
                //valueAxis.logarithmic = true;
                //valueAxis.dashLength = 3;
                //valueAxis.axisAlpha = 0.2;
                valueAxis.position = "right";
                //valueAxis.title = "";
                valueAxis.minorGridEnabled = false;
                //valueAxis.minorGridAlpha = 0.10;
                //valueAxis.gridAlpha = 0.15;
                valueAxis.autoGridCount = true;
                //valueAxis.labelFrequency = .2;
                valueAxis.maximum = 100.00;
                valueAxis.minimum = 95.0;
                chart.addValueAxis(valueAxis);

                // GRAPHS
                // column graph
                var graph1 = new AmCharts.AmGraph();
                graph1.type = "column";
                graph1.title = "UpTime";
                graph1.valueField = "count";
                graph1.lineAlpha = 0;
                graph1.fillColors = "green";//"#ADD981";
                graph1.fillAlphas = 0.8;
                graph1.balloonText = "<span style='font-size:13px;'>[[title]] in  [[category]]:<b>[[value]]</b></span>";
                chart.addGraph(graph1);

                // line graph
                var graph2 = new AmCharts.AmGraph();
                graph2.type = "line";
                graph2.lineColor = "#27c5ff";
                graph2.bulletColor = "blue"; //"#FFFFFF";
                graph2.bulletBorderColor = "#27c5ff";
                graph2.bulletBorderThickness = 2;
                graph2.bulletBorderAlpha = 1;
                graph2.title = "Overall %";
                graph2.valueField = "overall";
                graph2.lineThickness = 2;
                graph2.bullet = "round";
                graph2.fillAlphas = 0;
                graph2.logarithmic = true;
                graph2.balloonText = "<span style='font-size:13px;'>[[title]] in  [[category]]:<b>[[value]]</b></span>";
                chart.addGraph(graph2);

                // LEGEND
                var legend = new AmCharts.AmLegend();
                legend.useGraphSettings = true;
                chart.addLegend(legend);

                chart.creditsPosition = "top-right";

                // WRITE
                chart.write("upTime");
            });
        </script>

        <div id="upTime" style="width: 100%; height: 600px;"></div>

