<?php
session_start();

function signup($mail, $username, $password, $host) {
  include_once '../setup/database.php';
  include_once '../php/mail.php';

  $username = strtolower($username);

  try {
          $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
          $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $query= $dbh->prepare("SELECT id FROM users WHERE username=:username "); // OR mail=:mail"); if no multi acc for one adress
          $query->execute(array(':username' => $username)); //, ':mail' => $mail));

          if ($val = $query->fetch()) {
            $_SESSION['error'] = "Username or mail already exist";
            $query->closeCursor();
            return (-1);
          } else {
              $query->closeCursor();

              $password = hash("whirlpool", $password);

              $query= $dbh->prepare("INSERT INTO users (username, mail, password, token) VALUES (:username, :mail, :password, :token)");
              $token = uniqid(rand(), true);
              $query->execute(array(':username' => $username, ':mail' => $mail, ':password' => $password, ':token' => $token));
              send_verification_email($mail, $username, $token, $ADRESS);

              $_SESSION['signup_success'] = true;
              return (1);
          }
      } catch (PDOException $e) {
          $_SESSION['error'] = "ERROR: ".$e->getMessage();
      }
}

$mail = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];


$_SESSION['error'] = null;

if ($mail == null || $username == null || $password == null) {
  $_SESSION['error'] = "All field is requird ! ";
  header("Location: ../register.php");
  return;
}

if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
  $_SESSION['error'] = $_SESSION['error']."You need to enter a valid email. ";
  header("Location: ../register.php");
  return;
}

if (strlen($username) > 50 || strlen($username) < 3) {
  $_SESSION['error'] = $_SESSION['error']."Username should be beetween 3 and 50 characters. ";
  header("Location: ../register.php");
  return;
}

if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password))
{
  $_SESSION['error'] = 'Password must have number and letter';
  header("Location: ../register.php");
  return;
}

if (strlen($password) < 3) {
  $_SESSION['error'] = $_SESSION['error']."Password should be beetween 3 and 255 characters. ";
  header("Location: ../register.php");
  return;
}

$url = $_SERVER['HTTP_HOST'] . str_replace("/forms/signup.php", "", $_SERVER['REQUEST_URI']);

signup($mail, $username, $password, $url);
if ($_SESSION['signup_success'] == true)
  header("Location: ../index.php");
else
  header("Location: ../register.php");
?>