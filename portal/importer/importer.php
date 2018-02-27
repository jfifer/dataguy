<?php require_once('../php/pages_php/index/session.php'); ?>
<!DOCTYPE html>

<html> 
<head>
<link rel="stylesheet" type="text/css" href="http://getbootstrap.com/dist/css/bootstrap.min.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"> </script>
<script type="text/javascript" src="bootstrap-filestyle.js"> </script>

<title>Importer</title>
</head>

<body>

<div>
<?php
error_reporting(0);
include "../php/dbconn.php";        

 
//Upload File

if (isset($_POST['submit'])) {
   
    $handle = fopen($_FILES['filename']['tmp_name'], "r");

     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

        $import="INSERT INTO portal.import_test values('$data[0]','$data[1]','$data[2]')";

        mysql_query($import) or die(mysql_error());
    }

    fclose($handle);

    echo "Import done"; 
    mysql_close($conn);
}

else {
      
   echo "<center>";
    echo "<div class='col-md-3'>";

    # echo "<h3>Choose your file.</h3><br />\n"; 
    echo "<form enctype='multipart/form-data' action='importer.php' method='post'>"; 
    echo "File name to import:<br /><br />\n";
    echo '<input type="file" class="filestyle" name="filename" data-iconName="glyphicon-inbox" required><p>&nbsp;&nbsp;</p><p></p>';
    echo "<input class='btn btn-primary'  type='submit' name='submit' value='import'><p></p></form>";
}
   echo "</div>";
   echo "</center>";
?>
</div>
</body>
</html>
