<?php
session_start();
?>
<!doctype html>
<html lang="en">
<!doctype html>
<html lang="en">
    <?php include('html/header.html') ?>
<body>
<?php include('html/menu.html') ?>

<div class="pure-u-1">
    <div style="padding-top: 20%;">
        <h3 style="text-align: center;"> Forgot your password ? </h3>
        <h3 style="text-align: center;"> Don't worry ! </h3>
        <div class="posts">
            <section class="post center">
                <div class="pure-u-1 form-box">
                    <form method="post" class="pure-form pure-form-aligned" action="php/forgot.php">

                        <?php  if(isset($_SESSION['error']))
                                {
                                    echo $_SESSION['error'];
                                    $_SESSION['error'] = null;
                                }
                                if(isset($_SESSION['success']))
                                {
                                    $_SESSION['success'] = null;
                                    echo "A mail has been send";
                                }
                         ?>

                        <fieldset>
                            <h2> Enter your mail <address></address> </h2>
                            <div class="pure-control-group">
                                <input id="email" name="email" type="email" placeholder="Email Address">
                            </div>
                            <div>
                                <button type="submit" name="submit" value="send" class="pure-button pure-button-primary">Submit</button>
                            </div>
                        </fieldset>
                        <?php include('html/footer.html') ?>
                    </form>
                </div>
            </section>
        </div>
</div>
</body>
</html>