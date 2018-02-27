$(function () {

var graph0;
$(document).ready(function () {
    graph0 = new Highcharts.Chart({
        chart: {
            renderTo: 'graph0'
        },
        plotOptions: {
            column: {
            dataLabels: {
                enabled: true,
                color: 'black'
            }
          }
        },
        credits: {
            enabled: false
        },
        exporting: { 
            enabled: false
        },
        legend: {
            layout: 'horizontal',
            verticalAlign: 'bottom',
            itemStyle: {color: "black"}
        },
        title: {
            text: ''
        },
        tooltip: {
            formatter: function () {
                if (this.series.name == 'Accumulated') {
                    return this.y + '%';
                }
                return this.x + '<br/>' + '<b> ' + this.y.toString().replace('.', ',') + ' </b>';
            }
        },
        xAxis: {

            categories: [
                         'New Horizons', 
                         'Comstar Technologies',    
                         'Compu-Phone', 
                         'Citi-Tel', 
                         'TDS', 
                         'Blueline Telecom',
                         'PCS, Inc.',
                         'VoxNet', 
                         'CoreDial', 
                         'BNC Voice',
                         'All'
                        ],
            labels: {
                style: {
                    color: 'black'
                }
            },
            ceiling: 100


        },

        yAxis: [{
            title: {
                text: '',
                style: { color: 'black'}
            },
            type: 'logarithmic',
            
        }, {
            labels: {
                formatter: function () {
                    return this.value + '%';
                },
                style: {
                    color: "black"
                }
            },
            max: 100,
            min: 0,
            opposite: true,
            // plotLines: [{
            //     color: '#89A54E',
            //     dashStyle: 'shortdash',
            //     value: 80,
            //     width: 3,
            //     zIndex: 10
            // }],
            title: {
                text: 'Overall %',
                style: {
                    color: 'black'
                }
            }
        }],

        series: [
            {
            data: [765, 528, 355, 321, 316, 292, 278, 277, 269, 243, 10606],
            name: 'Customer Count',
            type: 'column',
            color: 'blue'
            }, 
            {
            data:  data, //Set
            name: 'Accumulated %',
            type: 'spline',
            yAxis: 1,
            id: 'accumulated',
            color: '#66FF66' // #3300FF'//'#FF0000'//'#b2c831'
            }
        ]
    });
    // ,
    

    //  function (graph0) {
    //     var x = 0.8 * chart.plotWidth;

    //     chart.renderer.path([
    //         'M',
    //     x, chart.plotTop,
    //         'L',
    //     x, chart.plotTop + chart.plotHeight]).attr({
    //         'stroke-width': 2,
    //         stroke: 'red',
    //         id: 'vert',
    //             'stroke-dasharray': "5,5",
    //         zIndex: 2000
    //     }).add();

    // });

   });
  });
