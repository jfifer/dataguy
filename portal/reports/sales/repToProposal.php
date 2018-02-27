<?php require_once("../../php/dbconn.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sales Rep To Prop...</title>
  <meta charset="utf-8">

  <link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="../../css/custom_style.css">
  <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.bootstrap.min.css">
  <!-- jquery -->
  <script type="text/javascript" src="../../js/jquery.js"></script>

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

     .portfolio-item {
        margin-bottom: 3px;
     }

     #back {
      background-color: grey;
      color: #FFF;
     }

  </style>

</head>

<body>

<div class="col-xs-12 col-sm-6 col-lg-8">
<img class="logo" src="../../img/site_logo2.png" height="95px;" width="475px;">
</div>
<br><br><br><br><br><br>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"></a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li><a class="navvy" href="../../index.php">Home</a></li>
        <li><a class="active" href="../reports_index.php">Reports</a></li>
        <li><a class="navvy" href="../../dashboards/dashboards_index.php">Dashboards</a></li>
        <li><a class="navvy" href="../../request_data.php">Request Data</a></li>
        <li ><a id="back"  href="sales_index.php">BACK</a></li>

      </ul>
    </div>
  </div>
</nav>


<div class="container">
    <h2>Sales Rep To Proposal <small><?php echo date('l jS \of F Y h:i:s A'); ?></small></h2><br>




<div class="container">
 <div style="overflow: auto;">
    <table id="table1" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>SP ID</th>
          <th>Sales Rep</th>
          <th>Customer Name</th>
          <th>Proposal Id</th>
          <th>Date Created</th>
          <th>Term Length</th>
          <th>Total</th>
        </tr>
      </thead>
    <tbody>

<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

$sql1='SELECT p.resellerId,
              concat(u.firstName," ",lastName) name,
              c.companyName,
              p.proposalId,
              CAST(p.dateCreated AS DATE) dateCreated,
              p.termLength,
              p.total
         FROM customer c
         LEFT JOIN proposal p ON (c.customerId = p.companyId)
         LEFT JOIN user u
         ON (
             p.salesRepId = u.userId
             AND u.enabled
             AND u.isSalesRep
            )

         WHERE p.dateCreated >= "2015-01-01"
           AND c.statusId IN (1,2,3)
           AND c.companyName NOT LIKE "%Test%"
           AND c.companyName NOT LIKE "%test%"
           AND c.companyName NOT LIKE "%Demo%"
           AND c.companyName NOT LIKE "%demo%"';


if ( $result=mysqli_query($conn,$sql1) ) {

  while ( $row=mysqli_fetch_assoc($result) ) {

    $resellerId = $row['resellerId'];
    $name = $row['name'];
    $companyName = $row['companyName'];
    $proposalId = $row['proposalId'];
    $dateCreated = $row['dateCreated'];
    $term = $row['termLength'];
    $total = $row['total'];


        echo "<tr>".
             "<td>"."<a href='?repId=".$resellerId."'>".$resellerId."</a>"."</td>".
             "<td>".$name."</td>".
             "<td>".$companyName."</td>".
             "<td>".$proposalId."</td>".
             "<td>".$dateCreated."</td>".
             "<td>".$term."</td>".
             "<td>".$total."</td>".
             "</tr>";
  }
}

?>
    </tbody>
  </table>

</div>

 <!-- overflow div -->
</div>
<hr>



<br><br><br><br><br><br><br><br>



</div> <!-- MAIN CONTAINER END -->
</body>
</html>



