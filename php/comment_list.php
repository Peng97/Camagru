<?php

include '../setup/database.php';

   try {
      $img_id = $_POST['img_id'];

      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT * FROM comment WHERE galleryid=:galleryid");
      $query->execute(array(':galleryid' => $img_id));

      $i = 0;
      $usr = "";
      $comment = "";
      while ($val = $query->fetch()) {
      	$usr[$i] = $val['userid'];
      	$comment[$i] = $val['comment'];
        $i++;
      }
      $usr[$i] = null;
      $query->closeCursor();
      
		//now replace user id by username... use id to prevent "when user changing their username, we can still find the same user".

      $i = 0;
      $username = "";
      while ($usr[$i] != null)
      {
      	if (!isset( $username[ $usr[$i] ] ))
      	{
      		 $query = $dbh->prepare("SELECT username FROM users WHERE id=:id");
      		 $query->execute(array(':id' => $usr[$i]));
      		 $val = $query->fetch();
      		 $username[$usr[$i]] = $val['username'];
      		 $query->closeCursor();
      	}
      	$tab[$i] = $username[$usr[$i]] . " : " . $comment[$i];
      	$i++;
      }
      print_r($tab);
      $tab = null;
    } catch (PDOException $e) {
      $tab = null;
    	echo $e;
    }

?>