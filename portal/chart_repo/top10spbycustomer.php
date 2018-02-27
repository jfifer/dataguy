<?php require_once("../php/charts_php/graph0.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Data Portal</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/4-col-portfolio.css" rel="stylesheet">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="../../chartdisplay/js/highcharts.js"></script>
    <script type="text/javascript" src="../../chartdisplay/js/modules/exporting.js"></script>
    <script type="text/javascript" src="../js/custom_js/graph.js"></script>  

    <script type="text/javascript">
      var data = <?php echo $stuff; ?>
    </script>


</head>



<div class="container">
<header>
<h3>Top Ten Service Providers <small> By Customer</small></h3>
</header>
                 
<body>


   <!-- Projects Row -->
        <div class="row">
            <div class="col-md-12 portfolio-item">
                <a href="#">
                    <!-- <img class="img-responsive" src="http://placehold.it/750x450" alt=""> -->
                    <div id="graph0" style="min-width: 250px; max-width: 100%; height: 450px; margin: 0 auto"></div>

                </a>
            </div>
        </div>
        <!-- /.row -->

        </body>

<a href="../index.php"><button type="button" class="btn btn-primary"><a href="../index.php" style="color:#FFF;">Back</a></button></a>
</div>



</html>