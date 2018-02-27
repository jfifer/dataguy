<?php require_once("../../php/dbconn.php"); ?>
<?php require_once('../../php/pages_php/index/session.php'); ?>

<?php
if(isset($_GET["filter"]) ) 
{
  $filter = $_GET["filter"];
}

if(isset($_GET["customField"]) ) {
  $customField = $_GET["customField"];
}

switch ($customField) {
    case 'spCompanyName':
        //echo "spCompanyName";
        $and = "AND r.companyName LIKE "."'%".$filter."%';";
        //echo $and;
        break;
    case 'customerName':
        //echo "customerName";
        $and = "AND c.companyName LIKE "."'%".$filter."%';";
        //echo $and;
        break;
    case 'pbxContext':
        //echo "pbxContext";
        $and = "AND b.description LIKE "."'%".$filter."%';";
        //echo $and;
        break;
    case 'sipDesc':
        //echo "extNum";
        $and = "AND s.description LIKE "."'%".$filter."%';";
        //echo $and;
        break;
   case 'all':
        //echo "all";
        $and = " AND 1;";
}

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
 ".$and ;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>SipTrunks</title>
  <meta charset="utf-8">

 <link rel="stylesheet" type="text/css" href="../../../testStuff/dataTables_ASC_DESC/css.css">

  
  <!-- Bootstrap Core CSS -->
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
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

body { /* Body offset for fixed navbar */
  padding-top: 70px; 
}
 
.navbar .navbar-form { /* Positioning the form */
    padding-top: 0;
    padding-bottom: 0;
    margin-right: 0;
    margin-left: 0;
    border: 0;
    -webkit-box-shadow: none;
    box-shadow: none;
}
 
#searchcategory { /* Dropdown within searchbar */
  width: 100px;
  color: #333;
  background-color: #e6e6e6;
  border-color: #adadad;
}
 
@media(max-width:767px) {
    body { /* Body offset for fixed navbar for mobile devices */
    padding-top: 140px; 
  }
  
  .navbar .navbar-form {
        width: 100% /* Full width search box for mobile devices */
    }
}
 
 
/* Media queries to adjust form width */
@media(min-width:768px) {
    .navbar-form .input-group>.form-control {
    width: 200px; 
  }
}
 
@media(min-width:992px) {
  .navbar-form .input-group>.form-control {
    width: 270px; 
  }
}
 
@media(min-width:1200px) {
  .navbar-form .input-group>.form-control {
    width: 370px; 
  }
}

</style>

</head>

<body>

<div class="container">

 <!-- Begin Navbar -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
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
    </div><!-- /.navbar-header -->
      <div class="collapse navbar-collapse upper-navbar">      
          <ul id="menu-topmenu" class="nav navbar-nav navbar-right">
            <li id="menu-item-1"><a href="../../index.php">Home</a></li>
            <li id="menu-item-2"><a href="extensions_index.php">Back</a></li>
          </ul>   
      </div><!-- /.navbar-collapse -->
  </div>
</nav>
<!-- /.navbar -->
<?php

$count="SELECT COUNT(*)
  FROM sipTrunk s
  LEFT JOIN branch b ON (s.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (c.resellerId=r.resellerId)
 WHERE c.statusId=1
 ".$and ;

if ( $result=mysqli_query($conn,$count) ) {

  $row_cnt = mysqli_fetch_array($result);
  $row_cnt = $row_cnt[0];
}
?>

  <h2>SipTrunks <small><?php echo date('l jS \of F Y h:i:s A'); ?></small></h2>
  <p>*A full list of active sipTrunks</p><small>Row Count: <?php echo $row_cnt; ?></small>             
  <div style="overflow: auto;">
  <table class="table">
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


mysqli_close($conn);    
?>
  </tbody>
  </table>

</div> <!-- overflow div -->

</div> <!-- CONTAINER END -->

</body>


</html>
