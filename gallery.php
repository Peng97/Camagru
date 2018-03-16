<?php
session_start();

include_once("php/getter.php");
include_once("php/setter.php");

$imagePerPages = 12;
$montages = get_montages(0, $imagePerPages);
$more = false;
$lastMontageId = 0;
if ($montages != "" && array_key_exists("more", $montages)) {
  $more = true;
  $lastMontageId = $montages[count($montages) - 2]['id'];
}
?>

<!doctype html>
<html lang="en">
    <?php include('html/header.html') ?>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<body>
<div>
    <?php include('html/menu.html') ?>
<!--
        <div class="photo-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-3"> for 1/3
         <div class="photo-box photo-box-thin pure-u-1 pure-u-lg-2-3"> for 2/3

        <aside class="photo-box-caption">
                <span>by <a href="http://www.dillonmcintosh.tumblr.com/">Dillon McIntosh</a></span>
        </aside>    for comment;
-->
    <div class="pure-g">
        <?php
            for ($i = 0; $montages[$i] && $i < $imagePerPages; $i++) {
                echo  " <div id=\"icon\" class=\"photo-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-3\">
                            <img class=\"sizing\" src=". $montages[$i]['img']. ">
                            <aside class=\"photo-box-caption\">
                                ". "5" ." LIKE
                            </aside> 
                        </div>

                ";
            }
        ?>
    </div>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <img id="img_modal" class="sizing" style="padding-top: 2vmin;">
        <div class="pure-u-1">
                    <h2 id="like" class="like"> </h2>
                    <div class="comment_list">
                    <p> user : c'est de la merde kkk?</p>
                    <p> user : c'est de la merde kkk?</p>
                    <p> user : c'est de la merde kkk?</p>
                    <p> user : c'est de la merde kkk?</p>
                    </div>
                    <div style="padding-top: 3vmin;">
                        <?php if(isset($_SESSION['id'])){ ?>
                            <textarea id="comment" class="comment" maxlength="100" placeholder="Your comment here, maxlength is 100."></textarea>
                            <img id="send" class="send" src=img/send.png> 
                        <?php } else { ?>
                            <h3 style="text-align: center;">Connect to comment</h3> 
                    </div>
                    <script type="text/javascript" src="js/modal.js"></script>

            <?php } ?>

        </div>



    </div>
</div>
<?php include('html/footer.html') ?>
</div>

</body>
</html>
