<?php include "include/header.php"; ?>

<?php
  //create db object
    $db = new Db();
    //create query
    //$query = "SELECT * from movie";

    //run query
    $movies = $db->getMovieDetails();
    $genres = $db->getGenres();
?>
<?php if($movies) :?>
    <div id="panel">

        <?php if($genres) :?>
        <?php while($genre = $genres->fetch_assoc()) :?>
            <div class="genre"> <a href=""><?=$genre['gen_title']?></a> </div>
        <?php endwhile ?>
        <?php endif ?>
    </div>
    <div id="container">
        
         
      <div id="content" class="pane">
          <div class="head">
          <h3>Popular Movies</h3>
          </div>
          <div id="main">

        
          
          <?php while($movie = $movies->fetch_assoc()) : ?>  
              <div class="image" id="<?=$movie['mov_id']; ?>"><a href="movie.php?id=<?=$movie['mov_id']?>"><img src="assets/images/<?=$movie['img_id']; ?>"></a></div>  
          <?php endwhile ?>



          <?php for($i=0;$i<25;$i++): ?>
                <div class="image"><img src="https://dummyimage.com/180x300/333/fff"></div>  
            <?php endfor ?>

          </div>
          
      </div>
      <script src="assets/javascripts/script.js"></script>
    </div>
<?php else :?>
  <p>There are movies yet</p>
<?php endif; ?>
<?php include "include/footer.php"; ?>