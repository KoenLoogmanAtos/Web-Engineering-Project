<?php
// start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// include database functions
include_once("database.php");

/**
 * Logs out the current user.
 * @return boolean true if successfully logged out false if not
 */
function logout() {
    if (is_loggedin()) {
        unset($_SESSION["username"]);
        return true;
    } else {
        return false;
    }
}

/**
 * Logs in a user.
 * 
 * @param string $username of the user.
 * @param string $password of the user.
 * 
 * @return boolean true if login was successful and false if not.
 */
function login(string $username, string $password) {
    $msqli = new_mysqli();
    
    // Check connection
    if ($msqli->connect_errno) {
        echo "Failed to connect to MySQL: ".$msqli->connect_error;
    }

    // prepare statement to obtain the hashed password
    $stmt = $msqli->prepare("SELECT `password` FROM `user` WHERE `username` LIKE ?;");
    $stmt->bind_param("s", $username);

    // get hashed password
    $stmt->execute();
    $res = $stmt->get_result();
    $hashed_password = null;
    if ($row = $res->fetch_assoc()) {
        $hashed_password = $row["password"];
    }

    // close db connection
    $stmt->close();
    $res->close();
    $msqli->close();
    
    if ($hashed_password != null && password_verify($password, $hashed_password)) {
        // set username to session
        $_SESSION["username"] = $username;
        
        return true;
    } else {
        return false;
    }
}

/**
 * Checks if the username is in use or not.
 * 
 * @return boolean true if username is already in use and false if not
 */
function username_taken($username) {
    $msqli = new_msqli();

    // Check connection
    if ($msqli->connect_errno) {
        echo "Failed to connect to MySQL: ".$msqli->connect_error;
    }

    // prepare statement to check for the username
    $stmt = $msqli->prepare("SELECT `id` FROM `user` WHERE `username` LIKE ?;");
    $stmt->bind_param("s", $username);

    $id = null;
    $stmt->execute();
    $res = $stmt->get_result();
    if ($row = $res->fetch_assoc()) {
        $id = $row["id"];
    }

    // close db connection
    $stmt->close();
    $res->close();
    $msqli->close();

    // return true if found and false if not
    return ($id != null);
}

/**
 * Creates a new user.
 * 
 * @param string $username the name of the new user.
 * @param string $password the password for the new user.
 * 
 * @return boolean true if the creation was successful and false if not.
 */
function new_user(string $username, string $password) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $msqli = new_mysqli();

    // Check connection
    if ($msqli->connect_errno) {
        echo "Failed to connect to MySQL: ".$msqli->connect_error;
    }

    // prepare statement to check for the username
    $stmt = $msqli->prepare("INSERT INTO `user`(`username`, `password`) VALUES (?, ?);");
    $stmt->bind_param("ss", $username, $hashed_password);
    
    $success = $stmt->execute();
    
    // close db connection
    $stmt->close();
    $msqli->close();

    return $success;
}

/**
 * Checks if a user is currently logged in.
 * 
 * @return boolean true if the user is logged in and false if not.
 */
function is_loggedin() {
    return (isset($_SESSION["username"]) && $_SESSION["username"] != "" && $_SESSION["username"] != null);
}

/**
 * @return string name of the current user and null if no user is logged in.
 */
function username() {
    return isset($_SESSION["username"]) ? $_SESSION["username"] : null;
}
?>