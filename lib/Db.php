<?php
class Db{
    public $host = HOST;
    public $username = USER;
    public $password = PASSWORD;
    public $db_name = DB_NAME;

    public $mysqli; //mysqli object

    public function __construct()
    {
        //call connect function
        $this->connect();
    }

    function __destruct(){
        //Close the Connection
        $this->mysqli->close();
    }


    private function connect()
    {
        $this->mysqli = new mysqli($this->host,$this->username,$this->password,$this->db_name);

        if(!$this->mysqli){
            die("ERROR: Could not connect. " . mysqli_connect_error());            
        }
    }

    public function getMovieDetails()
    {   $query = "SELECT * FROM movie order by rand()";
        $data = $this->mysqli->query($query) or die("ERROR: Could not get movie details" . mysqli_error($this->mysqli));
        if($data->num_rows > 0){
            return $data;
        }
        else{
            return false;
        }
    }

    public function getMovieDetailByID($id)
    {   $query = "SELECT * FROM movie where mov_id=$id";
        $data = $this->mysqli->query($query) or die("ERROR: Could not get movie details: " . mysqli_error($this->mysqli));
        if($data->num_rows > 0){
            return $data;
        }
        else{
            return false;
        }
    }


    public function getRatingByID($id)
    {
        $query = "SELECT r.rev_stars FROM rating r where mov_id=$id";
        $data = $this->mysqli->query($query) or die("ERROR: Could not get movie details: " . mysqli_error($this->mysqli));
        if($data->num_rows > 0){
            return $data;
        }
        else{
            return false;
        }   
    }

    public function deleteMovieByID($id)
    {
        $delete_row = $this->mysqli->query("DELETE FROM movie where mov_id=$id") or die($this->mysqli->error.__LINE__);

        //validate delete
        if($delete_row){
            //redirect if success
            header("Location: index.php?msg=".urlencode('Record deleted'));
        }else{
            die("ERROR: Could not able to execute $query. " . mysqli_error($this->mysqli));
        }   
    }

    public function getMovieByGenre($genre)
    {   $query = "SELECT m.* FROM movie m,movie_genres mg WHERE mg.mov_id=m.mov_id AND mg.gen_id IN (SELECT gen_id FROM genres WHERE gen_title LIKE '%$genre%');";
        $data = $this->mysqli->query($query) or die("ERROR: Could not get movie details: " . mysqli_error($this->mysqli));
        if($data->num_rows > 0){
            return $data;
        }
        else{
            return false;
        }
    }

    public function getGenres()
    {   $query = "SELECT * FROM genres";
        $data = $this->mysqli->query($query) or die("ERROR: Could not get genres: " . mysqli_error($this->mysqli));
        if($data->num_rows > 0){
            return $data;
        }
        else{
            return false;
        }
    }

    public function getCredits($id){
        $query = "SELECT a.act_name,c.role from actor a,movie_cast c WHERE c.mov_id=$id AND c.act_id=a.act_id";   
        $data = $this->mysqli->query($query) or die("ERROR: Could not get movie details: " . mysqli_error($this->mysqli));
        if($data->num_rows > 0){
            return $data;
        }
        else{
            return false;
        }
    }

    //select method for query
    public function select($query)
    {
        $result = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
        //if returned result size > 0 return $result
        if($result->num_rows>0){
            return $result;
        }else{
            return false;
        }
    }


    //insert method
    public function insert($query)
    {
        $insert_row = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);

        //validate insert
        if($insert_row){
            //redirect if success
            header("Location: index.php?msg=".urlencode('Record Added'));
        }else{
            die("ERROR: Could not able to execute $query. " . mysqli_error($this->mysqli));
        }
    }

    public function delete($query)
    {
        $delete_row = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);

        //validate delete
        if($delete_row){
            //redirect if success
            header("Location: index.php?msg=".urlencode('Record deleted'));
        }else{
            die("ERROR: Could not able to execute $query. " . mysqli_error($this->mysqli));
        }
    }



    public function SearchMovieDetails($query)
    {   $query = "SELECT m.* FROM movie m WHERE '$query' LIKE CONCAT(m.mov_title,'%') 
                  UNION 
                  SELECT m.* FROM movie m WHERE m.mov_title LIKE '%$query%' 
                  UNION 
                  SELECT m.* FROM movie m,movie_genres mg WHERE mg.mov_id=m.mov_id AND mg.gen_id IN (SELECT gen_id FROM genres WHERE '$query' LIKE CONCAT(gen_title,'%'))
                  UNION
                  SELECT m.* FROM movie m where m.mov_id in (SELECT c.mov_id FROM movie_cast c where '$query' LIKE CONCAT(c.role,'%'))
                  UNION
                  SELECT m.* FROM movie m where m.mov_id in (SELECT c.mov_id FROM movie_cast c where c.role LIKE '%$query%' )
                  UNION
                  SELECT m.* FROM movie m where m.mov_id in (SELECT c.mov_id FROM movie_cast c where c.act_id in 
                  (SELECT a.act_id from actor a where a.act_name LIKE '%$query%'))
                  UNION
                  SELECT m.* FROM movie m where m.mov_id in (SELECT c.mov_id FROM movie_cast c where c.act_id in 
                  (SELECT a.act_id from actor a where '$query' LIKE CONCAT(a.act_name,'%')))";
        $data = $this->mysqli->query($query) or die("ERROR: Could not get movie details" . mysqli_error($this->mysqli));
        if($data->num_rows > 0){
            return $data;
        }
        else{
            return false;
        }
    }
}