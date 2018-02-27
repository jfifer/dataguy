<?php require_once('../../php/pages_php/index/session.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Infrastructure</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../css/4-col-portfolio.css" rel="stylesheet">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="../../../chartdisplay/js/highcharts.js"></script>
    <script type="text/javascript" src="../../../chartdisplay/js/modules/exporting.js"></script>
    <script type="text/javascript" src="../../js/custom_js/extensions_3xLine.js"></script>
    <script type="text/javascript" src="../../js/custom_js/graph.js"></script>
   


    <script type="text/javascript">
      var data = <?php echo $stuff;?>;
    </script>

    <script>
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
      });
    </script>

    <style type="text/css">
    
/*    a:hover {
        background-color:green;
        color:white;
    }*/

    </style>

</head>


 <!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <div class="row">

            <div class="col-lg-12">
              <a href="../../index.php"><button class="btn-xs btn-primary"><h4>GO HOME</h4></button></a><a href="infrastructure_index.php"><button class="btn-xs btn-primary" style="margin-left: 15px;"><h4>GO BACK</h4></button></a><br><br>

                <h1 class="page-header">Infrastructure
                    <small><?php echo date('l jS \of F Y h:i:s A'); ?></small>
                </h1>

            </div>


        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
            <div class="col-md-6 portfolio-item">
                <a href="../../chart_repo/standardCloudSipTrunk-extensions.php" data-toggle="tooltip" title="Click On Me!">
                  <label>Standard, Cloud Extensions & Sip Trunks<small> By Customer</small></label>
                   <div id="extensions" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </a>
            </div>
            <div class="col-md-6 portfolio-item">
                <a href="chart_repo/upTime.php" data-toggle="tooltip" title="Click On Me!">
                    <label>Billed Revenue & Charges<small></small></label>
                    <div id="graph0" style="min-width: 310px; height: 400px; margin: 0 auto">

                    <img src="https://s-media-cache-ak0.pinimg.com/736x/f6/dc/1d/f6dc1dbc2d048ada731cfcbb477c9d43.jpg" alt="Smiley face" height="350" width="100%">


                    </div>


                </a>
            </div>
           

        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
            <div class="col-md-6 portfolio-item">
                <a href="chart_repo/" data-toggle="tooltip" title="Click On Me!">
                    <label>LNP "Something"<small>#'s Ported To Us Vs. Away???</small></label>
                    <div id="graph0" style="min-width: 310px; height: 400px; margin: 0 auto">

                                        <img src="https://s-media-cache-ak0.pinimg.com/736x/f6/dc/1d/f6dc1dbc2d048ada731cfcbb477c9d43.jpg" alt="Smiley face" height="350" width="100%">
</div>
                </a>
            </div>
            <div class="col-md-6 portfolio-item">
                <a href="chart_repo/" data-toggle="tooltip" title="Click On Me!">
                    <label>Number of Calls In & Out<small></small></label>
                    <div id="graph0" style="min-width: 310px; height: 400px; margin: 0 auto">

                                        <img src="https://s-media-cache-ak0.pinimg.com/736x/f6/dc/1d/f6dc1dbc2d048ada731cfcbb477c9d43.jpg" alt="Smiley face" height="350" width="100%">
</div>
                </a>
            </div>  
           

        </div>
        <!-- /.row -->

                <!-- Projects Row -->
        <div class="row">
            <div class="col-md-6 portfolio-item">
                <a href="chart_repo/" data-toggle="tooltip" title="Click On Me!">
                    <label>MOS Scores<small></small></label>
                    <div id="graph0" style="min-width: 310px; height: 400px; margin: 0 auto">

                                        <img src="https://s-media-cache-ak0.pinimg.com/736x/f6/dc/1d/f6dc1dbc2d048ada731cfcbb477c9d43.jpg" alt="Smiley face" height="350" width="100%">
</div>
                </a>
            </div>
            <div class="col-md-6 portfolio-item">
                <a href="chart_repo/" data-toggle="tooltip" title="Click On Me!">
                    <label>Top Ten Service Providers Support Tickets Overview<small></small></label>
                    <div id="graph0" style="min-width: 310px; height: 400px; margin: 0 auto">
                    <img src="https://s-media-cache-ak0.pinimg.com/736x/f6/dc/1d/f6dc1dbc2d048ada731cfcbb477c9d43.jpg" alt="Smiley face" height="350" width="100%">


                    </div>
                </a>
            </div>  
           

        </div>
        <!-- /.row -->


    </div>
    <!-- /.container -->

        <!-- jQuery -->
    <script src="../../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>


</body>

</html>
