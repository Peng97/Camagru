<?

session_start();

include_once '../setup/database.php';

	try {
		$img_id = $_POST['img_id'];

		$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query= $dbh->prepare("SELECT userid FROM upvote WHERE galleryid=:galleryid ");
		$query->execute(array(':galleryid' => $img_id));

		$nb = 0;

		while ($val = $query->fetch())
			$nb++;
		$query->closeCursor();
		echo $nb;
	} catch (PDOException $e) {
     	echo ($e->getMessage());
    }
?>