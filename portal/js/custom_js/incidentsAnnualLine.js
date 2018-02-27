$(function () {
    $('#incidents').highcharts({
        title: {
            text: '',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct','Nov','Dec']
        },
        yAxis: {
            title: {
                text: 'Count'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: 'red'//'#808080'
            }],
            floor:0,
            ceiling: 1200
        },
        tooltip: {
            valueSuffix: ''
        },
        exporting: {
            enabled:false
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Incidents',
            data: [
            16, 
            32, 
            31, 
            25, 
            32, 
            17, 
            95, 
            835, 
            133,
            20,0,0
            ]
        }]
    });
});