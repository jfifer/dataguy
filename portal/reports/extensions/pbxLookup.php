<?php require_once("../../php/dbconn.php"); ?>
<?php require_once('../../php/pages_php/index/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Context Lookup</title>
  <meta charset="utf-8">

  <link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>    <!-- Color... -->
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../../../testStuff/dataTables_ASC_DESC/css.css">
  <link rel="stylesheet" type="text/css" href="../../css/custom_style.css">

  <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">


  <script type="text/javascript" src="../../js/jquery.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script type="text/javascript">
        $(document).ready(function($){
            $('#ResellerSearch').autocomplete({source:'getResellersSearch.php', minLength:0});

        });
    </script>


    <script type="text/javascript" src="../../js/bootstrap.js"></script>




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
      height: 325px !important;
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
        <li><a class="active" href="../../reports/reports_index.php">Reports</a></li>
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

  $count=" SELECT COUNT(*)
  FROM extension e
  LEFT JOIN branch b ON (e.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
 WHERE c.statusId=1;";

  if ( $result=mysqli_query($conn,$count) ) {

    $row_cnt = mysqli_fetch_array($result);
    $row_cnt = $row_cnt[0];
  }
?>

<h2>Context Lookup <small><?php echo date('l jS \of F Y h:i:s A'); ?></small></h2>
  <p>*Extensions</p><small>Total Extensions: <?php echo $row_cnt; ?></small>


<div class="row"><br><br>
  <div class="col-md-8 portfolio-item" style="margin-left: 25%;">

    <div id="bigButt" class="col-md-8 btn btn-primary">
      <form action="pbx_LookupSearch.php" method="post" ><h2>Enter Service Provider:</h2>
          <h4>ID</h4>
        <input style="color:black;" type="number" name="resellerId" min="1">
          <h2>OR</h2>
          <h4>Name</h4>
        <input style="color:black;" type="text" name="companyName" id="ResellerSearch">
          <br><br>
        <input style="color:black;" type="submit">
      </form>
    </div>

  </div>
</div>

</div> <!-- CONTAINER END -->
</body>
</html>



