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
    case 'uId':
        //echo "spCompanyName";
        $and = "AND userId = ".$filter;
        //echo $and;
        break;
    case 'fName':
        //echo "spCompanyName";
        $and = "AND firstname LIKE "."'%".$filter."%';";
        //echo $and;
        break;
    case 'lName':
        //echo "spCompanyName";
        $and = "AND lastname LIKE "."'%".$filter."%';";
        //echo $and;
        break;
    case 'username':
        //echo "pbxContext";
        $and = "AND username LIKE "."'%".$filter."%';";
        //echo $and;
        break;
    case 'customerId':
        //echo "extNum";
        $and = "AND customerId = ".$filter;
        //echo $and;
        break;
    case 'branchId':
        //echo "";
        $and = "AND branchId = ".$filter;
        //echo $and;
        break;
     case 'all':
        //echo "all";
        $and = "AND 1 = 1;";
}

$sql=$sql='SELECT userId,
             firstname,
             lastname,
             username,
             customerId,
             branchId
        FROM user
       WHERE enabled '.$and ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Users</title>
  <meta charset="utf-8">
  
  <!-- Bootstrap Core CSS -->
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="../../js/jquery.js"></script>
  <script type="text/javascript" src="../../js/bootstrap.js"></script>



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
    </div><!-- /.navbar-header -->
      <div class="collapse navbar-collapse upper-navbar">      
          <ul id="menu-topmenu" class="nav navbar-nav navbar-right">
            <li id="menu-item-1"><a href="../../index.php">Home</a></li>
            <li id="menu-item-2"><a href="users_index.php">Back</a></li>
          </ul>   
      </div><!-- /.navbar-collapse -->
  </div>
</nav>
<!-- /.navbar -->
<?php

//$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

$count="SELECT COUNT(*) FROM user WHERE enabled ".$and;

if ($result=mysqli_query($conn,$count) ) {
  
  $row_cnt = mysqli_fetch_array($result);
  $row_cnt = $row_cnt[0];
}
?>

  <h2>Users <small><?php echo date('l jS \of F Y h:i:s A'); ?></small></h2>
  <p>*CoreDial Portal Users</p><small>Row Count: <?php echo $row_cnt; ?></small>      
  <div style="overflow: auto;">
  <table class="table">
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


<?php

if ( $result=mysqli_query($conn,$sql) ) {

  while ($row=mysqli_fetch_array($result)) {
  
   echo "<tbody><tr>".
        "<td>".$row['userId']."</td>".
        "<td>".$row['firstname']."</td>".
        "<td>".$row['lastname']."</td>".
        "<td>".$row['username']."</td>".
        "<td>".$row['customerId']."</td>".
        "<td>".$row['branchId']."</td>"."      
      </tr>
      </tbody>";
      
  }
}


mysqli_close($conn);    
?>  
  </table>

</div> <!-- overflow div -->

</div> <!-- CONTAINER END -->

</body>


</html>
