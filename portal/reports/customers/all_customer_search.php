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
   case 'cId':
        //echo "customerName";
        $and = "AND customerId = ".$filter;
        //echo $and;
        break;
    case 'cName':
        //echo "pbxContext";
        $and = "AND companyName LIKE "."'%".$filter."%';";
        //echo $and;
        break;
    case 'actDate':
        //echo "extNum";
        $and = "AND originalActivationDate LIKE "."'%".$filter."%';";
        //echo $and;
        break;
    case 'resellername':
        //echo "";
        $and = "AND r.companyName = ".$filter;
        //echo $and;
        break;
     case 'all':
        //echo "all";
        $and = "AND 1 = 1;";
}

$sql='SELECT c.customerId,
             c.companyName,
             c.originalActivationDate,
             r.companyName "reseller"
        FROM customer c
        JOIN reseller r USING (resellerId) 
       WHERE c.statusId NOT IN (2,3) '.$and ;
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Customers</title>
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

<script type="text/javascript">
$(document).ready(function() {
  
  $("#searchdropdown li a").click(function(){
    console.log("click init success");
    $("#searchcategory").html($(this).text() + ' <span class="caret"></span>');
        $("#searchcategory").val($(this).text());
  });
});
</script>

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
      
      <form class="navbar-form pull-left" role="search" method="get" id="searchform" action="all_customer_search.php">
        <div class="input-group">
          <div class="input-group-btn">
                   <p class="btn">
                    <select  id="selector" name="customField">
             <option value=""></option>
                      <option value="cId">Customer ID</option>
                      <option value="cName">Customer Name</option>
                      <option value="actDate">Activaiton Date</option>
                      <option value="resellerId">Reseller ID</option>
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
            <li id="menu-item-2"><a href="customers_index.php">Back</a></li>
          </ul>   
      </div><!-- /.navbar-collapse -->
  </div>
</nav>
<!-- /.navbar -->
<?php

//$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

$count="SELECT COUNT(*) FROM customer WHERE statusId NOT IN (2,3)".$and;

if ($result=mysqli_query($conn,$count) ) {
  
  $row_cnt = mysqli_fetch_array($result);
  $row_cnt = $row_cnt[0];
}
?>

  <h2>Customers <small><?php echo date('l jS \of F Y h:i:s A'); ?></small></h2>
  <p>*CoreDial Active Customers</p><small>Row Count: <?php echo $row_cnt; ?></small>      
  <div style="overflow: auto;">
  <table id="table1" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
       <th>Customer ID</th>
       <th>Customer Name</th>
       <th>Activation Date</th>
       <th>Reseller</th>
      </tr>
    </thead>
    <tbody>

<?php

if ( $result=mysqli_query($conn,$sql) ) {

  while ($row=mysqli_fetch_array($result)) {
  

   
  echo "<tr>".
        "<td>".$row['customerId']."</td>".
        "<td>".$row['companyName']."</td>".
        "<td>".$row['originalActivationDate']."</td>".
        "<td>".$row['reseller']."</td>"."
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
