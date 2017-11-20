<?php

// requiring database class because User is using it's methods and attributes
require_once("database.php");

class User
{
  
  public $id;
  public $username;
  public $password;
  public $first_name;
  public $last_name;

  public static function find_all()
  {
    return self::find_by_sql("SELECT * FROM users");
  }

  public static function find_by_id($id = 0)
  {
    $result_array = self::find_by_sql("SELECT * FROM users WHERE id = {$id} LIMIT 1");
    return !empty($result_array) ? array_shift($result_array) : false;
  }

  public static function find_by_sql($query = "")
  {
    global $database;
    $result = $database->query($query);
    $object_array = [];
    while($row = $database->fetch_array($result))
    {
      $object_array[] = self::instantiate($row);
    }
    return $object_array;
  }

  public static function authenticate($username = "", $password = "")
  {
    global $database;
    $username = $database->escape_value($username);
    $password = $database->escape_value($password);
    
    $query = "SELECT * FROM users";
    $query .= " WHERE username = '{$username}'";
    $query .= " AND password = '{$password}'";
    $query .= " LIMIT 1";
    
    $result_array = self::find_by_sql($query);
    return !empty($result_array) ? array_shift($result_array) : false;
  }

  public function full_name()
  {
    if(isset($this->first_name) && isset($this->last_name))
    {
      return "{$this->first_name} {$this->last_name}";
    }
    else
    {
      return "";
    }
  }

  private static function instantiate($record)
  {
    $object = new self;

    foreach ($record as $attribute => $value)
    {
      $object->has_attribute($attribute) ? $object->$attribute = $value : null;
    }
    return $object;
  }

  private function has_attribute($attribute)
  {
    $object_vars = get_object_vars($this);
    return array_key_exists($attribute, $object_vars);
  }
  
}

?>
