<!DOCTYPE html>
<!-- Code Snippet for login http://bootsnipp.com/snippets/featured/login-form-layered -->
<html>
<head>
<title>PSA Login</title>

<link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
<link href="../../../css/bootstrap.min.css" rel="stylesheet">


<style type="text/css">

body{background: #eee url(http://subtlepatterns.com/patterns/sativa.png);}
html,body{
    position: relative;
    height: 100%;
    /* I added this ... */
    font-family: 'Play', sans-serif;

}

.login-container{
    position: relative;
    width: 300px;
    margin: 80px auto;
    padding: 20px 40px 40px;
    text-align: center;
    background: #fff;
    border: 1px solid #ccc;
}

#output{
    position: absolute;
    width: 300px;
    top: -75px;
    left: 0;
    color: #fff;
}

#output.alert-success{
    background: rgb(25, 204, 25);
}

#output.alert-danger{
    background: rgb(228, 105, 105);
}


.login-container::before,.login-container::after{
    content: "";
    position: absolute;
    width: 100%;height: 100%;
    top: 3.5px;left: 0;
    background: #fff;
    z-index: -1;
    -webkit-transform: rotateZ(4deg);
    -moz-transform: rotateZ(4deg);
    -ms-transform: rotateZ(4deg);
    border: 1px solid #ccc;

}

.login-container::after{
    top: 5px;
    z-index: -2;
    -webkit-transform: rotateZ(-2deg);
     -moz-transform: rotateZ(-2deg);
      -ms-transform: rotateZ(-2deg);

}

.avatar{
    width: 100px;height: 25px;
    margin: 10px auto 30px;
    border-radius: 100%;
    /*border: 2px solid #aaa;*/
    background-size: cover;
}

.form-box input{
    width: 100%;
    padding: 10px;
    text-align: center;
    height:40px;
    border: 1px solid #ccc;;
    background: #fafafa;
    transition:0.2s ease-in-out;

}

.form-box input:focus{
    outline: 0;
    background: #eee;
}

.form-box input[type="text"]{
    border-radius: 5px 5px 0 0;
    text-transform: lowercase;
}

.form-box input[type="password"]{
    border-radius: 0 0 5px 5px;
    border-top: 0;
}

.form-box button.login{
    margin-top:15px;
    padding: 10px 20px;
}

.animated {
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
}

@-webkit-keyframes fadeInUp {
  0% {
    opacity: 0;
    -webkit-transform: translateY(20px);
    transform: translateY(20px);
  }

  100% {
    opacity: 1;
    -webkit-transform: translateY(0);
    transform: translateY(0);
  }
}

@keyframes fadeInUp {
  0% {
    opacity: 0;
    -webkit-transform: translateY(20px);
    -ms-transform: translateY(20px);
    transform: translateY(20px);
  }

  100% {
    opacity: 1;
    -webkit-transform: translateY(0);
    -ms-transform: translateY(0);
    transform: translateY(0);
  }
}

.fadeInUp {
  -webkit-animation-name: fadeInUp;
  animation-name: fadeInUp;
}

/* My Custom Stylin */

a {
  text-decoration: none;
}

.yourFace {
	border-radius: 80px;
	height: 100px;
}

.logo {
  margin-top: 5%;
  margin-left: 30%;
  margin-right: 25%;
}

</style>
</head>


<body>

<div class="container">
  <img class="logo" src="../../../img/site_logo2.png" height="95px;" width="475px;">
	<div class="login-container">
    <!-- <h4>Welcome Back!</h4> -->
            <div id="output"></div>
              <div class="avatar">
                <!-- <img class="yourFace" src="../../../img/MM_avatar.jpg"> -->
              </div>
            <div class="form-box">
                <form action="psa_check_user.php" method="POST">
                    <input name="user" type="text" placeholder="username">
                    <input name="pwd" type="password" placeholder="password">
                    <button class="btn btn-info btn-block login" type="submit">Login</button>

                </form><br />
                <a href="../../../index.php">BI Home</a>
            </div>
        </div>

</div>

  <script src="../../../js/jquery.js"></script>
  <script src="../../../js/bootstrap.min.js"></script>

  <script>
  // $(function(){
  //   var textfield = $("input[name=user]");
  //           $('button[type="submit"]').click(function(e) {
  //               e.preventDefault();
  //               //little validation just to check username
  //               if (textfield.val() != "") {

  //                   $("body").scrollTo("#output");

  //                   $("#output").addClass("alert alert-success animated fadeInUp").html("Welcome back " + "<span style='text-transform:uppercase'>" + textfield.val() + "</span>");
  //                   $("#output").removeClass(' alert-danger');
  //                   $("input").css({
  //                   "height":"0",
  //                   "padding":"0",
  //                   "margin":"0",
  //                   "opacity":"0"
  //                   });

  //                   //change button text
  //                   $('button[type="submit"]').html("My Dashboard")
  //                   // window.location='psa_index.php'

  //                   .removeClass("btn-info")

  //                   .addClass("btn-default").click(function(){
  //                   $("input").css({
  //                   "height":"auto",
  //                   "padding":"10px",
  //                   "opacity":"1"
  //                   }).val("test");
  //                   });

  //                   //show avatar
  //                   $(".avatar").css({
  //                       "background-image": "url('https://media.licdn.com/media/p/3/000/1f6/10c/3d1f28c.jpg')"
  //                   });
  //               } else {
  //                   //remove success mesage replaced with error message
  //                   $("#output").removeClass(' alert alert-success');
  //                   $("#output").addClass("alert alert-danger animated fadeInUp").html("sorry enter a username ");
  //               }
  //               //console.log(textfield.val());

  //           });
  // });

  </script

</body>
</html>