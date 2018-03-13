<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example that shows off a blog page with a list of posts.">
    <title>Register Page &ndash; Camagru </title>
    
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">
    <link rel="stylesheet" href="css/blog.css">

</head>
<body>

<div id="layout" class="pure-g">
    <div class="sidebar pure-u-1 pure-u-md-1-4">
        <div class="header">
            <h1 class="brand-title">Camagru</h1>
            <h2 class="brand-tagline">Share your photos montages</h2>

            <nav class="nav">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a class="pure-button" href="http://purecss.io">made with PureCSS</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="content pure-u-1 pure-u-md-3-4">
        <div>
            <div class="posts">
                <h3> Thanks you for chosen Camagru ! </h3>
            </div>

            <div class="posts">

                <section class="post center">
                    <div class="pure-u-1 form-box">
                        <form method="post" class="pure-form pure-form-aligned" action="php/register.php">

                            <?php  if(isset($_SESSION['error']))
                                    {
                                        echo $_SESSION['error'];
                                        $_SESSION['error'] = null;
                                    }
                             ?>

                            <fieldset>
                                <div class="pure-control-group">
                                    <label for="name">Username</label>
                                    <input id="username" name="username" type="text" placeholder="Username">
                                </div>

                                <div class="pure-control-group">
                                    <label for="password">Password</label>
                                    <input id="password" name="password" type="password" placeholder="Password">
                                </div>

                                <div class="pure-control-group">
                                    <label for="email">Email Address</label>
                                    <input id="email" name="email" type="email" placeholder="Email Address">
                                </div>

                                <div class="pure-controls">
                                <span class="pure-form-message-inline">A confimation mail will be send for finalise register.</span> 

                                    <label for="cb" class="pure-checkbox">
                                        <input id="cb" type="checkbox"> I've read <a href="#">the terms and conditions</a>
                                    </label>
                                    <button type="submit" name="submit" value="send" class="pure-button pure-button-primary">Submit</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </section>
            <div class="footer">
                &ndash; Made by fpeng with PureCss for school project.
            </div>
        </div>
    </div>
</div>




</body>
</html>