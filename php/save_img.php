<?php
	session_start();

	function save_montage($userId, $imgPath) {
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


	define('UPLOAD_DIR', '../userphoto/');
	$img = $_POST['data'];
	$img = str_replace('data:image/png;base64,', '', $img);  //format base64 ... 
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = UPLOAD_DIR . uniqid() . '.png';
	file_put_contents($file, $data);
	echo $_SESSION['id'];
	
	save_montage($_SESSION['id'], $file);
	// save to database.. 
?>
