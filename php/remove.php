<?

session_start();

include_once '../setup/database.php';

$path = $_POST['path'];
$id = $_POST['id'];

unlink($path);
$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query= $dbh->prepare("DELETE FROM gallery WHERE img=:img");
$query->execute(array(':img' =>  $path));
$query->closeCursor();

$query= $dbh->prepare("DELETE FROM comment WHERE galleryid=:galleryid");
$query->execute(array(':galleryid' => $id));
$query->closeCursor();

$query= $dbh->prepare("DELETE FROM upvote WHERE galleryid=:galleryid");
$query->execute(array(':galleryid' => $id));
$query->closeCursor();
?>