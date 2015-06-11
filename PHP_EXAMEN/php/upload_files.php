<?php
define("UPLOAD_DIR", "../files/");
 
if (!empty($_FILES["files"])) {
    $files = $_FILES["files"];
 
    if ($files["error"] !== UPLOAD_ERR_OK) {
        echo "<p>An error occurred.</p>";
        exit;
    }
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $files["name"]);
    $i = 0;
    $parts = pathinfo($name);
    while (file_exists(UPLOAD_DIR . $name)) {
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }

    $success = move_uploaded_file($files["tmp_name"],
        UPLOAD_DIR . $name);
    if (!$success) { 
        echo "<p>Unable to save file.</p>";
        exit;
    }
    chmod(UPLOAD_DIR . $name, 0644);
    header("Location: private.php"); 
    die("Redirecting to private.php"); 
}
?>


<div id="login" class="chat2"> 
    <form action="upload_files.php" method="post" enctype="multipart/form-data"> 
     <p><input type="file" name="files"></p>
     <p><input type="submit" value="Upload"></p>
    </form>
</div>