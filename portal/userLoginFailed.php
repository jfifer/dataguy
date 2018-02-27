<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CoreDial, LLC. Data Intel</title>
<link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
<link href="js/bowerComponents/sb-admin-2.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="amChartsLib/AMcharts/amcharts/amcharts.js" type="text/javascript"></script>
<script src="amChartsLib/AMcharts/amcharts/serial.js" type="text/javascript"></script>
<link href="css/pages_css/index.css" rel="stylesheet">

</head>
<body>
    <div class="container">
      <div class="row">
        <img class="logo" src="img/site_logo2.png" height="95px;" width="475px;">
      </div>

        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <label style="color:red;">The credentials you passed are incorrect.</label>
                        <div class="panel-title">Sign In</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Request Admin Pin</a></div>
                    </div>

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                        <form id="loginform" class="form-horizontal" role="form" action="userLoginCheck.php" method="post">

                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="user" value="" placeholder="username or email">
                                    </div>

                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="pwd" placeholder="password">
                                    </div>



                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                    <!--   <a id="btn-login" href="#" class="btn btn-success">Login  </a> -->
                                    <input type="submit" name="" value="Log In">


                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Don't have an account?
                                        <!-- <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            Set it up here.
                                        </a> -->

                                        <a href="userNewAccount.php">
                                            Set it up here.
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </form>



                        </div>
                    </div>
        </div>






    </div>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>