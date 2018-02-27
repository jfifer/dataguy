<?php 
require_once('php/pages_php/index/session.php');
require_once("php/dbconn.php"); ?>
<?php 
     session_start(); 
     $_SESSION["DBCONN"] = "PORTAL";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CoreDial, LLC. Data Intel</title>

    <!-- Color... -->
    <link href="js/bowerComponents/sb-admin-2.css" rel="stylesheet">
    <!-- ..Blocks -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/4-col-portfolio.css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="../testStuff/AMcharts/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="../testStuff/AMcharts/amcharts/serial.js" type="text/javascript"></script>
    

     <script>
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
      });
    </script>

    <style>

    .navbar {
      box-shadow: 8px 8px 5px #888888;
    }

    .panel {
      box-shadow: 8px 8px 5px #888888;
    }

    li  {
      background-color: #0076a3; 

    }

    a {
      color: #FFF;
    }

    .home {
       background-color: #e8e8e8; 
       color: #0076a3;
    }

    nav {
      background-color: #0076a3;
    }

    .navbar {
      background-color: #0076a3;
    }

    .container {
      top:0;
    }
  
    </style>





</head>
  <div class="container">
  <img class="logo" src="img/cdlogo.png" height="100px;" width="500px;">
  </div>



<body>

<nav class="navbar navbar-default">
<!-- <nav class="navbar navbar-fixed-top"> -->
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- <a class="navbar-brand" href="#">Brand</a> -->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <ul class="nav nav-tabs">
          <li role="presentation" class="home"><a href="#">Home</a></li>
          <li role="presentation"><a href="#">Profile</a></li>
          <li role="presentation"><a href="#">Messages</a></li>
        </ul>



        <!--   
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
         -->
      </ul>

      <!-- 
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
       -->

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>









    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>


</html>
