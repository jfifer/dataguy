<?php require_once("../../php/dbconn.php"); ?>


<?php
if(isset($_GET["filter"]) ) 
{
  $filter = $_GET["filter"];
}

if(isset($_GET["customField"]) ) {
  $customField = $_GET["customField"];
}

switch ($customField) {
    case 'spId':
        //echo "spCompanyName";
        $where = "WHERE v_resellerId = ".$filter;
        //echo $and;
        break; 
    case 'spName':
        //echo "customerName";
        $where = "WHERE v_companyName LIKE "."'%".$filter."%';";
        //echo $and;
        break;
    case 'tier':
        //echo "pbxContext";
        $where = "WHERE v_tier LIKE "."'%".$filter."%';";
        //echo $and;
        break;
    case 'phone':
        //echo "extNum";
        $where = "WHERE v_phone LIKE "."'%".$filter."%';";
        //echo $and;
        break;
    case 'address':
        //echo "";
        $where = "WHERE v_address LIKE "."'%".$filter."%';";
        //echo $and;
        break;
     case 'all':
        //echo "all";
        $where = "WHERE 1 = 1;";
}


$sql='SELECT * FROM tmp_sp '.$where;

// $sql='SELECT r.resellerId Reseller_ID,
//        r.companyName Company_Name,
//        r.tier Tier,
//        r.phone Phone,
//        CONCAT(a.street1," ",a.street2," ",a.city," ",a.state," ",a.zipCode," ",a.country) AS "Address"
//   FROM reseller r
//   JOIN address a ON (r.addressId=a.addressId)'.$where ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Service Providers</title>
  <meta charset="utf-8">
  
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../../../testStuff/dataTables_ASC_DESC/css.css">
  <link rel="stylesheet" type="text/css" href="../../css/custom_style.css">
  <script type="text/javascript" src="../../js/jquery.js"></script>
  <script type="text/javascript" src="../../js/bootstrap.js"></script>
  <script type="text/javascript" src="../../js/custom_js/main.js"></script>
  <script type="text/javascript" src="../../../testStuff/dataTables_ASC_DESC/jquery-1.11.js"></script>
  <script type="text/javascript" src="../../../testStuff/dataTables_ASC_DESC/dataTable.js"></script>


<script type="text/javascript">
//   $(document).ready(function() {
//     $("#searchdropdown li a").click(function(){
      
//     $("#searchcategory").html($(this).text() + ' <span class="caret"></span>');
//         $("#searchcategory").val($(this).text());
//   });
// });
</script>

</head>

<body>

<?php include('../../php/ReportsNav.php'); ?>


<div class="container">

<?php

//$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
//$count="SELECT COUNT(*) FROM reseller r"." ".$where;

$count="SELECT COUNT(*) FROM tmp_sp"." ".$where;

if ($result=mysqli_query($conn,$count) ) {
  
  $row_cnt = mysqli_fetch_array($result);
  $row_cnt = $row_cnt[0];
}
?>
<br><br><br><br><br><br>
<h2>Service Providers <small><?php echo date('l jS \of F Y h:i:s A'); ?></small></h2>
  <p>*CoreDial Service Providers</p><small>Row Count: <?php echo $row_cnt; ?></small>      
  
<div style="overflow: auto;">
  <table id="table1" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
     <th>SP Id</th>
        <th>SP Name</th>
        <th>Tier</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Extensions</th>
        <th>Customers</th>
      </tr>
    </thead>
<tbody>

<?php

if ( $result=mysqli_query($conn,$sql) ) {

  while ($row=mysqli_fetch_array($result)) {

        //TODO: Clean / Trim / Set
    $resellerId = $row['v_resellerId'];
    $companyName = $row['v_companyName'];
    $tier = $row['v_tier'];
    $phoneNum = $row['v_phoneNum'];
    $address = $row['v_address'];
    $extCount = $row['v_extCount'];
    $customerCount = $row['v_customerCount'];
    

      echo "<tr>".
           "<td>".
             "<a href='sp_overview.php?v_resellerId=".$resellerId."' >".$resellerId."</a>".
           "</td>".
           "<td>".$companyName."</td>".
           "<td>".$tier."</td>".
           "<td>".$phoneNum."</td>".
           "<td>".$address."</td>".
           "<td>".$extCount."</td>".
           "<td>".$customerCount."</td>"."     
         </tr>";
      
  }
}


mysqli_close($conn);    
?>  
  </tbody>
  </table>

</div> <!-- overflow div -->

<hr>
 <!-- Begin Navbar -->
  <div class="container">
      <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".upper-navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
      
          <a class="navbar-brand" href="standardExtensions.php">Filter By:</a>
      
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
    </div><!-- /.navbar-header -->
      <div class="collapse navbar-collapse upper-navbar">      
          <ul id="menu-topmenu" class="nav navbar-nav navbar-right">
            <li id="menu-item-1"><a href="../../index.php">Home</a></li>
            <li id="menu-item-2"><a href="resellers_index.php">Back</a></li>
          </ul>   
      </div><!-- /.navbar-collapse -->
  </div>

</div> <!-- CONTAINER END -->

</body>


</html>
