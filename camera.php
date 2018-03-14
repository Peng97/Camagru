<?php
session_start();
?>
<!doctype html>
<html lang="en">
    <?php include('html/header.html') ?>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<body>
<?php include('html/menu.html') ?>
    <div class="pure-u-1">
        <div>
        	<?php if (!isset($_SESSION['id'])){ ?>
        		<h3 style="text-align: center; padding-top: 20%;"> You need to be connected ! </h3>
        	<?php } else { ?>
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
                        <button id="close" class="pure-button pure-button-primary">Close</button>
                    </p>
                    <video width="300" height="225"></video>
                    <canvas width="300" height="225"></canvas>
                </div>
                <script src="js/cam.js"></script>
            </div>
        </div>
        <?php } ?>
    </div>
<?php include('html/footer.html') ?>
</body>
</html>