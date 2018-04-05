<?php
session_start();

$imagePerPages = 3;

if ($_POST['more'] == 1){
	$_SESSION['count'] += $imagePerPages;
} else {
	if (number_format($_SESSION['count']) > 0) {
		$_SESSION['count'] -= $imagePerPages;
	} 
}

echo $_SESSION['count'];
?>