<?php

function send_verification_email($toAddr, $toUsername, $token, $ip) {
  include_once '../setup/database.php';
  $subject = "[CAMAGRU] - Email verification";

  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
  $headers .= 'From: <noreply@camagru.com>' . "\r\n";

  $message = '
  <html>
    <head>
      <title>' . $subject . '</title>
    </head>
    <body>
      Hello ' . htmlspecialchars($toUsername) . ', </br>
      Thanks you for chosen camagru :) now last step click on the <a href="http://' . $ip . '/mailcheck.php?token=' . $token . '">link</a> to activate your account. </br>
      
    </body>
  </html>
  ';
  mail($toAddr, $subject, $message, $headers);
}

function send_forget_mail($toAddr, $toUsername, $password) {
  $subject = "[CAMAGRU] - Reset your password";

  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
  $headers .= 'From: <noreply@camagru.com>' . "\r\n";
  $message = '
  <html>

    <head>
      <title>' . $subject . '</title>
    </head>
    <body>
      Hello ' . htmlspecialchars($toUsername) . ', </br>
      Your new password is : ' . $password . ' </br>
      You can change it from Account. </br>
    </body>
  </html>
  ';

  mail($toAddr, $subject, $message, $headers);
}

function send_comment_mail($toAddr, $toUsername, $comment, $fromUsername, $img, $ip) {
  $subject = "[CAMAGRU] - New comment";

  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
  $headers .= 'From: <noreply@camagru.com>' . "\r\n";

  $img = "http://". $ip . "/userphoto/" . $img;

  $message = '
  <html>
    <head>
      <title>' . $subject . '</title>
    </head>
    <body>
      Hello ' . htmlspecialchars($toUsername) . ' </br>
      You have a new comment on : </br></br>
      ' . $img .' </br>
      </br>
      <span>' . htmlspecialchars($fromUsername) . ': ' . htmlspecialchars($comment) . '</span>
    </body>
  </html>
  ';

  mail($toAddr, $subject, $message, $headers);
}
?>
