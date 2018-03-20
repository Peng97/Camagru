<?

session_start();

include_once '../setup/database.php';

$split = split("/", $_POST['data']);
$data = "../userphoto/".$split[4];
$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query= $dbh->prepare("SELECT userid, id FROM gallery WHERE img=:img");
$query->execute(array(':img' =>  $data));

$val = $query->fetch();

$query->closeCursor();


$val['is_owner'] = ($val['userid'] == $_SESSION['id']);
$val['imgpath'] = $data;
$val['username'] = $_SESSION['username'];

print_r ($val);
?>