$(function () {

    var line3x;
$(document).ready(function() {
line3x = new Highcharts.Chart({

        chart: {renderTo: 'extensions'},
        title: {
            text: ''        },
        subtitle: {
            text: ''          
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            ceiling: 1000,
            floor: 0,
            title: {
                text: ''
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
       tooltip: {
            headerFormat: '<b>{series.name}</b><br>',
            pointFormat: '{point.x:%b}: {point.y:.0f} Total'
        },
        exporting: { 
            enabled: false
        },

        series: [{
            name: 'Standard Extensions',
            data: [7, 6, 9, 14, 18, 21, 25, 26, 23, 18, 13, 9]
        }, {
            name: 'Cloud Extensions',
            data: [1, 2, 5, 11, 17, 22, 24, 24, 20, 14, 8, 10]
        }, {
            name: 'Sip Trunks',
            data: [3, 5, 6, 8, 13, 17, 18, 17, 14, 9, 10, 12]
        }]
    });
});
});