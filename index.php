<?php
include_once("src/config.php");
include_once("src/database.php");
include_once("src/account.php");

// login the user if login form was send and no user is currently logged in
if (isset($_POST["username"], $_POST["password"]) && !is_loggedin()) {
    login($_POST["username"], $_POST["password"]);
}

// logout if the action was send
if (isset($_POST["action"]) && strtolower($_POST["action"]) == "logout") {
    logout();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
        <title><?php echo $_CONFIG["page_title"]; ?></title>
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/main.js"></script>
    </head>
    <body>
        <div id="header">
            <div class="wrapper">
                <?php

                if (is_loggedin()) {
                    ?><form id="logout" action="" method="post" ajax="true">
                        <input type="hidden" value="Logout" name="action"/>
                        <input type="submit" value="Logout"/>
                    </form><?php
                } else {
                    ?><form id="login" action="" method="post" ajax="true">
                        <input type="text" placeholder="username" name="username"/>
                        <input type="password" placeholder="password" name="password"/>
                        <input type="submit" value="Login"/>
                    </form><?php
                }
                
                ?>
            </div>
        </div>
        <div id="content">
            <div class="wrapper">
                <?php
                    if (is_loggedin()) {
                        echo "Hello ".username()."!";
                    }
                ?>
            </div>
        </div>
        <div id="footer">
            <div class="wrapper">
                Footer
            </div>
        </div>
    </body>
</html>