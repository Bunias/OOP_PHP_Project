<?php

require_once("../includes/initialize.php");

$user = User::find_by_id(1);


?>

<!DOCTYPE html>

<?php include_layout_template("header.php"); ?>

      <?php
      echo "<p>{$user->full_name()}</p><hr>";

      $users = User::find_all();
      foreach($users as $user)
      {
        echo "User: {$user->username}<br/>";
        echo "Name: {$user->full_name()}<br/>";
      }
      ?>
      
<?php include_layout_template("footer.php"); ?>