<?php
session_start();

function log_user($username, $password) {
  include_once '../setup/database.php';

  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT id, username FROM users WHERE username=:username AND password=:password AND verified='Y'");
      $username = strtolower($username);
      $password = hash("whirlpool", $password);
      $query->execute(array(':username' => $username, ':password' => $password));

      $val = $query->fetch();
      if ($val == null) {
          $query->closeCursor();
          return (-1);
      }
      $query->closeCursor();

      return ($val);
    } catch (PDOException $e) {
      $v['err'] = $e->getMessage();
      return ($v);
    }
}

$username = $_POST['username'];
$password = $_POST['password'];

if (($val = log_user($username, $password)) == -1) {
  $_SESSION['error'] = "Username/password wrong";
} else if (isset($val['err'])) {
  $_SESSION['error'] = $val['err'];
} else {
  $_SESSION['id'] = $val['id'];
  $_SESSION['username'] = $val['username'];
}

header("Location: ../index.php");

?>