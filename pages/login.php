<?php
include("connection.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $username = mysqli_real_escape_string($connection,$_POST['username']);
      $password = mysqli_real_escape_string($connection,$_POST['password']); 
      
      $sql = "SELECT * FROM ccpo_users WHERE username = '$username' and password = '$password'";
      $result = mysqli_query($connection,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $username and $password, table row must be 1 row
        
      if($count == 1) {
         session_register("username");
         $_SESSION['login_user'] = $username;
         
         header("location: daily.html");
      }else {
         $error = "Your Login Name or Password is invalid";
         echo "error";
      }
   }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CCPO Crime Prediction - Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/primary.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="background">
  <div class="page-wrap">
    <div class="col-md-offset-3" style="padding-top: 100px">
      <img src="images/bg-map.png" alt="bg" style="position: absolute">
    </div>
    <div class="row vertical-offset-100" style="position: relative">
      <div class="col-md-4 col-md-offset-4">
        <div class="row-fluid user-row">
          <img align="middle" src="images/logo.png" class="img-responsive" alt="Conxole Admin"/>
        </div>
        <div class="panel panel-default">                               
          <div class="panel-body">
            <form accept-charset="UTF-8" role="form" class="form-signin" method="post" action="">
              <fieldset>
                <label for="login-username" class="sr-only"></label>
                <input class="form-control col-md-6" placeholder="Username" type="text" name="username">
                <label for="login-password" class="sr-only"></label>
                <input class="form-control col-md-6" placeholder="Password" type="password" name="password">
                <br></br>
                <input class="btn btn-primary btn-block" type="submit" value="Submit" name="submit">
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
