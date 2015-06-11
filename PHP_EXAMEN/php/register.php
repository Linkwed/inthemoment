<?php ob_start(); ?>
<?php 
    require("common.php"); 
    if(!empty($_POST)) { 
        if(empty($_POST['username'])) { 
            die("Please enter a username."); 
        } 
        if(empty($_POST['password'])) { 
            die("Please enter a password."); 
        } 
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { 
            die("Invalid E-Mail Address"); 
        } 

        $query = " SELECT 1 FROM users WHERE username = :username "; 
         
        $query_params = array( 
            ':username' => $_POST['username'] 
        ); 
         
        try {  
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) {  
            die("Failed to run query: " . $ex->getMessage()); 
        } 
        $row = $stmt->fetch(); 

        if($row) { 

            die("This username is already in use"); 
        } 

        $query = " SELECT 1 FROM users WHERE email = :email "; 
         
        $query_params = array( 
            ':email' => $_POST['email'] 
        ); 
         
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
        $row = $stmt->fetch(); 
         
        if($row) {
            //TODO - add reload/return option 
            die("This email address is already registered"); 
        } 
        $query = " 
            INSERT INTO users ( 
                username, 
                password, 
                salt, 
                email 
            ) VALUES ( 
                :username, 
                :password, 
                :salt, 
                :email 
            ) 
        "; 
         
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
        $password = hash('sha256', $_POST['password'] . $salt); 
        for($round = 0; $round < 65536; $round++) { 
            $password = hash('sha256', $password . $salt); 
        }

        $query_params = array( 
            ':username' => $_POST['username'], 
            ':password' => $password, 
            ':salt' => $salt, 
            ':email' => $_POST['email'] 
        ); 
         
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 


        echo "<div><h1>You are now registered</h1><p>You will need to wait for an Admin to upgrade your Status</p><p>You are be able to Login immediately, and will be granted acces to restricted zone by an Admin</p><p><a href='../index.php'>Login Now </a><span class='fontawesome-arrow-right'></span></p></div>";
         
        // header("Location: registered.php"); 
        // die("Redirecting to rehistered.php"); 
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
        <title>Linky - Register</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--       <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css"> -->
        <link rel="stylesheet" href="../css/main.css">
        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
    
<div class="container">
      <div id="login"> 
        <h1>Register</h1> 
        <form action="register.php" method="post"> 
            <p> 
                <span class="fontawesome-user"></span>
                <input type="text" name="username" value="Username" onBlur="if(this.value == '') this.value = 'Username'" onFocus="if(this.value == 'Username') this.value = ''" required /> 
            </p> 
            <p>
                <span class="fontawesome-envelope"></span>
                <input type="text" name="email" value="Email" onBlur="if(this.value == '') this.value = 'Email'" onFocus="if(this.value == 'Email') this.value = ''" required /> 
            </p>
                <span class="fontawesome-lock"></span>
                <input type="password" name="password" value="Password" onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" required /> 
             <p>
            <input type="submit" value="Register" />
            </p>
        </form>
        <p>Already a member? <a href="../index.php">Login Now </a><span class="fontawesome-arrow-right"></span></p>
    </div> <!-- end login -->
</div> <!-- /container -->        

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/main.js"></script>
    </body>
</html>




