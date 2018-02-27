<?php

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$sql1='call customerServicesDrillIn('.$customerId.');';

if ( $result=mysqli_query($conn,$sql1) ) {

  while ($row=mysqli_fetch_row($result)) {

  	         $arrayData[] = array(
                  "year" => $row[0],
                  "didCount" => $row[1],
                  "extCount" => $row[2],
                  "mailCount" => $row[3],
                  "aaCount" => $row[4]
                );

  	         $cleanData = json_encode($arrayData);
  }
}

mysqli_close($conn);
?>

<script type="text/javascript">

var cleanData = <?php echo $cleanData; ?>

    var chart = AmCharts.makeChart("servicesArea", {
    "type": "serial",
    "theme": "light",
    "marginRight":30,
    "legend": {
        "equalWidths": false,
        // "periodValueText": "total: [[value.sum]]",
        "position": "top",
        "valueAlign": "left",
        "valueWidth": 100
    },
    "dataProvider": cleanData,
    "valueAxes": [{
        "stackType": "regular",
        "gridAlpha": 0.07,
        "position": "left",
        "title": ""
    }],
    "graphs": [{
        "balloonText": "<span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
        "fillAlphas": 0.6,
        "hidden": false,
        "lineAlpha": 0.4,
        "title": "DID",
        "valueField": "didCount"
    }, {
        "balloonText": "<span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
        "fillAlphas": 0.6,
        "lineAlpha": 0.4,
        "title": "Extensions",
        "valueField": "extCount"
    },
     {
        "balloonText": "<span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
        "fillAlphas": 0.6,
        "lineAlpha": 0.4,
        "title": "Mailboxes",
        "valueField": "mailCount"
    },
     {
        "balloonText": "<span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
        "fillAlphas": 0.6,
        "lineAlpha": 0.4,
        "title": "AutoAttendants",
        "valueField": "aaCount"
     },
     {
        "balloonText": "<span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
        "fillAlphas": 0.6,
        "lineAlpha": 0.4,
        "title": "TimeFrames",
        "valueField": "timeCount"
    },
     {
        "balloonText": "<span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
        "fillAlphas": 0.6,
        "lineAlpha": 0.4,
        "title": "Groups",
        "valueField": "groupCount"
    },
     {
        "balloonText": "<span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
        "fillAlphas": 0.6,
        "lineAlpha": 0.4,
        "title": "Conference Bridges",
        "valueField": "confCount"
    }



    ],
    "plotAreaBorderAlpha": 0,
    "marginTop": 10,
    "marginLeft": 0,
    "marginBottom": 0,
    "chartScrollbar": {},
    "chartCursor": {
        "cursorAlpha": 0
    },
    "categoryField": "year",
    "categoryAxis": {
        "startOnAxis": true,
        "axisColor": "#DADADA",
        "gridAlpha": 0.07,
        "title": "Year",
        "guides": [{
            category: "2001",
            toCategory: "2003",
            lineColor: "#CC0000",
            lineAlpha: 1,
            fillAlpha: 0.2,
            fillColor: "#CC0000",
            dashLength: 2,
            inside: true,
            labelRotation: 90,
            label: "Nothing yet...."
        }, {
            category: "2007",
            lineColor: "#CC0000",
            lineAlpha: 1,
            dashLength: 2,
            inside: true,
            labelRotation: 90,
            label: "Nothing yet...."
        }]
    },
    "export": {
    	"enabled": true
     }
});

</script>


<div id="servicesArea"></div>



