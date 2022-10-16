 <?php
 $db = getenv("MYSQL_DATABASE");
 $user = getenv("MYSQL_USER");
 $pw = getenv("MYSQL_PASSWORD");

 $mysqli = new mysqli("database", $user, $pw, $db);

 // Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>
<?php var_dump($_SERVER['REMOTE_ADDR']); ?>
