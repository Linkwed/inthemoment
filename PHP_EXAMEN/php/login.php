    <?php
    $submitted_username = ''; 
     
    if(!empty($_POST)) 
    { 
        $query = " 
            SELECT 
                id, 
                username, 
                password, 
                salt, 
                email,
                status
            FROM users 
            WHERE 
                username = :username 
        "; 
         
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
         
        $login_ok = false; 
        $row = $stmt->fetch(); 
        if($row) { 
            $check_password = hash('sha256', $_POST['password'] . $row['salt']); 
            for($round = 0; $round < 65536; $round++) { 
                $check_password = hash('sha256', $check_password . $row['salt']); 
            } 
             
            if($check_password === $row['password']) { 
                $login_ok = true; 
            } 
        } 
         
        if($login_ok) { 
            unset($row['salt']); 
            unset($row['password']); 

            $_SESSION['user'] = $row; 
             
              header("Location: php/private.php"); 
              die("Redirecting to: php/private.php"); 
        } 
        else {  
            print("Login Failed."); 
            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
        } 
    } 
     
?>
    <div class="container">
        
        <div id="login">
            <form action="index.php" method="post">
                <p>
                    <span class="fontawesome-user"></span>
                    <input type="text" name="username" value="Username" onBlur="if(this.value == '') this.value = 'Username'" onFocus="if(this.value == 'Username') this.value = ''" required /></p>
                <p>
                    <span class="fontawesome-lock"></span>
                    <input type="password" name="password" value="Password" onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" required /></p>
                <p><input type="submit" value="Login" /></p>
            </form>
            <p>Not a member? <a href="php/register.php">Sign up now</a><span class="fontawesome-arrow-right"></span></p>
        </div> <!-- end login -->

    </div><!-- /container --> 












