<?php // Start the session
  //session_start();

  // Set session variables
  //$_SESSION["user"] = "admin";
  // testin only

  //dbconn
  //require_once("../../php/dbconn.php");

//Get SessionId
    session_start();

    if (empty($_SESSION['count'])) {
      $_SESSION['count'] = 1;
    } else {
      $_SESSION['count']++;
    }
?>




<!DOCTYPE html>
<html>
<head>
<title>PSA Dash</title>

<link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
<link href="../../../css/bootstrap.min.css" rel="stylesheet">
<link href="../../../css/pages_css/index.css" rel="stylesheet">


<style type="text/css">

 body {
    font-family: 'Play', sans-serif;
  }

 .panel-default > .panel-heading {
  background-color: #0076a3;
}


 .panel-footer {
  background-color: #0076a3;
}

.exp {
	color: #FFFFFF;
}

</style>

</head>

<body>
<!-- Nav -->
<div class="col-xs-12 col-sm-6 col-lg-8">
<img class="logo" src="../../../img/site_logo2.png" height="95px;" width="475px;">
</div>
<br><br><br><br><br><br>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"></a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li><a class="active" href="../../../index.php">Home</a></li>
        <li><a class="navvy" href="../../../reports/reports_index.php">Reports</a></li>
        <li><a class="navvy" href="../../../dashboards/dashboards_index.php">Dashboards</a></li>
        <li><a class="navvy" href="psa_index.php">Partner Success</a></li>
        <li><a class="navvy" href="../../../request_data.php">Request Data</a></li>

      </ul>
    </div>
  <?php echo
  '</div>
   <small class="todayDate">Todays Date: '.date("l jS \of F Y").'</small>
</nav>';
 ?>

<div class="container">

<p>
Session started, visit count:<?php echo $_SESSION['count']; ?>
</p>

<!-- <p>
To continue, <a href="psa_login.php?<?php echo htmlspecialchars(SID); ?>">click
here</a>.
</p> -->



  <h2>Service Provider Metrics</h2>
    <div class="panel-group">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <span class="glyphicon glyphicon-signal" aria-hidden="true"></span>
            <a data-toggle="collapse" href="#collapse1"><small class='exp'> Expand</small></a>
          </h4>
        </div>
      <div id="collapse1" class="panel-collapse collapse">
        <div class="panel-body">Data</div>
        <div class="panel-footer"></div>
      </div>
    </div>
  </div>

  <h2>SalesForce</h2>
    <div class="panel-group">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <span class="glyphicon glyphicon-cloud" aria-hidden="true"></span>
            <a data-toggle="collapse" href="#collapse2"><small class='exp'> Expand</small></a>
          </h4>
        </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">Data</div>
        <div class="panel-footer"></div>
      </div>
    </div>
  </div>

    <h2>Misc.</h2>
    <div class="panel-group">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
            <a data-toggle="collapse" href="#collapse3"><small class='exp'> Expand</small></a>
          </h4>
        </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body">Data</div>
        <div class="panel-footer"></div>
      </div>
    </div>
  </div>



</div>
<!-- END CONTAINER -->
  <script src="../../../js/jquery.js"></script>
  <script src="../../../js/bootstrap.min.js"></script>
</body>
</html>