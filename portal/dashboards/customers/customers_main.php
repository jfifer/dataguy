<?php require_once('../../php/pages_php/index/session.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Customers</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../css/4-col-portfolio.css" rel="stylesheet">

    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

    <script>
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
      });
    </script>



</head>


 <!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <div class="row">

            <div class="col-lg-12">
              <a href="../../index.php"><button class="btn-xs btn-primary"><h4>GO HOME</h4></button></a><a href="customers_index.php"><button class="btn-xs btn-primary" style="margin-left: 15px;"><h4>GO BACK</h4></button></a><br><br>

                <h1 class="page-header">Customers
                    <small><?php echo date('l jS \of F Y h:i:s A'); ?></small>
                </h1>

            </div>


        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
            <div class="col-md-12 portfolio-item">
                <a href="#" data-toggle="tooltip" title="Click On Me!">
                  <label>Services<small> Company Wide</small></label>
                  <?php include('../../customer_prod_services.php'); ?>

                </a>
            </div>

        <!--     <div class="col-md-6 portfolio-item">
                <a href="chart_repo/upTime.php" data-toggle="tooltip" title="Click On Me!">
                    <label>Something...will go here.<small></small></label>



                    </div>


                </a>
            </div> -->
           

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
