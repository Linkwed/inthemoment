<?php 
    require("common.php"); 
    if(empty($_SESSION['user'])) { 
        header("Location: ../index.php"); 
        die("Redirecting to ../index.php"); 
    }

    $status = ($_SESSION['user']['status']);
    if($status == '1'){
       header("Location: private.php");
    }
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Linky - Activation</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--       <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css"> -->
        <link rel="stylesheet" href="../css/main.css">
        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body> 
<div class="container_display">
   
   <h1 style="text-align:center; padding:20px; margin-bottom:20px;">Your account still need to ba validate by an admin, sorry. </br> Come back later.</h1>

   <a href="../index.php"><p class="cancel">Back</p></a>   
</div>




<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/main.js"></script>
    </body>
</html>