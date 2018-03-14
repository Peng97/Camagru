<?php
	session_start();

	define('UPLOAD_DIR', '../userphoto/');
	$img = $_POST['snapData'];
	$img = str_replace('data:image/png;base64,', '', $img);  //format base64 ... 
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = UPLOAD_DIR . uniqid() . '.png';
	$success = file_put_contents($file, $data);


	// save to database.. 
?>
