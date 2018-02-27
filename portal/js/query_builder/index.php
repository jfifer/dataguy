<!DOCTYPE HTML> 


<html> 
  <head> 
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
    <meta name="gwt:property" content="locale=en_US" />

    <title>Report Builder</title> 
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/4-col-portfolio.css" rel="stylesheet">
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="RedQueryBuilder/RedQueryBuilder.nocache.js" type="text/javascript">//</script>
    
    <link rel="stylesheet" href="RedQueryBuilder/gwt/dark/dark.css" type="text/css" />
    
    <script src="RedQueryBuilder/RedQueryBuilderFactory.nocache.js" type="text/javascript">//</script>
    <script src="simple.js" type="text/javascript">//</script>
    <script src="visitor.js" type="text/javascript">//</script>
    
    </head> 
  <body bgcolor="white">

    <!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

<div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../../index.php">CoreDial, LLC. Data Intelligence</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">                
                    <li>
                        <a href="dashconcept/dashboard0/admin-LIVE/index.php">Dash Concept</a>
                    </li>
                    <li>
                        <a href="request_data.php">Request Data</a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#myModal">Recent App Changes</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
 <!-- Split button -->
<div class="btn-group">
  <button type="button" class="btn btn-primary"><a href="reports/reports_index.php" style="color:#FFF;">Reports</a></button>
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
     <li class="disabled"><a disabled href="#"><strong>Choose A Category</strong></a></li>
    <li><a href="#"></a></li>
    <li><a href="reports/resellers/resellers_index.php">Service Provider</a></li>
    <li><a href="reports/customers/customers_index.php">Customer</a></li>
    <li><a href="reports/users/users_index.php">User</a></li>
    <li><a href="reports/sales/sales_index.php">Sales</a></li>
    <li><a href="reports/marketing/marketing_index.php">Marketing</a></li>
    <li><a href="reports/support/support_index.php">Support</a></li>
    <li><a href="reports/extensions/extensions_index.php">Extensions</a></li>
    <li><a href="reports/infrastructure/infra_index.php">Infrastructure</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="request_data.php">Request A Report...</a></li> 
    <li><a href="js/query_builder/index.php">Report Builder</a></li> 

  </ul>
</div>

<div class="btn-group">
  <button type="button" class="btn btn-warning"><a href="dashboards/dashboards_index.php" style="color:#FFF;">Dashboards</a></button>
  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
     <li class="disabled"><a disabled href="#"><strong>Choose A Category</strong></a></li>
    <li><a href="dashboards/"></a></li>
    <li><a href="dashboards/resellers/resellers_index.php">Service Provider</a></li>
    <li><a href="dashboards/customers/customers_index.php">Customer</a></li>
    <li><a href="dashboards/users/users_index.php">User</a></li>
    <li><a href="dashboards/sales/sales_index.php">Sales</a></li>
    <li><a href="dashboards/marketing/marketing_index.php">Marketing</a></li>
    <li><a href="dashboards/support/support_index.php">Support</a></li>
    <li><a href="dashboards/extensions/extensions_index.php">Extensions</a></li>
    <li><a href="dashboards/infrastructure/infrastructure_index.php">Infrastructure</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="request_data.php">Request A Dashboard...</a></li>
  </ul>
</div>

<br><br>

</div>
<!-- /.container -->
</nav> <!-- END NAV -->
<br><br><br>

<div class="container">
    <h3>Build Your Query</h3><br>

    <noscript> 
      <div style="width: 22em; position: absolute; left: 50%; margin-left: -11em; color: red; background-color:white; border: 1px solid red; padding: 4px; font-family: sans-serif"> 
        Your web browser must have JavaScript enabled
        in order for this application to display correctly.
      </div> 
    </noscript>


    <div id="rqb"> </div><br>

    <div><textarea id="debug" cols="80" rows="10">Output...</textarea></div>
    <a href="index.php"><small>Start Over<small></a>


    
    <!-- <div id="rqbVisitor"> </div> -->
</div> <!-- END CONTAINER -->    
  </body> 
</html> 