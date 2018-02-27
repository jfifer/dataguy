<?php require_once("../../php/dbconn.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Users</title>
  <meta charset="utf-8">


  <link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.bootstrap.min.css">
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../../css/custom_style.css">

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

<!-- OLD
  <link rel="stylesheet" type="text/css" href="../../../testStuff/dataTables_ASC_DESC/css.css">

  <script type="text/javascript" src="../../js/bootstrap.js"></script>
  <script type="text/javascript" src="../../js/custom_js/main.js"></script>

  <script type="text/javascript" src="../../../testStuff/dataTables_ASC_DESC/jquery-1.11.js"></script>
  <script type="text/javascript" src="../../../testStuff/dataTables_ASC_DESC/dataTable.js"></script>
 -->

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
        <li><a class="navvy" href="../../home.php">Home</a></li>
        <li><a class="active" href="../reports_index.php">Reports</a></li>
        <li><a class="navvy" href="../../dashboards/dashboards_index.php">Dashboards</a></li>
        <li><a class="navvy" href="../../request_data.php">Request Data</a></li>
        <li><a id="back"  href="users_index.php">BACK</a></li>
        <li><a href="../../index.php"></a>Logout</li>

      </ul>
    </div>
  </div>
</nav>

<div class="container">


<?php

$count="SELECT COUNT(*)
          FROM user
         WHERE enabled
           AND username NOT LIKE '%test%'
           AND customerId IS NOT NULL
           AND customerId != ''";

if ($result=mysqli_query($conn,$count) ) {

  $row_cnt = mysqli_fetch_array($result);
  $row_cnt = $row_cnt[0];
}
?>

  <h2>Users <small><?php echo date('l jS \of F Y h:i:s A'); ?></small></h2>
  <p>*CoreDial Portal Users</p>
  <small>Row Count: <?php echo $row_cnt; ?></small>

  <div style="overflow: auto;">
  <br>
  <table id="table1" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>User ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Username</th>
        <th>Customer ID</th>
        <th>Branch ID</th>
      </tr>
    </thead>
<tbody>
<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

$sql='SELECT userId,
             firstname,
             lastname,
             username,
             customerId,
             branchId
        FROM user
       WHERE enabled
         AND username NOT LIKE "%test%"
         AND customerId IS NOT NULL
         AND customerId != ""
         -- DEMO ONLY!
         LIMIT 5000
         ';

if ( $result=mysqli_query($conn,$sql) ) {

  while ($row=mysqli_fetch_array($result)) {

  echo "<tr>".
        "<td>".$row['userId']."</td>".
        "<td>".$row['firstname']."</td>".
        "<td>".$row['lastname']."</td>".
        "<td>".$row['username']."</td>".
        "<td>".$row['customerId']."</td>".
        "<td>".$row['branchId']."</td>"."
      </tr>
      ";
  }
}

mysqli_close($conn);

?>
</tbody>
  </table>

</div> <!-- overflow div -->

</div> <!-- CONTAINER END -->

</body>


 <!-- Begin Navbar -->
<!-- <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
      <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".upper-navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <a class="navbar-brand" href="#">Filter By:</a>

        <form class="navbar-form pull-left" role="search" method="get" id="searchform" action="all_users_search.php">
        <div class="input-group">
          <div class="input-group-btn">
                  <p class="btn">
                    <select  id="selector" name="customField">
                      <option value=""></option>
                      <option value="uId">User ID</option>
                      <option value="fName">First Name</option>
                      <option value="lName">Last Name</option>
                      <option value="username">Username</option>
                      <option value="customerId">Customer ID</option>
                      <option value="branchId">Branch ID</option>
                      <option value="all">All</option>
                    </select>
                  </p>

          </div>
          <input type="text" class="form-control" value="" placeholder="Search..." name="filter" id="filter">
          <div class="input-group-btn">
            <button type="submit" id="searchsubmit" value="Search" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
          </div>
        </div>
        </form>
    </div>
      <div class="collapse navbar-collapse upper-navbar">
          <ul id="menu-topmenu" class="nav navbar-nav navbar-right">
            <li id="menu-item-1"><a href="../../index.php">Home</a></li>
            <li id="menu-item-2"><a href="users_index.php">Back</a></li>
          </ul>
      </div>
      </div>
</nav> -->
<!-- /.navbar -->


</html>
