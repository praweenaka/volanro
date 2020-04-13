<?php
include './CheckCookie.php';
$cookie_name = "user";
if (isset($_COOKIE[$cookie_name])) {

    $mo = chk_cookie($_COOKIE[$cookie_name]);

    if ($mo == "ok") {
        header('Location: ' . "home.php");
        exit();
    }
}
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login Page</title>
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
         <link  href="css/login.css" rel="stylesheet">   
        <link rel="stylesheet" href="css/ionicons/css/ionicons.min.css">
        <script src="js/user.js"></script>




    </head>
    <body background="uploads/ddd.jpg">
         
        <div class="container" >  
            <div class="container" >
                <div  class="form-signin form-group mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                   
                    <div>
                        <!--<img style="align-content: center" class="img-responsive" src="img/Mas_Holdings_Logo.png">-->
                        <div class="form-group">
                            <h1 style="color: red"><center>VOLANRO</center></h1>
                        </div>
                    </div> 
                    <div class="form-group"></div>

                    <strong>Username:</strong>

                    <input class="form-control"  name="UserName"  type="text" id="txtUserName" onkeypress="keyset('txtPassword', event)"  />



                    <strong>Password:</strong>

                    <input class="form-control" name="Password" type="password" id="txtPassword" onkeypress="keyset('lbtn', event)"/>
                    <div id="txterror" class="login_error">

                    </div> 
                    <button class="btn btn-primary" id="lbtn"  name="lbtn" onclick="IsValiedData();">Sign in</button>

                </div>
            </div>

        </div>
    </body>    
</html>     


<script>
    var elem = document.getElementById("txtPassword");
    elem.onkeyup = function (e) {
        if (e.keyCode == 13) {
            IsValiedData();
        }
    }


</script>


<script src="js/jquery-2.1.0.js"></script>
<script src="js/bootstrap.min.js"></script>