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
      <span id="logo">MovieGenie </span>
      <div id="navbar">
        <div id="nav">
        
        <input type="text" placeholder="Search by movies,actor,director etc..." id="search">
        <a id="addbtn">+ New</a>  
      </div>
      </div>
    </div>
    
    