<?php include 'include/header.php'?>
<?php
  //create db object
    $db = new Db();
    //create query
    //$query = "SELECT * from movie";

    //run query
    
    $movies = $db->SearchMovieDetails($_POST['key']);
    
    $genres = $db->getGenres();
?>

<!-- <div id="panel">
        <?php if($genres) :?>
        <?php while($genre = $genres->fetch_assoc()) :?>
            <div class="genre"> <a href="genre.php?gen=<?=$genre['gen_title'];?>"><?=$genre['gen_title']?></a> </div>
        <?php endwhile ?>
        <?php endif ?>
</div> -->

<div id="container">
        
         
      <div id="content" class="pane">
          <div class="head">
          <h3>Search Results for <?=$_POST['key']?></h3>
          </div>
          <div id="main">

        
    <?php if($movies) :?>          
          
          <?php while($movie = $movies->fetch_assoc()) : ?>  
              <div class="image" id="<?=$movie['mov_id']; ?>"><a href="movie.php?id=<?=$movie['mov_id']?>"><img src="assets/images/<?=$movie['mov_id']?>.jpg"></a></div>  
    
          <?php endwhile ?>

          
      </div>
      <script src="assets/javascripts/script.js"></script>
      
    </div>
<?php else :?>
  <p>There are movies by that name!</p>
<?php endif; ?>
<?php include "include/footer.php"; ?>