<?php 
    if(!empty($_POST)) { 
        if(empty($_POST['message'])) { 
            die("Please enter a message."); 
        }  
        $query = " 
            INSERT INTO messages ( 
                username, 
                message 
                
            ) VALUES ( 
                :username, 
                :message 
            ) 
        ";
         $query_params = array( 
            ':username' => $_SESSION['user']['username'],
            ':message' => $_POST['message']
        );  
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 
        header("Location: private.php"); 
        die("Redirecting to private.php"); 
    } 
     
?>

      <div id="login" class="form_input chat2">    
        <form action="" method="post"> 
            <p>
                <input style="
    margin-bottom: 35px;" type="text" name="message" value="message" onBlur="if(this.value == '') this.value = 'message'" onFocus="if(this.value == 'message') this.value = ''" required /> 
             </p><p>
            <input type="submit" value="Send" />
            </p>
        </form>
        
    </div> 
      




