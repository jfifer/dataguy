$(function () {

    var bar0;
    $(document).ready(function() {
     bar0 = new Highcharts.Chart({

        chart: {
            renderTo: 'bar0',
            backgroundColor:'#FFF', //#909090
            type: 'column'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: {

            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
            labels: {
                style: {
                    color: 'black'
                }
            },
            crosshair: true
        },
        yAxis: {
            title: {
                text: '%',
                  style: {
                    color: "black"
                  }
            },
            ceiling: 100,
            floor: 99.5,
            labels: {
                style: {
                    color: 'black'
                }
            }

        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                         '<td style="padding:0"><b>{point.y:.2f} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        legend: {
            itemStyle:{'color':'black'}
        },
        exporting: { 
            enabled: false 
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                dataLabels: {
                  enabled: true,
                  color: 'black'
            }
          }
        },
        series: [{
            name: '%',
            data: upTimeX,
            // data: [
            //        100, 
            //        100, 
            //        100, 
            //        99.95, 
            //        99.92, 
            //        99.72, 
            //        100, 
            //        100, 
            //        100
            //       ],
            color: 'blue',//'#66FF66', //#0066FF',
            type: 'column'


        }, {
            name: 'YTD',
            data: upTimeY,
            // data: [
            //        100, 
            //        100, 
            //        100, 
            //        99.98, 
            //        99.97, 
            //        99.93, 
            //        99.94, 
            //        99.94,
            //        99.95 //september
            //        ],
            color: '#66FF66', //#b2c831',
            type: 'spline'        


        }]
    });
  });
});
		
