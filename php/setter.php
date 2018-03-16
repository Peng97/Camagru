<?php


function add_montage($userId, $imgPath) {
  include_once '../setup/database.php';

  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("INSERT INTO gallery (userid, img) VALUES (:userid, :img)");
      $query->execute(array(':userid' => $userId, ':img' => $imgPath));
      return (0);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function remove_montage($uid, $img) {
  include_once '../setup/database.php';

  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT * FROM gallery WHERE img=:img AND userid=:userid");
      $query->execute(array(':img' => $img, ':userid' => $uid));

      $val = $query->fetch();
      if ($val == null) {
          $query->closeCursor();
          return (-1);
      }
      $query->closeCursor();

      $query= $dbh->prepare("DELETE FROM `like` WHERE galleryid=:galleryid");
      $query->execute(array(':galleryid' => $val['id']));
      $query->closeCursor();

      $query= $dbh->prepare("DELETE FROM comment WHERE galleryid=:galleryid");
      $query->execute(array(':galleryid' => $val['id']));
      $query->closeCursor();

      $query= $dbh->prepare("DELETE FROM gallery WHERE img=:img AND userid=:userid");
      $query->execute(array(':img' => $img, ':userid' => $uid));
      $query->closeCursor();
      return (0);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function comment($uid, $imgSrc, $comment) {
  include_once '../setup/database.php';

  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("INSERT INTO comment(userid, galleryid, comment) SELECT :userid, id, :comment FROM gallery WHERE img=:img");
      $query->execute(array(':userid' => $uid, ':comment' => $comment, ':img' => $imgSrc));
      return (0);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function add_like($uid, $img, $type) {
  include '../setup/database.php';
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("INSERT INTO `like`(userid, galleryid, type) SELECT :userid, id, :type FROM gallery WHERE img=:img");
      $query->execute(array(':userid' => $uid, ':img' => $img, ':type' => $type));
      return (0);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function update_like($uid, $img, $type) {
  include '../setup/database.php';
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("UPDATE `like`, gallery SET `like`.type=:type WHERE gallery.img=:img AND gallery.userid=:userid AND `like`.galleryid=gallery.id");
      $query->execute(array(':userid' => $uid, ':img' => $img, ':type' => $type));
      return (0);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

?>