<?php include "include/header.php"; ?>

<?php
  //create db object
    $db = new Db();
    //create query
    //$query = "SELECT * from movie";

    //run query
    $movies = $db->getMovieByGenre($_GET['gen']);
    $genres = $db->getGenres();
?>

<!--     <div id="panel">
        <?php if($genres) :?>
            <?php while($genre = $genres->fetch_assoc()) :?>
                <?php if($genre['gen_title'] == $_GET['gen']) : ?>
                <div class="genre focus"> <a href="genre.php?gen=<?=$genre['gen_title'];?>"><?=$genre['gen_title']?></a> </div>
                <?php else: ?> 
                <div class="genre"> <a href="genre.php?gen=<?=$genre['gen_title'];?>"><?=$genre['gen_title']?></a> </div>
                <?php endif ?>
            <?php endwhile ?>
        <?php endif ?>
    </div>
 -->
    <div id="container">
        
         
      <div id="content" class="pane">
          <div class="head">
          <h3><?=$_GET['gen']?> Movies</h3>
          </div>
          <div id="main">

          <?php if($movies) :?>
          
                <?php while($movie = $movies->fetch_assoc()) : ?>  
                    <div class="image" id="<?=$movie['mov_id']; ?>"><a href="movie.php?id=<?=$movie['mov_id']?>"><img src="assets/images/<?=$movie['mov_id']; ?>.jpg"></a></div>  
                <?php endwhile ?>

          </div
          
      </div>
      <script src="assets/javascripts/script.js"></script>
      <?php else :?>
  <p>Sorry! There are no movies yet in <?=$_GET['gen']?> genre :( </p>
<?php endif; ?>
    </div>

<?php include "include/footer.php"; ?>