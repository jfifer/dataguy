<?php
  require_once("../../php/dbconn.php");
  $name = $_GET['name'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Suppliers</title>
    <meta charset="utf-8">

    <link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
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
                <li><a class="active" href="../reports_index.php">Reports</a></li>
                <li><a class="navvy" href="../../dashboards/dashboards_index.php">Dashboards</a></li>
                <li><a class="navvy" href="../../request_data.php">Request Data</a></li>
                <li ><a id="back"  href="suppliers_index.php">BACK</a></li>
                <li><a href="../../index.php"></a>Logout</li>


            </ul>
        </div>
    </div>
</nav>


<div class="container">


    <?php

    $count="SELECT DISTINCT(COUNT(s.name))
              FROM supplier s
             WHERE s.name NOT LIKE '%test%'";

    if ( $result=mysqli_query($conn,$count) ) {

        $row_cnt = mysqli_fetch_array($result);
        $row_cnt = $row_cnt[0];
    }
    ?>

    <h2>Suppliers Overview <small><?php echo date('l jS \of F Y h:i:s A'); ?></small></h2>
    <p>*Coredial Suppliers</p><small>Distinct Supplier Count: <?php echo $row_cnt; ?></small>
    <Br><Br>

<div class="row" style="overflow: auto;">
<?php
        $conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

        $getPBXCount='SELECT DISTINCT(COUNT(b.description))
                        FROM supplier s
                        JOIN reseller r ON (s.resellerId = r.resellerId)
                        JOIN customer c ON (r.resellerId = c.resellerId)
                        JOIN branch b ON (c.customerId = b.customerId)
                       WHERE c.statusId NOT IN (2,3)
                         AND b.isProvisioned
                         AND s.name NOT LIKE "%test%"
                         AND s.name ='.'"'.$name.'"';

        if ( $result=mysqli_query($conn,$getPBXCount) ) {

            $getPBXCount=mysqli_fetch_array($result);

              $PBXCount = $getPBXCount[0];

        }

       $conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

       $getCustomerCount='SELECT COUNT(c.customerId)
                    FROM supplier s
                    JOIN reseller r ON (s.resellerId = r.resellerId)
                    JOIN customer c ON (r.resellerId = c.resellerId)
                    JOIN branch b ON (c.customerId = b.customerId)
                    JOIN did d ON (b.branchId = d.branchId)
                   WHERE c.statusId NOT IN (2,3)
                     AND b.isProvisioned
                     AND d.isActive
                     AND s.name NOT LIKE "%test%"
                     AND s.name NOT LIKE "%Poycom%"
                     AND c.companyName NOT LIKE "%test%"
                     AND s.name ='.'"'.$name.'"';

         if ( $result=mysqli_query($conn,$getCustomerCount) ) {

           $count=mysqli_fetch_array($result);

           $CustomerCount = $count[0];

       }




        echo "

 <div class='row'>
      <div class='col-lg-3 col-md-6'>
          <div class='panel panel-primary'>
              <div class='panel-heading'>
                  <div class='row'>
                      <div class='col-xs-3'>
                          <i class='fa fa-comments fa-5x'></i>
                      </div>
                      <div class='col-xs-9 text-right'>
                          <div class='huge'>".$PBXCount."</div>
                          <div>Distinct PBX Count</div>
                      </div>
                  </div>
              </div>";

       echo "<a href='distinct_pbx.php?name=$name'>".
            "<div class='panel-footer'>".
            "<span class='pull-left'>View Details</span>".
            "<span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>".
            "<div class='clearfix'></div>".
            "</div>".
            "</a>".

            "</div>
      </div>
      <div class='col-lg-3 col-md-6'>
          <div class='panel panel-primary'>
              <div class='panel-heading'>
                  <div class='row'>
                      <div class='col-xs-3'>
                          <i class='fa fa-tasks fa-5x'></i>
                      </div>
                      <div class='col-xs-9 text-right'>
                          <div class='huge'>".$CustomerCount."</div>".
            "<div>Customer Count</div>
                      </div>
                  </div>
              </div>
              <a href='#'>".
            "<div class='panel-footer'>
                      <span class='pull-left'>View Details</span>
                      <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                      <div class='clearfix'></div>
                  </div>
              </a>
          </div>
      </div>


      <div class='col-lg-3 col-md-6'>
          <div class='panel panel-primary'>
              <div class='panel-heading'>
                  <div class='row'>
                      <div class='col-xs-3'>
                          <i class='fa fa-shopping-cart fa-5x'></i>
                      </div>
                      <div class='col-xs-9 text-right'>
                          <div class='huge'></div>
                          <div>Metric</div>
                      </div>
                  </div>
              </div>
              <a href='#'>".
            "<div class='panel-footer'>
                      <span class='pull-left'>View Details</span>
                      <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                      <div class='clearfix'></div>
                  </div>
              </a>
          </div>
      </div>



      <div class='col-lg-3 col-md-6'>
          <div class='panel panel-primary'>
              <div class='panel-heading'>
                  <div class='row'>
                      <div class='col-xs-3'>
                          <i class='fa fa-support fa-5x'></i>
                      </div>
                      <div class='col-xs-9 text-right'>
                          <div class='huge'></div>
                          <div>Metric</div>
                      </div>
                  </div>
              </div>
              <a href='#'>".
            "<div class='panel-footer'>
                      <span class='pull-left'>View Details</span>
                      <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                      <div class='clearfix'></div>
                  </div>
              </a>
          </div>
      </div>
  </div>";

?>

</div>  <!-- END METRICS ROW -->

    <br><br>
    <div style="overflow: auto;">
        <table id="table1" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Supplier</th>
                <th>SP Id</th>
                <th>SP</th>
                <th>Customer Id</th>
                <th>Company</th>
                <th>PBX Context</th>

            </tr>
            </thead>
            <tbody>

            <?php
            $conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

            $sql1='SELECT s.name,
                          r.resellerId,
                          r.companyName,
                          c.customerId,
                          c.companyName,
                          b.description

                     FROM supplier s
                     JOIN reseller r ON (s.resellerId = r.resellerId)
                     JOIN customer c ON (r.resellerId = c.resellerId)
                     JOIN branch b ON (c.customerId = b.customerId)
                     -- JOIN did d ON (b.branchId = d.branchId)
                    WHERE c.statusId NOT IN (2,3)
                      AND b.isProvisioned
                      -- AND d.isActive
                      AND s.name NOT LIKE "%test%"
                      AND c.companyName NOT LIKE "%test%"
                      AND s.name ='.'"'.$name.'"';


            if ( $result=mysqli_query($conn,$sql1) ) {

                while ( $row=mysqli_fetch_assoc($result) ) {

                    $name = $row['name'];
                    $resellerId = $row['resellerId'];
                    $reseller = $row['companyName'];
                    $customerId = $row['customerId'];
                    $companyName = $row['companyName'];
                    $PBXContext = $row['description'];
                 //   $didNumber = $row['didNumber'];

                    echo "<tr>".
                        "<td>".$name."</td>".
                        "<td>".
                        "<a href='sp_overview.php?v_resellerId=".$resellerId."'>".$resellerId."</a>".
                        "</td>".
                        "<td>".$reseller."</td>".
                        "<td>".
                        "<a href='../../spdrillin_action.php?v_customerId=".$customerId."'>".$customerId."</a>".
                        "</td>".
                        "<td>".$companyName."</td>".
                        "<td>".$PBXContext."</td>"."

         </tr>";
                }
            }
            mysqli_close($conn);
            ?>
            </tbody>
        </table>
    </div> <!-- overflow div -->

    <hr>

</div> <!-- CONTAINER END -->
</body>
</html>



