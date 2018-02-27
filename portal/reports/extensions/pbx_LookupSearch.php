<?php
  require_once('../../php/pages_php/index/session.php');
  require_once("../../php/dbconn.php");

  $v_resellerId = $_POST['resellerId'];
  $v_companyName = $_POST['companyName'];

  $testSet = (empty(!$v_resellerId));
  $testSet1 = (empty(!$v_companyName));

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Context Lookup</title>
  <meta charset="utf-8">

  <link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>    <!-- Color... -->
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../../../testStuff/dataTables_ASC_DESC/css.css">
  <link rel="stylesheet" type="text/css" href="../../css/custom_style.css">
  <script type="text/javascript" src="../../js/jquery.js"></script>
  <script type="text/javascript" src="../../js/bootstrap.js"></script>
  <script type="text/javascript" src="../../js/custom_js/main.js"></script>
  <script type="text/javascript" src="../../../testStuff/dataTables_ASC_DESC/jquery-1.11.js"></script>
  <script type="text/javascript" src="../../../testStuff/dataTables_ASC_DESC/dataTable.js"></script>

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

     #container {
      margin-left: 5%;
      margin-right: 5%;
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
        <li ><a id="back"  href="pbxLookup.php">BACK</a></li>
      </ul>
    </div>
  </div>
</nav>

<div id="container">

<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

if ($testSet) {

    $count="SELECT COUNT(*)
            FROM extension e
            LEFT JOIN branch b ON (e.branchId=b.branchId)
            LEFT JOIN customer c ON (b.customerId=c.customerId)
            LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
           WHERE c.statusId NOT IN (2,3)
             AND r.resellerId =".$v_resellerId;
} else {

    $count="SELECT COUNT(*)
            FROM extension e
            LEFT JOIN branch b ON (e.branchId=b.branchId)
            LEFT JOIN customer c ON (b.customerId=c.customerId)
            LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
           WHERE c.statusId NOT IN (2,3)
             AND r.companyName ="."'".$v_companyName."'";
}

if ( $result=mysqli_query($conn,$count) ) {

    $row_cnt = mysqli_fetch_array($result);
    $row_cnt = $row_cnt[0];
}

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$sql1='call getTop5CustomersSpDrillIn('.$v_resellerId.');';

if ( $result=mysqli_query($conn,$sql1) ) {

    sleep(.1);
  }

mysqli_close($conn);
?>

<h2>Context Lookup <small><?php echo date('l jS \of F Y h:i:s A'); ?></small></h2>
  <p>*Extensions</p><small>Row Count: <?php echo $row_cnt; ?></small>
  <div style="overflow: auto;">
    <table id="table1" class="display" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>SP Id</th>
          <th>SP Name</th>
          <th>Customer Name</th>
          <th>Customer Id</th>
          <th>PBX Context</th>
          <th>Is Provisioned</th>
          <th>Extension Number</th>
          <th>Extension Name</th>
          <th>Extension Type</th>
          <th>Is Free Ext</th>
        </tr>
      </thead>
    <tbody>
<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

if ($testSet) {
    $sql1 = 'SELECT r.resellerId,
                   r.companyName as reseller,
                   c.customerId,
                   c.companyName as customer,
                   b.branchId,
                   b.description as pbx,
                   b.isProvisioned,
                   e.extensionId,
                   e.extensionNumber as ext,
                   e.callerId as extensionName,
                   e.extensionTypeId,
                   e.isFreeExtension
              FROM reseller r
              JOIN branch b on b.resellerId=r.resellerId
              JOIN customer c on c.customerId=b.customerId
              JOIN extension e on e.branchId=b.branchId
              WHERE r.resellerId=' . $v_resellerId;
 /*   $sql1 = 'SELECT Reseller_ID,
                      Reseller_Name,
                      Customer_Name,
                      Customer_Id,
                      PBX_context,
                      Is_Provisioned,
                      Extension_Number,
                      Extension_Name,
                      Extension_Type,
                      Is_Free_Extension
                 FROM pbx_lookup
                WHERE Reseller_ID =' . $v_resellerId;  */
} else {
    $sql1 = 'SELECT r.resellerId,
                   r.companyName as reseller,
                   c.customerId,
                   c.companyName as customer,
                   b.branchId,
                   b.description as pbx,
                   b.isProvisioned,
                   e.extensionId,
                   e.extensionNumber as ext,
                   e.callerId as extensionName,
                   e.extensionTypeId,
                   e.isFreeExtension
              FROM reseller r
              JOIN branch b on b.resellerId=r.resellerId
              JOIN customer c on c.customerId=b.customerId
              JOIN extension e on e.branchId=b.branchId
              WHERE r.companyName="' . $v_companyName . '"';
/*
        $sql1 = 'SELECT Reseller_ID,
                      Reseller_Name,
                      Customer_Name,
                      Customer_Id,
                      PBX_context,
                      Is_Provisioned,
                      Extension_Number,
                      Extension_Name,
                      Extension_Type,
                      Is_Free_Extension
                 FROM pbx_lookup
                WHERE Reseller_Name ='.'"'.$v_companyName.'"'; */
}

if ( $result=mysqli_query($conn,$sql1) ) {

  while ( $row=mysqli_fetch_assoc($result) ) {

    $resellerId = $row['resellerId'];
    $resellerName = $row['reseller'];
    $customerName = $row['customer'];
    $customerId = $row['customerId'];
    $pbxContext = $row['pbx'];
    $isProvisioned = $row['isProvisioned'];
    $extensionNumber = $row['ext'];
    $extensionName = $row['extensionName'];
    $extensionType = $row['extensionTypeId'];
    $isFree = $row['isFreeExtension'];

      echo "<tr>".
             "<td>".
               "<a href='../resellers/sp_overview.php?v_resellerId=".$resellerId."'>".$resellerId."</a>".
             "</td>".
             "<td>".$resellerName."</td>".
             "<td>".$customerName."</td>".
             "<td>".
               "<a href='../../spdrillin_action.php?v_customerId=".$customerId."'>".$customerId."</a>".
             "</td>".
             "<td>".$pbxContext."</td>".
             "<td>".$isProvisioned."</td>".
             "<td>".$extensionNumber."</td>".
             "<td>".$extensionName."</td>".
             "<td>".$extensionType."</td>".
             "<td>".$isFree."</td>"."
           </tr>";
  }
}
mysqli_close($conn);
?>
      </tbody>
    </table>
  </div> <!-- overflow div -->
</div>   <!-- My Container To Fit All Fields -->

</body>
</html>



