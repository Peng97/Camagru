<?

session_start();

include_once '../setup/database.php';
include_once 'mail.php';

    try {
      $comment = $_POST['comm'];
      $img_id = $_POST['img_id'];
      $owner_id = $_POST['owner_id'];
      $uid = $_SESSION['id'];
      $img_path = split("/", $_POST['path']);

      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $query= $dbh->prepare("INSERT INTO comment(userid, galleryid, comment) VALUES(:userid, :galleryid, :comment)");
      $query->execute(array(':userid' => $uid, 'galleryid' => $img_id,  ':comment' => $comment));
      $query->closeCursor();

      $query= $dbh->prepare("SELECT mail,username,recive FROM users WHERE id=:id");
      $query->execute(array(':id' => $owner_id));
      $val = $query->fetch();
      $query->closeCursor();
      if ($val['recive'] == 'Y')
          send_comment_mail($val['mail'], $val['username'], $comment, $_SESSION['username'], $img_path[2], $ADRESS);
    } catch (PDOException $e) {
      echo ($e->getMessage());
    }

?>