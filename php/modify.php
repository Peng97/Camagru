<?php
session_start();
include_once '../setup/database.php';

if ($_SESSION['id'] != null)
{
    $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query= $dbh->prepare("SELECT username, mail FROM users WHERE id=:id AND password=:password");
    $userMail = strtolower($userMail);
    $odpass = hash("whirlpool", $_POST['old_password']);
    $query->execute(array(':id' => $_SESSION['id'], ':password' => $odpass)); 
    $val = $query->fetch();
    // password verifed

    if ($val != null) {
      $nwname = (($_POST['username'] != null)     ? $_POST['username'] : $val['username'] );
      $nwpass = (($_POST['new_password'] != null) ? hash("whirlpool", $_POST['new_password']) : $odpass );
      $nwmail = (($_POST['mail'] != null)         ? $_POST['mail'] : $val['mail'] );
      
      $query->closeCursor();
      $query= $dbh->prepare("UPDATE users SET password=:password, mail=:mail, username=:username WHERE id=:id");
      $query->execute(array(':password' => $nwpass, ':mail' => $nwmail, ':username' => $nwname, ':id' => $_SESSION['id']));
    
      //apply change and delog
      include 'logout.php';
    } else {
      $_SESSION['error'] = 'Wrong password';
    }
    $query->closeCursor();
    /*
    $query->closeCursor();

    $pass = uniqid('');
    $passEncrypt = hash("whirlpool", $pass);

  //  $query= $dbh->prepare("UPDATE users SET password=:password WHERE mail=:mail");
    $query->execute(array(':password' => $passEncrypt, ':mail' => $userMail));

    */
}
else{
    $_SESSION['error'] = "Error can't find session id"; 
}

header("Location: ../user.php");
?>