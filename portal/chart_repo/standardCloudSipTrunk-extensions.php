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
    <script type="text/javascript" src="../js/custom_js/extensions_3xLine.js"></script>  

    <script type="text/javascript">
      var data = <?php echo $stuff; ?>
    </script>


</head>



<div class="container">
<header>
<h3>Standard, Cloud Extensions & Sip Trunks<small> By Customer 2015</small></h3>
</header>
                 
<body>


   <!-- Projects Row -->
        <div class="row">
            <div class="col-md-12 portfolio-item">
                <a href="#" data-toggle="tooltip" title="Click On Me!">
                  
                   <!-- <img class="img-responsive" src="http://placehold.it/750x450" alt=""> -->
                   <div id="extensions" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </a>
            </div>
        </div>
        <!-- /.row -->

        </body>

<a href="#"><button type="button" class="btn btn-primary"><a href="../dashboards/infrastructure/infra_1.php" style="color:#FFF;">Back</a></button></a>
</div>



</html>