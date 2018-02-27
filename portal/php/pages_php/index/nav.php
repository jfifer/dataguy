<?php

echo '
<div class="col-xs-12 col-sm-6 col-lg-8">
<img class="logo" src="img/site_logo2.png" height="95px;" width="475px;">
</div>
<br><br><br><br><br><br>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"></a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li><a class="active" href="home.php">Home</a></li>
        <li><a class="navvy" href="reports/reports_index.php">Reports</a></li>
        <li><a class="navvy" href="dashboards/dashboards_index.php">Dashboards</a></li>
        <li><a class="navvy" href="php/pages_php/partner_success/psa_login.php">Partner Success</a></li>
        <li><a class="navvy" href="request_data.php">Request Data</a></li>
        <li><a class="navvy" data-toggle="modal" data-target="#myModal">Recent Changes</a></li>
        <li><a class="navvy" href="index.php">Logout</a></li>
      </ul>
    </div>'.

  '</div>'.
   '<small class="todayDate">Todays Date: '.date("l jS \of F Y").'</small>'.
'</nav>';
?>