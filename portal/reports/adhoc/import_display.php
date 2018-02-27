<?php require_once("../../php/dbconn.php"); 
    require_once('../../php/pages_php/index/session.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Importer</title>
  <meta charset="utf-8">

  <link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="../../css/custom_style.css">
  <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.bootstrap.min.css">
  <!-- jquery -->
  <script type="text/javascript" src="../../js/jquery.js"></script>

  <script type="text/javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.bootstrap.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
  <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.2/js/buttons.colVis.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      var table = $('#table1').DataTable( {
        lengthChange: true,
        iDisplayLength: 100,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
      } );

      table.buttons().container()
        .appendTo( '#table1_wrapper .col-sm-6:eq(0)' );
    } );
  </script>


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
        <li><a id="back"  href="importer.php">BACK</a></li>
        <li><a class="navvy" href="../../index.php">Logout</a></li>
     </ul>
    </div>
  </div>
</nav>





<div class="container">
    <h2>Import Results <small><?php echo date('l jS \of F Y h:i:s A'); ?></small></h2><br>

      <div class="row">
        <?php
        $conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

        $sql="SELECT * FROM import_test_header";

        if ( $result=mysqli_query($conn,$sql) ) {

          while ( $headers=mysqli_fetch_assoc($result) ) {

           $h1 = $headers['f1'];
           $h2 = $headers['f2'];
           $h3 = $headers['f3'];
           $h4 = $headers['f4'];
           $h5 = $headers['f5'];
           $h6 = $headers['f6'];
           $h7 = $headers['f7'];
           $h8 = $headers['f8'];
           $h9 = $headers['f9'];
           $h10 = $headers['f10'];
           $h11 = $headers['f11'];
           $h12 = $headers['f12'];
           $h13 = $headers['f13'];

         echo
         '<div style="overflow: auto;"">
            <table id="table1" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Metric</th>'.
                  '<th>'.$h1.'</th>'.
                  '<th>'.$h2.'</th>'.
                  '<th>'.$h3.'</th>'.
                  '<th>'.$h4.'</th>'.
                  '<th>'.$h5.'</th>'.
                  '<th>'.$h6.'</th>'.
                  '<th>'.$h7.'</th>'.
                  '<th>'.$h8.'</th>'.
                  '<th>'.$h9.'</th>'.
                  '<th>'.$h10.'</th>'.
                  '<th>'.$h11.'</th>'.
                  '<th>'.$h12.'</th>'.
                  '<th>'.$h13.'</th>'.
                '</tr>
              </thead>
            <tbody>';
          }
        }
        ?>
        <?php
        $conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

        $sql1="SELECT * FROM import_test";

        if ( $result=mysqli_query($conn,$sql1) ) {

          while ( $row=mysqli_fetch_assoc($result) ) {

            $title = $row['metric_title'];
            $f1 = $row['f1'];
            $f2 = $row['f2'];
            $f3 = $row['f3'];
            $f4 = $row['f4'];
            $f5 = $row['f5'];
            $f6 = $row['f6'];
            $f7 = $row['f7'];
            $f8 = $row['f8'];
            $f9 = $row['f9'];
            $f10 = $row['f10'];
            $f11 = $row['f11'];
            $f12 = $row['f12'];
            $f13 = $row['f13'];
// import_graph.php
                echo "<tr>".
                     "<td>"."<a href='import_graph.php?".$title."'>".$title."</a>"."</td>".
                     "<td>".$f1."</td>".
                     "<td>".$f2."</td>".
                     "<td>".$f3."</td>".
                     "<td>".$f4."</td>".
                     "<td>".$f5."</td>".
                     "<td>".$f6."</td>".
                     "<td>".$f7."</td>".
                     "<td>".$f8."</td>".
                     "<td>".$f9."</td>".
                     "<td>".$f10."</td>".
                     "<td>".$f11."</td>".
                     "<td>".$f12."</td>".
                     "<td>".$f13."</td>".
                     "</tr>";

          }
        }

        ?>
            </tbody>
          </table>

        </div>
        <!-- overflow div -->
     </div>

</div> <!-- MAIN CONTAINER END -->

</body>
</html>
