<?php
	session_start();
	include_once("setter.php");

	define('UPLOAD_DIR', '../userphoto/');
	$img = $_POST['snapData'];
	$img = str_replace('data:image/png;base64,', '', $img);  //format base64 ... 
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = UPLOAD_DIR . uniqid() . '.png';
	file_put_contents($file, $data);
	echo $_SESSION['id'];
	
	add_montage($_SESSION['id'], $file);
	// save to database.. 
?>
