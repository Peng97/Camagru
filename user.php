<?php
session_start();
?>
<!doctype html>
<html lang="en">
    <?php include('html/header.html') ?>
<body>
<div>
    <?php include('html/menu.html') ?>
    <div class="content pure-u-1 pure-u-md-4-4">
        <div>
        	<?php if (!isset($_SESSION['id'])){ ?>
        		<h3 style="text-align: center;padding-top: 20%;"> You need to be connected ! </h3>
        	<?php } else { ?>
            <div class="pure-u-1 form-box" style="padding-top: 10%;">
                <form method="post" class="pure-form pure-form-aligned" action="php/modify.php">
                	<?php
                            if(isset($_SESSION['error']))
                            {
                                echo $_SESSION['error'];
                                $_SESSION['error'] = null;
                            }
                    ?>
                    <fieldset>
                    	<h3 style="color: black;"> Old password is requird if you want to change other param</h3>
                    	<div class="pure-control-group">
                            <input id="old_password" name="old_password" type="password" placeholder="Old Password"> 
                        </div>
                        <p style="color: black;"> Fill only those you want to change</p>
                        <p style="color: black;"> Once setting successfuly changed, you will need to relog</p>
                        <div class="pure-control-group">
                            <input id="username" name="username" type="text" placeholder="Username">
                        </div>
                        <div class="pure-control-group">
                            <input id="new_password" name="new_password" type="password" placeholder="New Password">
                        </div>
                        <div class="pure-control-group">
                            <input id="mail" name="mail" type="email" placeholder="Email">
                        </div>
                        <div>
                            <button type="submit" name="submit" value="y" class="pure-button pure-button-primary">
                                Modify
                            </button>
                        </div>
                    </fieldset>
                </form>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php include('html/footer.html') ?>
</div>
</body>
</html>