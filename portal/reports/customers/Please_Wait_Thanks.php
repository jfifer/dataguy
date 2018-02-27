<?php $activated = session_start(); ?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Loading...</title>
<link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
<!-- Bootstrap Core CSS -->
<link href="../../css/bootstrap.min.css" rel="stylesheet">

<style type="text/css">

body {
    font-family: 'Play', sans-serif;
  }

.spinner {
	margin-top: 25%;
	margin-left: 30%;

}
#spinner {
	margin-left: 23%;
}
</style>

</head>

<body>
  <div class='container'>
    <div class='row'>
      <div class='spinner'>
        <h3>Please Wait...We're Crunching Your Data!</h3><Br>
        <img id='spinner' height='50px' src="../../img/ajax-loader.gif">
      </div>
    </div>
<div>
</body>

<?php

// if (isset($activated)) {
// 	$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
//     $sql='call getCustomerList()';
// 	mysqli_query($conn,$sql);
//     header('Location: all_customer.php');
// }

header( "refresh:1;url=all_customer.php" );
// header('Location: all_customer.php');

?>