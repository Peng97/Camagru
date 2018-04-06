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
      $recive = (($_POST['recive'] != null)       ? $_POST['recive'] : 'Y' );


      if ($_POST['new_password'] != null)
      {
        if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $_POST['new_password']))
          $_SESSION['error'] = 'Password must have number and letter';
      }
      else if (($recive == null) || ($recive == N) || ($recive == Y))
      {
          $query->closeCursor();
          $query= $dbh->prepare("UPDATE users SET password=:password, mail=:mail, username=:username, recive=:recive WHERE id=:id");
          $query->execute(array(':password' => $nwpass,
                                 ':mail' => $nwmail, 
                                 ':username' => $nwname, 
                                 ':recive' => $recive, 
                                 ':id' => $_SESSION['id']
                                  ));
          include 'logout.php';  
      } else {
        $_SESSION['error'] = 'Recive must be Y or N in UPPERCASE!';
      }
      //apply change and delog
    } else {
      $_SESSION['error'] = 'Wrong password';
    }
    $query->closeCursor();
}
else{
    $_SESSION['error'] = "Error can't find session id"; 
}

header("Location: ../user.php");
?>