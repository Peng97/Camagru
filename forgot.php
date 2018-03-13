<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example that shows off a blog page with a list of posts.">
    <title>Password forgot &ndash; Camagru </title>
    
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">
    <link rel="stylesheet" href="css/blog.css">

</head>
<body>

<div id="layout" class="pure-g">
    <div class="sidebar pure-u-1 pure-u-md-1-4">
        <div class="header">
            <h2 class="brand-tagline">Password forgot ?</h2>
            <h2 class="brand-tagline"> Do not worry :) </h2>
        </div>
    </div>

    <div class="content pure-u-1 pure-u-md-3-4">
        <div>
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
                                <div class="pure-controls">
                                    <button type="submit" name="submit" value="send" class="pure-button pure-button-primary">Submit</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </section>

          <?php include('html/footer.html') ?>
        </div>
    </div>
</div>
</body>
</html>