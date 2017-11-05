<?php include 'include/header.php'; ?>
<?php
  //create db object
    $db = new Db();
    //create query
    $query = "SELECT * from movie";
    $movies = $db->getMovieDetailByID($_GET['id']);
    $movies = $movies->fetch_assoc();
    //run query
   
?>
<style>

#container{
  margin-top:100px;
  width:90%;
  color:black;  
}

.pane{
  background:none;
}

html{
  
  
}

</style>
<div id="container">
      <div id="content" class="pane">
      <div class="main">
        <h1 class="head"><?=$movies['mov_title']?></h1>
        <div style="display:flex; flex-direction:row">
        <img class="large-img" src="assets/images/<?=$movies['img_id']?>"><h2><?=$movies['mov_plot']?></h2></p>
        </div>
      <?php foreach($movies as $key=>$value): ?>
      <div><?php echo $key. "  :     ". $value;?></div>
      <?php endforeach ?>
        </div>
      </div>
</div>


<?php include 'include/footer.php'; ?>

