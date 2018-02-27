$(function () {

    var bar1;
    $(document).ready(function() {
     bar1 = new Highcharts.Chart({

        chart: {
            renderTo: 'bar1',
            backgroundColor: '#FFF', //'#3d3d3d', //#909090
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
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            },
            floor: 0,            
            labels: {
                formatter: function () {
                    return this.value + 'K';
                },
                style: {
                    color: "black"
                }
            },
            // max: 100,
            // min: 0,
            opposite: true,
            // plotLines: [{
            //     color: '#89A54E',
            //     dashStyle: 'shortdash',
            //     value: 80,
            //     width: 3,
            //     zIndex: 10
            // }],
            title: {
                text: '',
                style: {
                    color: 'black'//'#b2c831'
                }
            }
        
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
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
                borderWidth: 0
            }
        },
        series: [{
            name: '2015',
            data: [105.9, 125.5, 130.4, 135.2, 144.0, 145.0, 146.6, 148.5, 150.5, 0.0, 0.0, 0.0],
            color: 'blue' //'#0066FF'


        }, {
            name: '2014',
            data: [85.9, 86.5, 87.4, 89.0, 89.0, 89.0, 89.6, 92.5, 98.5, 100.6, 105.3,105.8],
            color: '#3d3d3d'

        }, {
            name: '2013',
            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2],
            color: '#66FF66' //'#b2c831'
        }]
    });
  });
});
		
