<?php
// include config
include_once("config.php");

/**
 * Opens a new mysqli connection with the in the config.php defined login information.
 * 
 * @return mysqli mysqli object with the connection to the database.
 */
function new_msqli() {
    // get config data
    $config = $GLOBALS["_CONFIG"];

    // return the mysqli object
    return new mysqli($config["sql_uri"], $config["sql_username"], $config["sql_password"], $config["sql_database"]);
}
?>