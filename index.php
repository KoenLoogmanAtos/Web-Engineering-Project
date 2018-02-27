<?php
include_once("src/config.php");
include_once("src/account.php");

if (isset($_POST["username"], $_POST["password"]) && !is_loggedin()) {
    login($_POST["username"], $_POST["password"]);
}

if (isset($_POST["action"]) && $_POST["action"] == "logout") {
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
        <title>Page Title</title>
        <script src="js/main.js"></script>
    </head>
    <body>
        <?php
            if (!is_loggedin()) {
        ?>
        <form action="" method="post">
            <input type="text" name="username"><br>
            <input type="password" name="password"><br>
            <input type="submit" value="Login">
        </form>
        <?php
            } else {
        ?>
        <form action="" method="post">
            <input type="hidden" name="action" value="logout">
            <input type="submit" value="Logout">
        </form>
        <?php
                echo "Hello ".username()."!";
            }

            if (username_taken("Admin")) {
                echo "Yes";
            } else {
                echo "No";
            }
        ?>
    </body>
</html>