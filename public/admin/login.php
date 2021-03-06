<?php

require_once('../../includes/initialize.php');

$session->is_logged_in() ? redirect_to("index.php") : null;

if (isset($_POST['submit']))
{
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  
  $found_user = User::authenticate($username, $password);
  
  if($found_user)
  {
    $session->login($found_user);
    redirect_to("index.php");
  }
  else
  {
    $message = "Username/password combination incorrect.";  
  }
}
else
{
  $username = "";
  $password = "";
}

?>

<!DOCTYPE html>

<?php include_layout_template("admin_header.php"); ?>

      <h2>Staff Login</h2>
      <?php echo output_message($message); ?>
      
      <form action="login.php" method="post">
        <table>
          <tr>
            <td>Username:</td>
            <td>
              <input 
              type="text" name="username" maxlength="30" 
              value="<?php echo htmlentities($username); ?>"
              />
            </td>
          </tr>
          <tr>
            <td>Password:</td>
            <td>
              <input 
              type="password" name="password" maxlength="30" 
              value="<?php echo htmlentities($password); ?>"
              />
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <input type="submit" name="submit" value="login" />
            </td>
          </tr>
        </table>
      </form>
      
<?php include_layout_template("admin_footer.php"); ?>

<?php
  isset($database) ? $database->close_connection() : null;
?>