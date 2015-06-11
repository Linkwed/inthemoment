<?php
    $con=mysqli_connect("charlespattyn.be.mysql","charlespattyn_b","w4xwjvxb","charlespattyn_b");

    if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

    $result = mysqli_query($con,"SELECT * FROM messages ORDER BY time ASC LIMIT 10");

    while($row = mysqli_fetch_array($result))
      {
      echo $row['username'] . " - " . $row['message']; 
      echo "<br />";
      }

    mysqli_close($con); ?>

