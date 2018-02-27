<?php
	$availableCompayNames = array('companyOne', 'companyTwo', 'companyThree');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Service Providers</title>
  <meta charset="utf-8">
  
  <!-- Bootstrap Core CSS -->
  <link href="../../css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="../../../testStuff/dataTables_ASC_DESC/css.css">

  
  <script type="text/javascript" src="../../js/jquery.js"></script>
  <script type="text/javascript" src="../../js/bootstrap.js"></script>

  <script type="text/javascript" src="../../../testStuff/dataTables_ASC_DESC/jquery-1.11.js"></script>
  <script type="text/javascript" src="../../../testStuff/dataTables_ASC_DESC/dataTable.js"></script>

</head>


<body>
	<br />
	Select a company name that will be chosen dynamically:
	<?php foreach ($availableCompayNames as $key => $companyName){
		echo '<a href="#" onClick="alert(this.innerHTML + \' selected!\');">'.$companyName.'</a>';
	}
	?>
	<br />
	Select a company name that will be passed to any other page you want via ajax:
	<?php foreach ($availableCompayNames as $key => $companyName){
		echo '<a href="#" onClick="doStuff(this.innerHTML)">'.$companyName.'</a>';
	}
	?>

<script type="text/javascript">
function doStuff(companyNameClicked){
$.ajax({
	type: "POST",
	url: 'sp_getStuff.php',
	data: {companyName: companyNameClicked},
	dataType: "json",
	success: alert('good to go'),
	error: errorFunc
});
function successFunc(data) {
   alert("SUCCESS");
};
function errorFunc(hxrObject) {
	console.log("FAIL");
	var err = eval("(" + hxrObject.responseText + ")"); 
	console.log(err.Message);
};
}
</script>

</body>
</html>