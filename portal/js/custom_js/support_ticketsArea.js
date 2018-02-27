$(function () {

    var support_tickets;

     $(document).ready(function() {
     support_tickets = new Highcharts.Chart({

        chart: {
            renderTo: 'support_tickets',
            type: 'area'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        exporting: {
            enabled:false
        },
        xAxis: {
            allowDecimals: false,
            labels: {
                formatter: function () {
                    return this.value; // clean, unformatted number for year
                }
            }
        },
        yAxis: {
            title: {
                text: ''
            }
            // ,
            // labels: {
            //     formatter: function () {
            //         return this.value / 1000 + 'k';
            //     }
            // }
        },
        tooltip: {
            pointFormat: '{series.name}  <b>{point.y:,.0f}</b><br/> in {point.x}'
        },
        plotOptions: {
            area: {
                pointStart: 2014,
                marker: {
                    enabled: false,
                    symbol: 'circle',
                    radius: 2,
                    states: {
                        hover: {
                            enabled: true
                        }
                    }
                }
            }
        },
        series: [{
            name: 'Submitted',
            data: [16,25,6]
        }, {
            name: 'Resolved',
            data: [13,22,3]
        }]
    });
  });
});