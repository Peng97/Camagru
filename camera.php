<?php
session_start();

?>
<!doctype html>
<html lang="en">
    <?php include('html/header.html') ?>
<body>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<?php include('html/menu.html') ?>
        <div>
        	<?php if (!isset($_SESSION['id'])){ ?>
        		<h3 style="text-align: center; padding-top: 20%;"> You need to be connected ! </h3>
        	<?php } else { 
                include_once("php/get_picture.php");    
                
                $montages = get_user_picture();
            ?>


            <div class="pure-u-1 form-box">
                <form method="post" class="pure-form pure-form-aligned" action="php/modify.php">
                	<?php
                            if(isset($_SESSION['error']))
                            {
                                echo $_SESSION['error'];
                                $_SESSION['error'] = null;
                            }
                    ?>
                </form>
                <div class="pure-u-1" style="padding-top: 5%; padding-bottom: 10%">
                    <p>
                        <button id="dog" class="pure-button pure-button-primary">dog</button>
                        <button id="cat" class="pure-button pure-button-primary">cat</button>
                        <button id="fox" class="pure-button pure-button-primary">fox</button>
                    </p>
                    <p>
                        <button id="snap" class="pure-button pure-button-primary">Take</button>
                        <button id="upload" class="pure-button pure-button-primary">Upload</button>
                        <button id="clean" class="pure-button pure-button-primary">Clean</button>
                    </p>

                    <input type="file" onchange="previewFile()"><br>
                    <img id="upfile" src="" width="400" height="300" style="display:none;">

                    <video width="400" height="300"></video>
                    <canvas width="400" height="300"></canvas>
                </div>


                <div class="pure-g">
                    <?php
                        for ($i = 0; $montages[$i] && $i < $_SESSION['count'] + 6; $i++) {
                            echo  " <div id=\"icon\" class=\"photo-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-6\">
                                        <img class=\"sizing\" src=". $montages[$i]['img']. ">
                                    </div>
                            ";
                        }
                    ?>
                </div>

                <div style="padding: 3vmin;"> <h3>
                    <a href="#" id="more"> More </a>  
                    <a href="#" id="less"> Less </a>  
                </h3></div>


                <!-- The Modal -->

                <div id="myModal" class="modal">
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
                            <script type="text/javascript" src="js/modal.js"></script>
                        </div>

                    </div>
                </div>
            <script src="js/cam.js"></script>
        </div>
        <?php } ?>
    </div>
<?php include('html/footer.html') ?>
</body>
</html>