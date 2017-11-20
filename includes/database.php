<?php

require_once("config.php");

class MySQLDatabase
{
  
  private $connection;

  function __construct()
  {
    $this->open_connection();
  }

  public function open_connection()
  {
    $this->connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    $this->connection->connect_errno ? die("Connect Error: {$this->connection->connect_errno}") : null;
  }

  public function close_connection()
  {
    if(isset($this->connection))
    {
      $this->connection->close;
      unset($this->connection);
    }
  }

  public function query($query)
  {
    $result = $this->connection->query($query, MYSQLI_USE_RESULT);
    $this->confirm_query($result);
    return $result;
  }

  private function confirm_query($result)
  {
    echo $result ? null : "Query Error: {$this->connection->error}";
  }

  public function escape_value($string)
  {
    $escapedString = $this->connection->real_escape_string($string);
    return $escapedString;
  }

  public function fetch_array($result)
  {
    $array = $result->fetch_array(MYSQLI_ASSOC);
    return $array;
  }
  
}

$database = new MySQLDatabase();

?>