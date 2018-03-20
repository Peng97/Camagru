<?
session_start();

include_once '../setup/database.php';

	$img_id = $_POST['img_id'];

	$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$query= $dbh->prepare("SELECT userid FROM upvote WHERE galleryid=:galleryid AND userid=:userid ");
	$query->execute(array(':galleryid' => $img_id ,  'userid' => $_SESSION['id']));
	 $val = $query->fetch();
	$query->closeCursor();

	 	if (isset($val['userid']))
		{
			$query= $dbh->prepare("DELETE FROM upvote WHERE galleryid=:galleryid AND userid=:userid ");
			$query->execute(array(':galleryid' => $img_id ,  'userid' => $_SESSION['id']));
			$query->closeCursor();
			echo -1;
		} else {
			$query= $dbh->prepare("INSERT INTO upvote(userid,galleryid) VALUES(:userid, :galleryid) ");
			$query->execute(array(':userid' => $_SESSION['id'], ':galleryid' => $img_id ));
			$query->closeCursor();
			echo 1;
      	}

?>