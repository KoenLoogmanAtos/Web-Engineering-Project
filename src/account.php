<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once("database.php");

function logout() {
    if (is_loggedin()) {
        unset($_SESSION["username"]);
        return true;
    } else {
        return false;
    }
}

function login($username, $password) {
    $msqli = new_msqli();
    
    # Check connection
    if ($msqli->connect_errno) {
        echo "Failed to connect to MySQL: ".$msqli->connect_error;
    }

    # prepare statement to obtain the hashed password
    $stmt = $msqli->prepare("SELECT `password` FROM `user` WHERE `username` LIKE ?;");
    $stmt->bind_param("s", $username);

    # get hashed password
    $stmt->execute();
    $res = $stmt->get_result();
    $hashed_password = null;
    if ($row = $res->fetch_assoc()) {
        $hashed_password = $row["password"];
    }

    # close db connection
    $stmt->close();
    $res->close();
    $msqli->close();
    
    if ($hashed_password != null && password_verify($password, $hashed_password)) {
        # set username to session
        $_SESSION["username"] = $username;
        
        return true;
    } else {
        return false;
    }
}

function username_taken($username) {
    $msqli = new_msqli();

    # Check connection
    if ($msqli->connect_errno) {
        echo "Failed to connect to MySQL: ".$msqli->connect_error;
    }

    # prepare statement to check for the username
    $stmt = $msqli->prepare("SELECT `id` FROM `user` WHERE `username` LIKE ?;");
    $stmt->bind_param("s", $username);

    $id = null;
    $stmt->execute();
    $res = $stmt->get_result();
    if ($row = $res->fetch_assoc()) {
        $id = $row["id"];
    }

    # close db connection
    $stmt->close();
    $res->close();
    $msqli->close();

    # return true if found and false if not
    return ($id != null);
}

function new_user($username, $password) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $msqli = new_msqli();

    # Check connection
    if ($msqli->connect_errno) {
        echo "Failed to connect to MySQL: ".$msqli->connect_error;
    }

    # prepare statement to check for the username
    $stmt = $msqli->prepare("INSERT INTO `user`(`username`, `password`) VALUES (?, ?);");
    $stmt->bind_param("s", $username);
    $stmt->bind_param("s", $hashed_password);
    
    $success = $stmt->execute();
    
    # close db connection
    $stmt->close();
    $msqli->close();

    return $success;
}

function is_loggedin() {
    return (isset($_SESSION["username"]) && $_SESSION["username"] != "" && $_SESSION["username"] != null);
}

function username() {
    return isset($_SESSION["username"]) ? $_SESSION["username"] : null;
}
?>