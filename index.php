<?php
include_once("src/config.php");
include_once("src/account.php");

// login the user if login form was send and no user is currently logged in
if (isset($_POST["username"], $_POST["password"], $_POST["action"]) && !is_loggedin() && strtolower($_POST["action"]) == "login") {
    login($_POST["username"], $_POST["password"]);
}

// logout if the action was send
if (isset($_POST["action"]) && strtolower($_POST["action"]) == "logout") {
    logout();
}

if (isset($_POST["username"], $_POST["password"], $_POST["action"]) && strtolower($_POST["action"]) == "new_user") {
    new_user($_POST["username"], $_POST["password"]);
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
                        <input type="hidden" name="action" value="logout"/>
                        <input type="submit" value="Logout"/>
                    </form><?php
                } else {
                    ?><form id="login" action="" method="post" ajax="true">
                    <input type="hidden" name="action" value="login"/>
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
                    $mysqli = new_mysqli();

                    $stmt = $mysqli->prepare("SELECT u.`id`,  u.`username`, r.`role` FROM `user` as u, `user_roles` as r WHERE u.`user_role_id` = r.`id`;");
                    $stmt->execute();
                    $res = $stmt->get_result();
                    
                    echo "<table>"
                        ."<tr><th>Username</th><th>Role</th></tr>";
                    while ($row = $res->fetch_assoc()) {
                        echo "<tr><td>".$row["username"]."</td><td>".$row["role"]."</td></tr>";
                    }
                    echo "</table>";

                    $res->close();
                    $stmt->close();

                    if (is_loggedin()) {
                        ?>
                        <form action="" method="post" ajax="true">
                            <input type="hidden" name="action" value="new_user"/>
                            <input type="text" name="username" placeholder="username"/>
                            <input type="password" name="password" placeholder="password"/>
                            <input type="submit" value="New User"/>
                        </form>
                        <?php
                    }

                    $mysqli->close();
                ?>
            </div>
        </div>
        <div id="footer">
            <div class="wrapper">
                <?php
                    if (is_loggedin()) {
                        echo "<pre>GET\n";
                            print_r($_GET);
                        echo "</pre>";
                        echo "<pre>POST\n";
                            print_r($_POST);
                        echo "</pre>";
                        echo "<pre>SESSION\n";
                            print_r($_SESSION);
                        echo "</pre>";
                    }
                ?>
            </div>
        </div>
    </body>
</html>