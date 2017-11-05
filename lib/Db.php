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
    {   $query = "SELECT * FROM movie where img_id is not null order by rand()";
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

    public function getGenres()
    {   $query = "SELECT * FROM genres order by rand()";
        $data = $this->mysqli->query($query) or die("ERROR: Could not get genres: " . mysqli_error($this->mysqli));
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
}