<?php require_once("../../php/dbconn.php"); ?>
<?php require_once('../../php/pages_php/index/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>SipTrunk</title>
  <meta charset="utf-8">

  <link rel="stylesheet" type="text/css" href="../../../testStuff/dataTables_ASC_DESC/css.css">
  <link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>    <!-- Color... -->



  <!-- Bootstrap Core CSS -->
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <!-- <script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.1.min.js" > </script>  MIGHT NOT NEED THIS, FOR EXPORT TOOL -->
  <script type="text/javascript" src="http://www.kunalbabre.com/projects/table2CSV.js" > </script>

  <script type="text/javascript" src="../../js/jquery.js"></script>
  <script type="text/javascript" src="../../js/bootstrap.js"></script>

  <script type="text/javascript" src="../../../testStuff/dataTables_ASC_DESC/jquery-1.11.js"></script>
  <script type="text/javascript" src="../../../testStuff/dataTables_ASC_DESC/dataTable.js"></script>

  <script>

    $(document).ready(function() {
        $('#table1').DataTable( {
            "order": [[ 3, "desc" ]]
        } );
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

     body {
       font-family: 'Play', sans-serif;
     }

     #bigButt {
      height: 195px !important;
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
        <li ><a id="back"  href="extensions_index.php">BACK</a></li>
        <li><a href="../../index.php">Logout</a></li>


      </ul>
    </div>
  </div>
</nav>

<div class="container">


<?php

$count="SELECT COUNT(*)
  FROM sipTrunk s
  LEFT JOIN branch b ON (s.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (c.resellerId=r.resellerId)
 WHERE c.statusId=1
   AND c.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%test%'
   AND b.description NOT LIKE '%test%'
   AND b.description NOT LIKE '%fake%'
   AND s.description NOT LIKE '%test%'";

if ( $result=mysqli_query($conn,$count) ) {

  $row_cnt = mysqli_fetch_array($result);
  $row_cnt = $row_cnt[0];
}
?>

  <h2>SipTrunks <small><?php echo date('l jS \of F Y h:i:s A'); ?></small></h2>
  <p>*A full list of active sipTrunks</p><small>Row Count: <?php echo $row_cnt; ?></small>
  <input style="float:right; padding:5px; margin: 5px;" value="Export" type="button" onlclick="$('#table1').table2CSV()">
  <div style="overflow: auto;">
  <table id="table1" class="display" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>SP Id</th>
        <th>SP Name</th>
        <th>Customer</th>
        <th>PBX Context</th>
        <th>Sip Trunk Desc</th>
      </tr>
    </thead>
    <tbody>


<?php

$sql="SELECT
      r.resellerId Reseller_ID,
      r.companyName Company_Name,
      c.companyName Customer_Name,
      b.description PBX_Context,
      s.description SIP_Trunk_Desc
  FROM sipTrunk s
  LEFT JOIN branch b ON (s.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (c.resellerId=r.resellerId)
 WHERE c.statusId=1
   AND c.companyName NOT LIKE '%test%'
   AND r.companyName NOT LIKE '%test%'
   AND b.description NOT LIKE '%test%'
   AND b.description NOT LIKE '%fake%'
   AND s.description NOT LIKE '%test%';";

if ( $result=mysqli_query($conn,$sql) ) {

  while ($row=mysqli_fetch_array($result)) {

  echo "<tr>".
        "<td>".$row['Reseller_ID']."</td>".
        "<td>".$row['Company_Name']."</td>".
        "<td>".$row['Customer_Name']."</td>".
        "<td>".$row['PBX_Context']."</td>".
        "<td>".$row['SIP_Trunk_Desc']."</td>"."
      </tr>";

  }
}



?>
  </tbody>
  </table>

</div> <!-- overflow div -->

</div> <!-- CONTAINER END -->



</body>


</html>



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

          <a class="navbar-brand" href="standardExtensions.php">Filter By:</a>

        <form class="navbar-form pull-left" role="search" method="get" id="searchform" action="sipTrunks_search.php">
        <div class="input-group">
          <div class="input-group-btn">
                  <p class="btn">
                    <select  id="selector" name="customField">
                      <option value=""></option>
                      <option value="spCompanyName">SP Name</option>
                      <option value="customerName">Customer Name</option>
                      <option value="pbxContext">PBX Context</option>
                      <option value="sipDesc">Sip Trunk Desc</option>
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
            <li id="menu-item-2"><a href="extensions_index.php">Back</a></li>
          </ul>
      </div>
  </div> -->
</nav>
<!-- /.navbar -->
