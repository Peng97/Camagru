<?php
session_start();
?>
<!doctype html>
<html lang="en">
    <?php include('html/header.html') ?>
<body>
<?php include('html/menu.html') ?>

<div class="pure-u-1">
    <div style="padding-top: 10%;">
        
        <?php if(isset($_SESSION['id'])) {  ?>
                <h3 style="text-align: center;">You are connected as <?php print_r(htmlspecialchars($_SESSION['username'])); ?> </p>
                <h3 style="text-align: center;">Now you have full access of <a href="gallery.php" style="color: black;">Camagru</a></p>
                <h3 style="text-align: center;"><a href="gallery.php" style="color: black;">Take a selfie ?</a></p>

        <?php } else { ?>

        <h3 style="text-align: center;"> Thanks you for chosen Camagru ! </h3>
        <h3 style="text-align: center;"> You need to be connected to use Camagru </h3>
        <div class="form-box">
            <form method="post" class="pure-form pure-form-aligned" action="php/login.php">

                <?php
                        if(isset($_SESSION['error']))
                        {
                            echo $_SESSION['error'];
                            $_SESSION['error'] = null;
                        }
                        if ($_SESSION['signup_success'] == true)
                        {
                            echo "Almost done, final step check your mail box";
                            $_SESSION['signup_success'] = null;
                        }
                 ?>


                <fieldset>
                    <div class="pure-control-group">
                        <input id="username" name="username" type="text" placeholder="Username">
                <!--        <span class="pure-form-message-inline">This is a required field.</span> -->
                    </div>

                    <div class="pure-control-group">
                        <input id="password" name="password" type="password" placeholder="Password">
                    </div>
                    <div>
                        <button type="submit" name="submit" value="y" class="pure-button pure-button-primary">
                            Connect
                        </button>
                    </div>
                    <div><a href="register.php" style="color: black;">New ? Go to register page.</a></div>
                    <div><a href="forgot.php" style="color: black;">forgot your password ?</a></div>
                    <?php } ?>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php include('html/footer.html') ?>
</body>
</html>
