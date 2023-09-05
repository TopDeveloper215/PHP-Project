<?php
class Database {
  public $host = DB_HOST;
  public $user = DB_USER;
  public $pass = DB_PASS;
  public $dbname = DB_NAME;

  public $link;
  public $error;

  public function __construct(){
    $this->connectDB();
  }

  private function connectDB(){
    $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
    if(!$this->link){
      $this->error= "connection failed". $this->link->connect_error;
    }
  }

  // read or select data
  public function Select($query){
    $result = $this->link->query($query) or die($this->link->error. __LINE__);
    if($result->num_rows > 0){
      return $result;
    }else{
      return false;
    }

  }

  public function Insert($query){
    $insert_row = $this->link->query($query) or die($this->link->error. __LINE__);
    if($insert_row){
      $success = "<h4 class = 'alert alert-success'>Inserted successfully!"."</h4>";
      echo $success;
      
    }else{
      $this->link->error;
    }
  }

  public function Update($query){
    $update_id = $this->link->query($query) or die($this->link->error.__LINE__);
    if($update_id){
      $success = "<h4 class = 'alert alert-success'>Data Inserted successfully!"."</h4>";
      echo $success;
    }else{
      $this->link->error;
    }
  }

  public function Delete($query){
    $delete_id = $this->link->query($query) or die($this->link->error.__LINE__);
    if($delete_id){
      $success = "<h4 class = 'alert alert-success'>Deleted successfully!"."</h4>";
      echo $success;
    }
  }
}
