<?php require_once("../../php/dbconn.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Service Providers</title>
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
        <li><a class="navvy" href="../../home.php">Home</a></li>
        <li><a class="active" href="../reports_index.php">Reports</a></li>
        <li><a class="navvy" href="../../dashboards/dashboards_index.php">Dashboards</a></li>
        <li><a class="navvy" href="../../request_data.php">Request Data</a></li>
        <li><a id="back"  href="resellers_index.php">BACK</a></li>
        <li><a class="navvy" href="../../index.php">Logout</a></li>
     </ul>
    </div>
  </div>
</nav>

<!--
TODO: NEED TO IDENTIFY WHAT LEVEL 1,2,3 IS, ALSO, NEED TO FIX STYLING ISSUE FOR TILES
-->

<?php
// $conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
// $count="SELECT COUNT(*) count
//           FROM tmp_sp
//          WHERE v_companyName NOT LIKE '%demo%'
//            AND v_companyName NOT LIKE '%test%'
//            AND v_companyName NOT LIKE '%Test%'
//            AND v_companyName NOT LIKE '%demo%'
//            AND v_extCount !=0";

// if ( $result=mysqli_query($conn,$count) ) {

//     $row_cnt = mysqli_fetch_assoc($result);
//     $active = $row_cnt['count'];
// }
?>

<?php
// $conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
// $count1="SELECT COUNT(*) count
//            FROM tmp_sp
//            LEFT JOIN reseller r ON (r.resellerId = tmp_sp.v_resellerId)
//           WHERE r.tier=1
//             AND r.companyName NOT LIKE '%demo%'
//             AND r.companyName NOT LIKE '%test%'
//             AND r.companyName NOT LIKE '%Test%'
//             AND r.companyName NOT LIKE '%Demo%'
//             AND v_extCount !=0";

// if ( $result=mysqli_query($conn,$count1) ) {

//     $row_cnt = mysqli_fetch_assoc($result);
//     $tier1 = $row_cnt['count'];
// }
?>

<?php
// $conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
// $count2="SELECT COUNT(*) count
//            FROM tmp_sp
//            LEFT JOIN reseller r ON (r.resellerId = tmp_sp.v_resellerId)
//           WHERE r.tier=2
//             AND r.companyName NOT LIKE '%demo%'
//             AND r.companyName NOT LIKE '%test%'
//             AND r.companyName NOT LIKE '%Test%'
//             AND r.companyName NOT LIKE '%Demo%'
//             AND v_extCount !=0";

// if ( $result=mysqli_query($conn,$count2) ) {

//     $row_cnt = mysqli_fetch_assoc($result);
//     $tier2 = $row_cnt['count'];
// }
?>

<?php

// $conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
// $count3="SELECT COUNT(*) count
//            FROM tmp_sp
//            LEFT JOIN reseller r ON (r.resellerId = tmp_sp.v_resellerId)
//           WHERE r.tier=3
//             AND r.companyName NOT LIKE '%demo%'
//             AND r.companyName NOT LIKE '%test%'
//             AND r.companyName NOT LIKE '%Test%'
//             AND r.companyName NOT LIKE '%Demo%'
//             AND v_extCount !=0";

// if ( $result=mysqli_query($conn,$count3) ) {

//     $row_cnt = mysqli_fetch_assoc($result);
//     $tier3 = $row_cnt['count'];
// }
?>


<div class="container">
    <h2>Service Providers <small><?php echo date('l jS \of F Y h:i:s A'); ?></small></h2><br>

<div class="row">

<?php
//    echo "
// </div>
//  <div class='row'>
//       <div class='col-lg-3 col-md-6'>
//           <div class='panel panel-primary'>
//               <div class='panel-heading'>
//                   <div class='row'>
//                       <div class='col-xs-3'>
//                           <i class='fa fa-comments fa-5x'></i>
//                       </div>
//                       <div class='col-xs-9 text-right'>
//                           <div class='huge'></div>
//                           <div>Active</div>
//                       </div>
//                   </div>
//               </div>
//            <div class='panel-footer'>".
//           "<span class='pull-left'>$active</span>".
//           "<span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
//          <div class='clearfix'></div>
//         </div>
//         </a>

//         </div>
//       </div>
//       <div class='col-lg-3 col-md-6'>
//           <div class='panel panel-green'>
//               <div  style='background-color:orange;' class='panel-heading'>
//                   <div class='row'>
//                       <div class='col-xs-3'>
//                           <i class='fa fa-tasks fa-5x'></i>
//                       </div>
//                       <div class='col-xs-9 text-right'>
//                           <div class='huge'></div>".
//         "<div>Level 1</div>
//                       </div>
//                   </div>
//               </div>
//               <a href='customer_base_overview_2015.php?resellerId='>".
//         "<div class='panel-footer'>
//                       <span class='pull-left'>$tier1</span>
//                       <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
//                       <div class='clearfix'></div>
//                   </div>
//               </a>
//           </div>
//       </div>


//       <div class='col-lg-3 col-md-6'>
//           <div>
//               <div style='background-color:green;' class='panel-heading'>
//                   <div class='row'>
//                       <div class='col-xs-3'>
//                           <i class='fa fa-shopping-cart fa-5x'></i>
//                       </div>
//                       <div class='col-xs-9 text-right'>
//                           <div class='huge'></div>
//                           <div>Level 2</div>
//                       </div>
//                   </div>
//               </div>
//               <a href='cancellation_overview_2014.php?resellerId='>".
//         "<div class='panel-footer'>
//                       <span class='pull-left'>$tier2</span>
//                       <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
//                       <div class='clearfix'></div>
//                   </div>
//               </a>
//           </div>
//       </div>



//       <div class='col-lg-3 col-md-6'>
//           <div>
//               <div style='background-color:red;' class='panel-heading'>
//                   <div class='row'>
//                       <div class='col-xs-3'>
//                           <i class='fa fa-support fa-5x'></i>
//                       </div>
//                       <div class='col-xs-9 text-right'>
//                           <div class='huge'></div>
//                           <div>Level 3</div>
//                       </div>
//                   </div>
//               </div>
//               <a href='cancellation_overview_2015.php?resellerId='>".
//         "<div class='panel-footer'>
//                       <span class='pull-left'>$tier3</span>
//                       <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
//                       <div class='clearfix'></div>
//                   </div>
//               </a>
//           </div>
//       </div>
//   </div>";
// mysqli_close($conn);

?>
</div>

<div class="container">
 <div style="overflow: auto;">
    <table id="table1" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>SP Id</th>
          <th>SP Name</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Extensions</th>
          <th>Customers</th>
        </tr>
      </thead>
    <tbody>

<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME) or die("I HATE your face!");

$sql='CALL getServiceProviders();';

$sql1='SELECT *
         FROM tmp_sp
        WHERE v_companyName NOT LIKE "%demo%"
          AND v_companyName NOT LIKE "%test%"
          AND v_companyName NOT LIKE "%Test%"
          AND v_companyName NOT LIKE "%demo%"
          AND v_extCount !=0';

if ( $result=mysqli_query($conn,$sql1) ) {

  while ( $row=mysqli_fetch_assoc($result) ) {

    $resellerId = $row['v_resellerId'];
    $companyName = $row['v_companyName'];
    $phoneNum = $row['v_phoneNum'];
    $address = $row['v_address'];
    $extCount = $row['v_extCount'];
    $customerCount = $row['v_customerCount'];

        echo "<tr>".
             "<td>"."<a href='sp_overview.php?v_resellerId=".$resellerId."'>".$resellerId."</a>"."</td>".
             "<td>".$companyName."</td>".
             "<td>".$phoneNum."</td>".
             "<td>".$address."</td>".
             "<td>".$extCount."</td>".
             "<td>".$customerCount."</td>".
             "</tr>";
  }
} else {
   echo "There was an error or something";
}
  
?>
    </tbody>
  </table>

</div>
<!-- overflow div -->
</div>
<hr>



<br><br><br><br><br><br><br><br>



<!-- This is an "advanced" search filter for the service providers, this seems to have deprecated itself due to no usage -->
<!-- <div class="container">

      <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".upper-navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

        <a class="navbar-brand" href="all_service_provider.php">Filter By:</a>

        <form class="navbar-form pull-left" role="search" method="get" id="searchform" action="all_service_provider_search.php">
        <div class="input-group">
          <div class="input-group-btn">
                  <p class="btn">
                    <select  id="selector" name="customField">
                      <option value=""></option>
                      <option value="spId">SP Id</option>
                      <option value="spName">SP Name</option>
                      <option value="tier">Tier</option>
                      <option value="phone">Phone</option>
                      <option value="address">Address</option>
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
            <li id="menu-item-2"><a href="resellers_index.php">Back</a></li>
          </ul>
      </div>
  </div> --> <!-- search container end -->


</div> <!-- MAIN CONTAINER END -->
</body>
</html>



