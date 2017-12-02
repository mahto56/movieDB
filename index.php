<?php include "include/header.php"; ?>

<?php
  //create db object
    $db = new Db();
    //create query
    //$query = "SELECT * from movie";

    //run query
    $movies = $db->getMovieDetails();
    $genres = $db->getGenres();
    $count = $db->getMovieCount();
    $count = $count->fetch_assoc();
?>

<div id="panel">
        <?php if($genres) :?>
        <?php while($genre = $genres->fetch_assoc()) :?>
            <div class="genre"> <a href="genre.php?gen=<?=$genre['gen_title'];?>"><?=$genre['gen_title']?></a> </div>
        <?php endwhile ?>
        <?php endif ?>
</div>

    <div id="container">
        
         
      <div id="content" class="pane">
          <div class="head">
          <h3>All Movies (count: <?=$count['count(*)']?>)</h3>
          </div>
          <div id="main">

        
    <?php if($movies) :?>          
          <?php while($movie = $movies->fetch_assoc()) : ?>  
              <div class="image" id="<?=$movie['mov_id']; ?>"><a href="movie.php?id=<?=$movie['mov_id']?>"><img src="assets/images/<?=$movie['mov_id'];?>.jpg"></a></div>  
          <?php endwhile ?>



<!--           <?php for($i=0;$i<13;$i++): ?>
                <div class="image"><img src="https://dummyimage.com/180x300/333/fff"></div>  
            <?php endfor ?>
 -->
          </div>
          
      </div>
      <script src="assets/javascripts/script.js"></script>
      
    </div>
<?php else :?>
  <p>There are movies yet</p>
<?php endif; ?>
<?php include "include/footer.php"; ?>