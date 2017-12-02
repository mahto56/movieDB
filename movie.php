<?php include 'include/header.php'; ?>
<?php
  //create db object
    $db = new Db();
    //create query
    
    //run query
    $genres = $db->getGenres();
    
?>

<!-- <div id="panel">
        <?php if($genres) :?>
        <?php while($genre = $genres->fetch_assoc()) :?>
            <div class="genre"> <a href="genre.php?gen=<?=$genre['gen_title'];?>"><?=$genre['gen_title']?></a> </div>
        <?php endwhile ?>
        <?php endif ?>
</div>
 -->
<div id="container">
    
    <?php
    //get Movies
    $movies = $db->getMovieDetailByID($_GET['id']);
    $movies = $movies->fetch_assoc();
    $rating = $db->getRatingByID($_GET['id']);
    if($rating!=null)
    $rating = $rating->fetch_assoc();  
    $credits = $db->getCredits($_GET['id']);
    $directors = $db->getDirectors($_GET['id']);
    // $credits = $credits->fetch_assoc();  
    
    ?>

      <div id="content" class="pane">
      <div class="main">
      <?php if($movies) :?>          
        <h1 class="head"><?=$movies['mov_title']?> <a class="close-btn" href="delete.php?id=<?=$_GET['id']?>" onclick="return confirm('Delete this movie?');">&times;</a></h1> 
        <div style="display:flex; flex-direction:row">
        <img class="large-img" src="assets/images/<?=$movies['mov_id']?>.jpg">
        <div class="mov-info">
          <h2><?=$movies['mov_plot']?></h2>
          <div class="credits">
          <div class="credits-info">Length: <?=$movies['mov_time']?> minutes</div>
          <div class="credits-info">Language: <?=$movies['mov_lang']?></div>
          <div class="credits-info">Released on: <?=$movies['mov_dt_rel']?></div>
          <?php if($rating) :?>
          <div class="credits-info">Ratings: 
            <span style="color:red;">
            <?php for($i=0;$i<$rating['rev_stars']/2;$i++) : ?>
              ★ 
            <?php endfor; ?>
            </span>
            </div>
          <?php endif ?>
          
          </div>

          
        </div>
        </div>

        <div class="credits" style="margin: 10px;display: flex;flex-direction: row;justify-content: space-around;">
        <div style="display: flex;flex-direction: column; margin: 20px;">
        <h1>Cast </h1>

            <?php if($credits) :?>
            <?php while($credit = $credits->fetch_assoc()) :?>
              <div class="credits-info"><strong><?=$credit['act_name']?></strong>:   <?=$credit['role']?></div>  
            <?php endwhile ?>
          <?php endif ?>
        </div>

        <div style="display: flex;flex-direction: column; margin: 20px;">
        <h1>Direction </h1>

            <?php if($directors) :?>
            <?php while($director = $directors->fetch_assoc()) :?>
              <div class="credits-info"><b><?=$director['dir_name']?></b>
                
              </div>  
            <?php endwhile ?>
          <?php endif ?>
        </div>

      </div>
      
        </div>
      </div>
      <?php endif ?>
</div>


<?php include 'include/footer.php'; ?>

