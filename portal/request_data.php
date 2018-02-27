<?php
require_once('php/pages_php/index/session.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Request Data Form</title>
    
    <link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>    <!-- Color... -->
    
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <!-- <link href="css/4-col-portfolio.css" rel="stylesheet"> -->

    <!-- // <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> -->

    <style type="text/css">
  
      /* Adjust feedback icon position */
      #movieForm .form-control-feedback {
          right: 15px;
      }
      #movieForm .selectContainer .form-control-feedback {
          right: 25px;
      }

      #inform {
        margin-left: 45%;
      }
    </style>

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

  </style>

</head>


<body>


<div class="col-xs-12 col-sm-6 col-lg-8">
<img class="logo" src="img/site_logo2.png" height="95px;" width="475px;">
</div>
<br><br><br><br><br><br>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"></a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li><a class="navvy" href="index.php">Home</a></li>
        <li><a class="navvy" href="reports/reports_index.php">Reports</a></li>
        <li><a class="navvy" href="dashboards/dashboards_index.php">Dashboards</a></li>
        <li><a class="active" href="request_data.php">Request Data</a></li>
      </ul>
    </div>
  </div>
</nav> 


<div class="container">
 
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Data Request Form 
                    <small><?php echo date('l jS \of F Y h:i:s A'); ?></small>
                </h1>
            </div>
        </div>


<form id="movieForm" method="post" action="php/smtp/gmail.php">
    <div class="form-group">
        <div class="row">
            <div class="col-xs-8">
                <label class="control-label">Full Name</label>
                <input id="full_name" type="text" class="form-control" name="full_name" />
            </div>

            <div class="col-xs-4 selectContainer">
                <label class="control-label">Categories</label>
                <select id="selector" class="form-control" name="choose_cat">
                    <option value="">Choose a category</option>
                    <option value="reseller">Reseller</option>
                    <option value="customer">Customer</option>
                    <option value="user">User</option>
                    <option value="sales">Sales</option>
                    <option value="marketing">Marketing</option>
                    <option value="support">Support</option>
                    <option value="extensions">Extensions</option>
                    <option value="infrastructure">Infrastructure</option>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-xs-6 selectContainer">
                <label class="control-label">Type:</label>
                <select id="selector" class="form-control" name="choose_type">
                    <option value="">Choose a type</option>
                    <option value="report">Report</option>
                    <option value="dashboard">Dashboard</option>
                    <option value="rawData">Raw Form (.csv, .txt, etc.)</option>
                </select>
            </div>

             <div class="col-xs-6">
                <label class="control-label">Requested Date By: </label><small id="inform" >  i.e. "2015-10-04 or 10-04-2015"</small>
                <input id="requested_date" type="text" class="form-control" name="request_date" />
            </div>


        </div>
    </div>


    <div class="form-group">
        <label class="control-label">Please provide a detailed summary of your request:</label>
        <textarea class="form-control" name="request_summary" rows="8">*Side Note: If you are requesting a dashboard, please ensure to include what types of charts, graphs or pies you would like to see for each data aggregate...</textarea>
    </div>

    <div class="form-group">
        <label class="control-label">Request Priority</label>
        <div>
            <label class="radio-inline">
                <input type="radio" group="request_priority" name="priority" value="high" /> High
            </label>
            <label class="radio-inline">
                <input type="radio" group="request_priority" name="priority" value="moderate" /> Moderate
            </label>
            <label class="radio-inline">
                <input type="radio" group="request_priority" name="priority" value="low" /> Low
            </label>            
        </div>
    </div>

    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form><br>
<a href="request_data.php"><button class="btn btn-info">Clear Form</button></a>




<script>
$(document).ready(function() {
    $('#movieForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            title: {
                row: '.col-xs-8',
                validators: {
                    notEmpty: {
                        message: 'The title is required'
                    },
                    stringLength: {
                        max: 200,
                        message: 'The title must be less than 200 characters long'
                    }
                }
            },
            genre: {
                row: '.col-xs-4',
                validators: {
                    notEmpty: {
                        message: 'The genre is required'
                    }
                }
            },
            director: {
                row: '.col-xs-4',
                validators: {
                    notEmpty: {
                        message: 'The director name is required'
                    },
                    stringLength: {
                        max: 80,
                        message: 'The director name must be less than 80 characters long'
                    }
                }
            },
            writer: {
                row: '.col-xs-4',
                validators: {
                    notEmpty: {
                        message: 'The writer name is required'
                    },
                    stringLength: {
                        max: 80,
                        message: 'The writer name must be less than 80 characters long'
                    }
                }
            },
            producer: {
                row: '.col-xs-4',
                validators: {
                    notEmpty: {
                        message: 'The producer name is required'
                    },
                    stringLength: {
                        max: 80,
                        message: 'The producer name must be less than 80 characters long'
                    }
                }
            },
            website: {
                row: '.col-xs-6',
                validators: {
                    notEmpty: {
                        message: 'The website address is required'
                    },
                    uri: {
                        message: 'The website address is not valid'
                    }
                }
            },
            trailer: {
                row: '.col-xs-6',
                validators: {
                    notEmpty: {
                        message: 'The trailer link is required'
                    },
                    uri: {
                        message: 'The trailer link is not valid'
                    }
                }
            },
            review: {
                // The group will be set as default (.form-group)
                validators: {
                    stringLength: {
                        max: 500,
                        message: 'The review must be less than 500 characters long'
                    }
                }
            },
            rating: {
                // The group will be set as default (.form-group)
                validators: {
                    notEmpty: {
                        message: 'The rating is required'
                    }
                }
            }
        }
    });
});
</script>

</div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
