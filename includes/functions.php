<?php

function strip_zeros_from_date($marked_string = "") 
{
  // first remove the marked zeros
  $no_zeros = str_replace('*0', '', $marked_string);
  // then remove any remaining marks
  $cleaned_string = str_replace('*', '', $no_zeros);
  return $cleaned_string;
}

function redirect_to( $location = NULL ) 
{
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}

function output_message($message = "") 
{
  return !empty($message) ? "<p class=\"message\">{$message}</p>" : null;
}

function __autoload($class_name)
{
  $class_name = strtolower($class_name);
  $path = "../includes/{$class_name}.php";
  file_exists($path) ? require_once($path) : die("The file {$class_name}.php could not be found.");
}

?>