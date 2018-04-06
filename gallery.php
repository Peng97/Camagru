<?php
session_start();
include_once("php/get_picture.php");
$montages = get_picture(0, 6 + number_format($_SESSION['count']));
?>

<!doctype html>
<html lang="en">
    <?php include('html/header.html') ?>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<body>
<div>
    <?php include('html/menu.html') ?>

    <div class="pure-g">
        <?php
            for ($i = 0; $montages[$i] && $i < 6 + $_SESSION['count']; $i++) {
                echo  " <div id=\"icon\" class=\"photo-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-3\">
                            <img class=\"sizing\" src=". $montages[$i]['img']. ">
                        </div>
                ";
            }
        ?>
    </div>

    <div style="padding: 5vmin;"> <h3 >
        <a href="#" id="more"> More </a>  
        <a href="#" id="less"> Less </a>  
    </h3></div>
    
    <!-- The Modal -->
    <div id="myModal" class="modal">
      <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
                        <a href="#" id="remove" class="remove">Remove</a>

            <img id="img_modal" class="sizing" style="padding-top: 2vmin;">
            <div class="pure-u-1">

                        <h3 id="like" class="like" style="color: black; padding-top: 1vmin"></h3>
                        <div id="comment_list" class="comment_list">
                        </div>
                        <div style="padding-top: 3vmin;">
                            <?php if(isset($_SESSION['id'])){ ?>
                                <textarea id="comment" class="comment" maxlength="100" placeholder="Your comment here, maxlength is 100."></textarea>
                                <img id="send" class="send" src=img/send.png> 
                            <?php } else { ?>
                                <h3 style="text-align: center;">Connect to add a comment</h3> 
                        </div>

                <?php } ?>
            </div>
        </div>
    </div>




    <script type="text/javascript" src="js/modal.js"></script>

<?php include('html/footer.html') ?>
</div>

</body>
</html>
