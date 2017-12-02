<?php include "include/header.php"; 
$db = new Db();
?>
<script language=”JavaScript” type=”text/javascript” src=”suggest.js”></script>
<style type="text/css">
  #addbtn{
    display: none;

  }
  input,select{
    height: 40px;

    padding: 5px;
    text-align: center;
  }

  #search{
    padding: 0px;
  }
  span{
    padding: 5px 0;
  }
  input[type=time]::-webkit-clear-button {
   -webkit-appearance: none;
   -moz-appearance: none;
   appearance: none;
   margin: 0; 
 }
 #time:valid { 
color: #4F8A10;
    background-color: #DFF2BF;
}

#time:invalid { 
color: #D8000C;
    background-color: #FFD2D2;
}
#time{
  border: 1px solid #999;

}  

</style>
<script type="text/javascript">
  var tots =0 ;
  function addElement(parentId, elementTag, elementId, html) {
    // Adds an element to the document
    var p = document.getElementById(parentId);
    var newElement = document.createElement(elementTag);
    newElement.setAttribute('id', elementId);
    newElement.setAttribute('style', 'display: flex;flex-direction: row;width: 100%;justify-content:space-between;')
    
    newElement.innerHTML = html;
    p.appendChild(newElement);
}

function removeElement(elementId) {
    // Removes an element from the document
    var element = document.getElementById(elementId);
    element.parentNode.removeChild(element);
}

function add_actor(){
  tots+=1;
  addElement('act','span','act_child'+tots,`<?php $db->showActors() ?> <input type="text" name="" placeholder="role"><br/>`);
}

function add_dir(){
  addElement('dir','span','',`<?php $db->showDirectors() ?>`);
}

function add_genre(){
  addElement('gen','span','',`<?php $db->showGenre() ?>`);
}

</script>
<?php
?>


    <div id="container">
        
         
      <div id="content" class="pane">
          <div class="head">
          <h3>Add a new Movie</h3>
          </div>
          <div id="main">
              <form action="add.php" style="display:flex;flex-direction: column; width: 50%;margin: 0px auto;justify-content: space-between;">
                <input type="text" name="mov_title" placeholder="Movie Name"> 
                <br/>
                <input type="text" name="mov_plot" placeholder="Plot of Movie">
                <br/>
                <input type="date" name="rel_date" placeholder="Release Date">
                <br/>
                <input id="time" type="text" pattern="([0-5]{1}[0-9]{1}:){0,2}[0-5]{0,1}[0-9]{1}(\.\d+)?" placeholder="Running time- 00:00:00" />
                <br/>
                <?php include 'country.php';?>
                <br/>
                <span style="width: 100%;justify-content: space-between; border: 1px solid #999">
                  <span style="padding: 0px; font-weight: bolder; text-align:right;">Choose a Image: </span>
                  <input type="file" accept=".jpg" name=""  style="height:auto;width: 60%; margin: 0px 0;"></span><br/>
                <div id="dir">
                  <span  name="" style="display: flex;flex-direction: row;width: 100%;justify-content: space-between;">
                    <!-- <input type="text" name="dir_name" placeholder="Director of Movie" style="width: 100%;"><br/> -->
                    <?php $db->showDirectors() ?>
                  </span>
                </div>
                <input type="button" class="btn" value="+add more director" onclick="add_dir();">
                <br/>
                <div id="act">
                <span  name="" style="display: flex;flex-direction: row;width: 100%;justify-content: space-between;">
                  <?php $db->showActors() ?> <input type="text" name="" placeholder="role">
                </span>
                </div>
                <input type="button" class="btn" value="+add more actor" onclick="add_actor()">
                <br/>

                <div id="gen">
                  <span  name="" style="display: flex;flex-direction: row;width: 100%;justify-content: space-between;">
                    <!-- <input type="text" name="dir_name" placeholder="Director of Movie" style="width: 100%;"><br/> -->
                    <?php $db->showGenre() ?> 
                  </span>
                </div>
                <input type="button" class="btn" value="+add more genre" onclick="add_genre()">
                <br/>
                <input type="submit" name="" value="submit"><br/>
              </form>
                      
          </div>
          
      </div>
    </div>

<?php include "include/footer.php"; ?>
