<?php

require_once(LIB_PATH.DS."database.php");

class DatabaseObject
{
  // Common database methods
  public static function find_all()
  {
    return self::find_by_sql("SELECT * FROM ".static::$table_name);
  }

  public static function find_by_id($id = 0)
  {
    $result_array = self::find_by_sql("SELECT * FROM ".static::$table_name." WHERE id = {$id} LIMIT 1");
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

  private static function instantiate($record)
  {

    $object = new static;

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