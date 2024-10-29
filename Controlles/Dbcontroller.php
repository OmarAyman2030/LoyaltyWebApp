<?php

use FTP\Connection;

class Dbcontroller{
public $dbhost="localhost";
public $dbuser="root";
public $dbpassword="";
public $dbname="loyality";
public $connection; 
 public $db;
public function openconnection() {
 
  $this->connection=new mysqli($this->dbhost,$this->dbuser,$this->dbpassword,$this->dbname);
  if($this->connection->connect_error){
    echo "error in connection ".$this->connection->connect_error;
return false ;  
}
else{
    //echo" connetcted ";
return true;
}

}


public function get($n){
    $this->db=new Dbcontroller;
    if($this->db->openconnection()){
    $query="select * from ".$n;
    return $this->db->select($query);
    }
    else{
        echo"Falid in connection";
        return false;
    }
}
public function closeconnection(){
    if($this->connection){
        $this->connection->close();
    }
}
public function select($query)  {
    $result=$this->connection->query($query);
    if(!$result){
        echo "Error oops ".mysqli_error($this->connection);
return false;
    }
    else{
return $result->fetch_all(MYSQLI_ASSOC);

    }
}
public function insert($query)  {
    $result=$this->connection->query($query);
    if(!$result){
        echo "Error oops ".mysqli_error($this->connection);
return false;
    }
    else{
       return $this->connection->insert_id;
       }
}

public function delete($query)  {
    $result=$this->connection->query($query);
    if(!$result){
        echo "Error oops ".mysqli_error($this->connection);
return false;
    }
    else{
       return true;
       }
}
public function executeQuery($query) {
    $result = mysqli_query($this->connection, $query);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

public function runQuery($query)
    {
        $result = $this->connection->query($query);

        if (!$result) {
            echo "Error executing query: " . $this->connection->error;
        }

        return $result;
    }
    public function selectWithParams($query, $params)
    {
        $stmt = $this->connection->prepare($query);
        if ($stmt) {
            $stmt->bind_param(str_repeat('s', count($params)), ...$params); // Bind parameters
            $stmt->execute(); // Execute query
            $result = $stmt->get_result(); // Get result set
            $stmt->close(); // Close statement
            return $result; // Return result set
        } else {
            return false; // Return false if preparation fails
        }
    }

    // Function to get number of rows in a result set
    public function getNumRows($result)
    {
        return $result->num_rows; // Return number of rows
    }
    public function update($query)
    {
        $result = $this->connection->query($query);
        if (!$result) {
            echo "Error oops " . mysqli_error($this->connection);
            return false;
        } else {
            return true;
        }
    }
}
?>