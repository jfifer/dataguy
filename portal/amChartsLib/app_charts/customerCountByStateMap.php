<?php
// MUST RUN! createActiveCustomerView();
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$CustCount='SELECT "State","Customers"
        UNION
        SELECT DISTINCT a.state AS "State",
               COUNT(customerId) AS "Customers"
          FROM activeCustomer_view c
          JOIN address a ON (a.addressId = c.billingAddressId)
         WHERE c.statusId NOT IN (2,3)
           AND a.state !=""
           GROUP BY 1';

if ($result=mysqli_query($conn,$CustCount) ) {

while ($row=mysqli_fetch_row($result)) {
   $myArray[] = $row;
}
$cleanup = json_encode($myArray,JSON_NUMERIC_CHECK);
}
?>

<!-- Google Map, Customer By State -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['geochart']});
google.charts.setOnLoadCallback(drawRegionsMap);
function drawRegionsMap() {
var cleanup = <?php echo $cleanup; ?>;
var data = google.visualization.arrayToDataTable(cleanup);
        var options = {
          dataMode: 'region',
          resolution: 'provinces',
          region: 'US',
          colorAxis: {colors: ['#E8E8E8','#0066FF','#0033FF','#000099']},
          backgroundColor: '#FFF',
          datalessRegionColor: '#FF0000',
          defaultColor: '#FFFFF',
        };
        var chart = new google.visualization.GeoChart(document.getElementById('us_customers'));
        chart.draw(data, options);
      }
</script>

<div class="row" id="us_customers" style="margin-left: 5%; width: 100%; height: 650px;"></div>