<?php require_once("../../php/dbconn.php"); ?>
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
        <li><a id="back"  href="../reports_index.php">BACK</a></li>
        <li><a class="navvy" href="../../index.php">Logout</a></li>
     </ul>
    </div>
  </div>
</nav>

<div class="container">
    <h2>Importer <small><?php echo date('l jS \of F Y h:i:s A'); ?></small></h2><br>

<?php
  $conn = new mysqli("$HOST","$DBUSER","$DBROOT","$DBNAME");
  // dbanme is not being passed??? wtf... TODO: figure that out.
  $clean_up_sql="call clean_up_import()";
  mysql_query($clean_up_sql) or die(mysql_error());
?>



<div class="row">
<?php
error_reporting(0);

$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$results = 'import_display.php';

if (isset($_POST['submit'])) {
    $conn   = new mysqli($HOST,"root", "root","bi_new");
    $handle = fopen($_FILES['filename']['tmp_name'], "r");
    $head   = fgetcsv($handle, 4096, ',', '"');

    // echo $head[1]." ".$head[2]." ".$head[3].
    //      " ".$head[4]." ".$head[5]." ".$head[6].
    //      " ".$head[7]." ".$head[8]." ".$head[9].
    //      " ".$head[10]." ".$head[11]." ".$head[12].
    //      " ".$head[13]."<br>";

    $insert_header = "INSERT INTO portal.import_test_header
                      VALUES ('$head[0]','$head[1]','$head[2]','$head[3]','$head[4]',
                           '$head[5]','$head[6]','$head[7]','$head[8]','$head[9]',
                           '$head[10]','$head[11]','$head[12]','$head[13]')";

    mysql_query($insert_header) or die(mysql_error());

     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {


       // echo $data[0]." ".$data[1]." ".$data[2]." ".$data[3]." ".$data[4]." ".$data[5]." ".$data[6]." ".$data[7]." ".$data[8]." ".$data[9]." ".$data[10]." ".$data[11]." ".$data[12]."<br>";
        $import="INSERT INTO portal.import_test
                   VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]',
                           '$data[5]','$data[6]','$data[7]','$data[8]','$data[9]',
                           '$data[10]','$data[11]','$data[12]','$data[13]')";

        mysql_query($import) or die(mysql_error());

    }

    fclose($handle);
    header("Location: http://$host$uri/$results");
    mysql_close($conn);
}

else {

   echo "<center>";
    echo "<div class='col-md-3'>";

    # echo "<h3>Choose your file.</h3><br />\n";
    echo "<form enctype='multipart/form-data' action='importer.php' method='post'>";
    echo '<input type="file" class="filestyle" name="filename" data-iconName="glyphicon-inbox" required><p>&nbsp;&nbsp;</p><p></p>';
    echo "<input class='btn btn-primary'  type='submit' name='submit' value='import'><p></p></form>";
}
   echo "</div>";
   echo "</center>";
?>
</div>
</body>
</html>
