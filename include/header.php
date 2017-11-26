<?php include 'config/config.php'; ?>
<?php include "lib/Db.php"; ?>
<!DOCTYPE html>
<html>
  <head>
    <title>MovieGenie</title>
    <link rel='stylesheet' href='assets/stylesheets/style.css' />
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.css">
    
  </head>
  <body>
    <div id="header">
      <span id="logo"><a href="index.php">MovieGenie</a> </span>
      <div id="navbar">
        <div id="nav">
        <form action="search.php" method="post" id="searchform">
        <input type="text" placeholder="Search by movies,actor,director,genre etc..." id="search" name="key">
        <a href="#" class="submitbtn btn" onclick="document.getElementById('searchform').submit()" style="display: none;">Go</a>
        </form>
        <a id="addbtn" class="btn">+ New</a>  
      </div>
      </div>
    </div>
    
    