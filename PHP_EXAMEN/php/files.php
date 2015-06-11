<?php
  $files = [];
      $dir = '../files';
      $files = scandir($dir);
  
      foreach ($files as $file) {
        $file_del = substr($file, 0, 1);
        if($file_del != '.'){
          echo "<p ><a class='files_layout' href='../files/$file'>
                              $file
                        </a></p>";
        }
      }
      