<?

function get_all_montage() {
  include_once './setup/database.php';

  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT userid, img FROM gallery");
      $query->execute();

      $i = 0;
      $tab = null;
      while ($val = $query->fetch()) {
        $tab[$i] = $val;
        $i++;
      }
      $query->closeCursor();

      return ($tab);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}



function get_montages($start, $nb) {
  include_once './setup/database.php';

  try {
      if ($start < 0) {
        $start = 0;
      }
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT userid, img, id FROM gallery WHERE id > :id ORDER BY id ASC LIMIT :lim");
      $query->bindValue(':lim', $nb + 1, PDO::PARAM_INT);
      $query->bindValue(':id', $start, PDO::PARAM_INT);
      $query->execute();

      $i = 0;
      $tab = null;
      while (($val = $query->fetch())) {
        if ($i >= $nb) {
          $tab['more'] = true;
        } else {
          $tab[$i] = $val;
        }
        $i++;
      }
      $query->closeCursor();

      return ($tab);
    } catch (PDOException $e) {
      $s;
      $s['error'] = $e->getMessage();
      return ($s);
    }
}

/*
function get_montages2($start, $nb) {
  include_once '../setup/database.php';

  try {
      if ($start < 0) {
        $start = 0;
      }
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT userid, img, id FROM gallery WHERE id > :id ORDER BY id ASC LIMIT :lim");
      $query->bindValue(':lim', $nb + 1, PDO::PARAM_INT);
      $query->bindValue(':id', $start, PDO::PARAM_INT);
      $query->execute();

      $i = 0;
      $tab = null;
      while (($val = $query->fetch())) {
        if ($i >= $nb) {
          $tab['more'] = true;
        } else {
          $tab[$i] = $val;
        }
        $i++;
      }
      $query->closeCursor();

      return ($tab);
    } catch (PDOException $e) {
      $s;
      $s['error'] = $e->getMessage();
      return ($s);
    }
}
*/

function get_comments($imgSrc) {
  include './setup/database.php';

  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT c.comment, u.username FROM comment AS c, users AS u, gallery AS g WHERE g.img=:img AND g.id=c.galleryid AND c.userid=u.id");
      $query->execute(array(':img' => $imgSrc));

      $i = 0;
      $tab = "";
      while ($val = $query->fetch()) {
        $tab[$i] = $val;
        $i++;
      }
      $tab[$i] = null;
      $query->closeCursor();

      return ($tab);
    } catch (PDOException $e) {
      $ret = "";
      $ret['error'] = $e->getMessage();
      return ($ret);
    }
}

/*
function get_comments2($imgSrc) {
  include '../setup/database.php';

  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT c.comment, u.username FROM comment AS c, users AS u, gallery AS g WHERE g.img=:img AND g.id=c.galleryid AND c.userid=u.id");
      $query->execute(array(':img' => $imgSrc));

      $i = 0;
      $tab = "";
      while ($val = $query->fetch()) {
        $tab[$i] = $val;
        $i++;
      }
      $tab[$i] = null;
      $query->closeCursor();

      return ($tab);
    } catch (PDOException $e) {
      $ret = "";
      $ret['error'] = $e->getMessage();
      return ($ret);
    }
}
*/

function get_userinfo_from_montage($imgSrc) {
  include '../setup/database.php';

  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT mail, username FROM users, gallery WHERE gallery.img=:img AND users.id=gallery.userid");
      $query->execute(array(':img' => $imgSrc));

      $val = $query->fetch();
      $query->closeCursor();

      return ($val);
    } catch (PDOException $e) {
      $ret = "";
      $ret['error'] = $e->getMessage();
      return ($ret);
    }
}


function get_like($uid, $img) {
  include '../setup/database.php';
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT type FROM `like`, gallery WHERE `like`.userid=:userid AND `like`.galleryid=gallery.id AND gallery.img=:img");
      $query->execute(array(':userid' => $uid, ':img' => $img));
      $val = $query->fetch();
      $query->closeCursor();
      return ($val);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function get_nb_likes($img) {
  include './setup/database.php';
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT type FROM `like`, gallery WHERE `like`.galleryid=gallery.id AND gallery.img=:img AND `like`.type='L'");
      $query->execute(array(':img' => $img));

      $count = 0;
      while ($val = $query->fetch()) {
        $count++;
      }
      $query->closeCursor();
      return ($count);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function get_nb_dislikes($img) {
  include './setup/database.php';
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT type FROM `like`, gallery WHERE `like`.galleryid=gallery.id AND gallery.img=:img AND `like`.type='D'");
      $query->execute(array(':img' => $img));

      $count = 0;
      while ($val = $query->fetch()) {
        $count++;
      }
      $query->closeCursor();
      return ($count);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function get_nb_dislikes2($img) {
  include '../setup/database.php';
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT type FROM `like`, gallery WHERE `like`.galleryid=gallery.id AND gallery.img=:img AND `like`.type='D'");
      $query->execute(array(':img' => $img));

      $count = 0;
      while ($val = $query->fetch()) {
        $count++;
      }
      $query->closeCursor();
      return ($count);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}


function get_nb_likes2($img) {
  include '../setup/database.php';
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT type FROM `like`, gallery WHERE `like`.galleryid=gallery.id AND gallery.img=:img AND `like`.type='L'");
      $query->execute(array(':img' => $img));

      $count = 0;
      while ($val = $query->fetch()) {
        $count++;
      }
      $query->closeCursor();
      return ($count);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

?>