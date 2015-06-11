<?php ob_start(); ?>
<?php 
    require("common.php"); 
    if(empty($_SESSION['user'])) { 
        header("Location: ../index.php"); 
        die("Redirecting to ../index.php"); 
    }

    $status = ($_SESSION['user']['status']);
    if($status == '0'){
       header("Location: activation.php");
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
        <title>Linky - Private</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--       <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css"> -->
        <link rel="stylesheet" href="../css/main.css">
        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body> 
<div class="container_display">
    <div class="private_menu">
    <h1>Hello <?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?></h1>
    <?php  
    $admin = ($_SESSION['user']['username']);
    if($admin == 'admin'){
        echo "<a href='memberlist.php'><p class='menu'>Memberlist</p></a><br /> ";
    }
    ?>
    <a href="edit_account.php"><p class="menu">Edit Account</p></a><br /> 
    <a href="logout.php"><p class="cancel">Logout</p></a>
    </div>
    <div class="display_main" id="style-4"> 
      <?php include("files.php");?> 
    </div>
    <div class="display" id="style-4"> 
        <?php include("result.php");?> 
    </div>
    <div class="form_layout">
    <div class="chat">
            <?php include("chat.php"); ?>
        </div>
        <div class="upload_files">
            <?php include("upload_files.php"); ?>
        </div>
        
    </div>
        
</div>




<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/main.js"></script>
    </body>
</html>