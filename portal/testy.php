<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["geomap"]});
      google.setOnLoadCallback(drawMap);

      function drawMap() {
        var data = google.visualization.arrayToDataTable([

["State", "Customers"],
["AK",4],
["AL",332],
["AR",32],
["AS",1],
["AZ",80],
["CA",939],
["CO",122],
["CT",253],
["DC",117],
["DE",183],
["FL",1169],
["GA",336],
["HI",1],
["IA",6],
["ID",15],
["IL",278],
["IN",94],
["KS",103],
["KY",38],
["LA",206],
["MA",1209],
["MD",523],
["ME",8],
["MI",201],
["MN",64],
["MO",245],
["MS",113],
["MT",12],
["NC",229],
["ND",1],
["NE",21],
["NH",42],
["NJ",1548],
["NM",6],
["NV",42],
["NY",1732],
["OH",289],
["OK",161],
["OR",41],
["PA",2636],
["PW",6],
["RI",138],
["SC",58],
["SD",4],
["TN",162],
["TX",301],
["UT",14],
["VA",615],
["VI",1],
["VT",11],
["WA",33],
["WI",31],
["WV",202],
["WY",3]
]);
        var options = {};
        options['dataMode'] = 'markers';
        options['region'] = 'US';
        options['showLegend'] = true;
        options['colors'] = [0xFF8747, 0xFFB581, 0xFFC581];

        var container = document.getElementById('us_customers');
        var geomap = new google.visualization.GeoMap(container);

        geomap.draw(data, options);
      };
    </script>
  </head>
  <body>
    <div id="us_customers" style="width: 100%; height: 600px;"></div>
  </body>
</html>
