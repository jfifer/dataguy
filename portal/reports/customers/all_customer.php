<?php require_once('../../php/pages_php/index/session.php'); ?>
<?php require_once("../../php/dbconn.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Customers</title>
  <meta charset="utf-8">

  <link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
  <!-- <link href="../../css/bootstrap.min.css" rel="stylesheet"> -->
  <link rel="stylesheet" type="text/css" href="../../css/custom_style.css">

  <link href="../../../testStuff/AMcharts/AMmap/ammap/ammap.css">
  <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.bootstrap.min.css">


  <script type="text/javascript" src="../../js/jquery.js"></script>
  <!-- // <script type="text/javascript" src="../../js/bootstrap.js"></script> -->

  <script type="text/javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.bootstrap.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
  <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.2/js/buttons.colVis.min.js"></script>


<script src="../../../testStuff/AMcharts/amcharts/amcharts.js" type="text/javascript"></script>
<script src="../../../testStuff/AMcharts/amcharts/serial.js" type="text/javascript"></script>
<script src="../../../testStuff/AMmap/ammap/ammap.js" type="text/javascript"></script>
<script src="../../../testStuff/AMmap/ammap/maps/js/usaLow.js" type="text/javascript"></script>

<!-- MAPS CDN -->
<!-- <script src="https://www.amcharts.com/lib/3/ammap.js"></script> -->
<!-- <script src="https://www.amcharts.com/lib/3/maps/js/usaLow.js"></script> -->
<!-- <script src="https://www.amcharts.com/lib/3/themes/none.js"></script> -->

<!-- Maps javascript -->
<script>
if ( window.addEventListener ){

    window.addEventListener("message", function(event) {

      if(event.data.length >= 22) {

        if( event.data.substr(0, 22) == "__MM-LOCATION.REDIRECT") location = event.data.substr(22);
      }
    },
    false);

  } else if ( window.attachEvent ){

    window.attachEvent("message", function(event) {

      if( event.data.length >= 22) {

        if ( event.data.substr(0, 22) == "__MM-LOCATION.REDIRECT") location = event.data.substr(22);
      }
    },
    false);
  }
</script>

<!-- DATA TABLE -->

<script type="text/javascript">
    $(document).ready(function() {
      var table = $('#table1').DataTable( {
        lengthChange: true,
        iDisplayLength: 100,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
      } );

      table.buttons().container()
        .appendTo( '#table1_wrapper .col-sm-6:eq(0)' );
    } );
  </script>

<!-- w.i.p. todo:  external link -->
<style type="text/css">

  .logo {
    margin-top: 10px;
    margin-left: 20px;
    float: left;
  }

  .container-fluid {
    background-color: #0076a3;
  }

  .navvy {
    color: #FFF !important;
  }

  .active {
    background-color: #FFF !important;
  }

  /*.page-header {
    font-family: 'Play', sans-serif;
  }*/

  body {
    font-family: 'Play', sans-serif;
  }
  #back {
    background-color: grey;
    color: #FFF;
  }
  </style>

</head>

<body>
<div class="col-xs-12 col-sm-6 col-lg-8">
<br><img class="logo" src="../../img/site_logo2.png" height="95px;" width="475px;">
</div>
<br><br><br><br><br><br><br>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"></a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li><a class="active" href="../../home.php">Home</a></li>
        <li><a class="navvy" href="../../reports/reports_index.php">Reports</a></li>
        <li><a class="navvy" href="../../dashboards/dashboards_index.php">Dashboards</a></li>
        <li><a class="navvy" href="../../request_data.php">Request Data</a></li>

        <li ><a id="back"  href="customers_index.php">BACK</a></li>
        <li><a class="navvy" href="../../index.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<?php
$count="SELECT COUNT(*) FROM customerList_view";

if ($result=mysqli_query($conn,$count) ) {
  $row_cnt = mysqli_fetch_array($result);
  $row_cnt = $row_cnt[0];
}
?>

<div class="container">
  <h2>Customers <small><?php echo date('l jS \of F Y h:i:s A'); ?></small></h2>
  <p>*CoreDial Active Customers</p>
  <!-- Need to fix customer counts before publishing. -->
  <!-- <small>Row Count: <?php //echo $row_cnt; ?></small> -->
</div>
<br>
<div class='container'>
<div class='row' style='width:85%; margin-left:8%;'>
  <table id="table1" class="table table-striped table-bordered" cellspacing="2" width="100%">
    <thead>
      <tr>
        <th>Customer ID</th>
        <th>Customer Name</th>
        <th>State</th>
        <th>Bill Date</th>
        <th><small>Co. Length</small></th>
        <!-- <th>Cancellation Date</th> -->
        <th>Reseller</th>
        <th>Trusted Network</th>
        <th>Feature Server</th>
      </tr>
    </thead>
    <tbody>
<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
// !!!!RUN getCustomerList();
$sql='SELECT customerId,
             companyName,
             state,
             originalActivationDate,
             contractLength,
             reseller,
             trust,
             hostname
        FROM customerList_view';

if ( $result=mysqli_query($conn,$sql) ) {

  while ($row=mysqli_fetch_array($result)) {

    $rows= array(
      "customerId" => $row["customerId"],
      "companyName" => $row["companyName"],
      "state" => $row["state"],
      "originalActivationDate" => $row["originalActivationDate"],
      "contractLength" => $row["contractLength"],
      "reseller" => $row["reseller"],
      "trust" => $row["trust"],
      "hostname" => $row["hostname"]

      );

  $scrub = json_encode($rows);

   echo "<tr>".
        "<td>".
          "<a href='../../spdrillin_action.php?v_customerId=".$rows['customerId']."'>".$rows['customerId']."</a>".
         "</td>".
        "<td>".$rows['companyName']."</td>".
        "<td>".$rows['state']."</td>".
        "<td>".$rows['originalActivationDate']."</td>".
        "<td>".$rows['contractLength']."</td>".
        "<td>".$rows['reseller']."</td>".
        "<td>".$rows['trust']."</td>".
        "<td>".$rows['hostname']."</td>"."
      </tr>";

 }
}

mysqli_close($conn);

?>
  </body>
  </table>
  </div>
</div>

<div class="container">
<!-- state metric here -->
<div class="row" style="width:80%; margin-left:14%;">
  <h2>Map Overview</h2>
  <?php //require_once('../../php/pages_php/all_customer/customerCountByState.php'); ?>
  <?php require_once('../../php/pages_php/all_customer/customerCountByStateMap.php'); ?><br><br>

  <!-- http://createaclickablemap.com/ -->
  <!-- <iframe src="http://createaclickablemap.com/map.php?&id=44188&online=true" width="100%" height="800" style="border: none;"></iframe> -->
</div>
</div>


<div class="row" style="width:80%; margin-left:14%;">
  <!-- <h2>Customers By State</h2> -->
  <?php //require_once('../../php/pages_php/all_customer/customerCountByState.php'); ?>
  <?php //require_once('../../php/pages_php/all_customer/customerCountByStateMap.php'); ?><br><br>
</div>

<!-- END REPORT CONTAINER -->
</div>


</body>
</html>
