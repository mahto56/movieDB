<?php include 'config/config.php'; ?>
<?php include "lib/Db.php"; ?>
<?php
  //create db object
    $db = new Db();
    //create query
    //run query
     $db->deleteMovieByID($_GET['id']);
     echo "Sucess";
   
?>