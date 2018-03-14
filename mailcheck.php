<?php
session_start();
include_once './php/verify.php';
?>
<!doctype html>
<html lang="en">
    <?php include('html/header.html') ?>
<body>
<div>
    <?php include('html/menu.html') ?>
    <?php if (verify($_GET["token"]) == 1) { ?>
        <div class="text-box pure-u-1 pure-u-md-1-2 pure-u-lg-2-3">
            <div class="l-box">
                <p class="text-box-subhead">Account verified</a></p>
                <p class="text-box-subhead">You can now <a href="index.php">connect</a></a></p>
            </div>
        </div>
    <?php } else { ?>
        <div class="text-box pure-u-1 pure-u-md-1-2 pure-u-lg-2-3">
            <div class="l-box">
                <p class="text-box-subhead">Account not found, you are maybe at the wrong place?</a></p>
                <p class="text-box-subhead">Maybe you want to <a href="register.php">register</a> or <a href="index.php">connect</a> </a></p>
            </div>
        </div>
    <?php } ?>
</div>
</body>
</HTML>
