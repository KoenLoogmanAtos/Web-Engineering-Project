<?php
include_once("config.php");

function new_msqli() {
    $config = $GLOBALS["_CONFIG"];
    return new mysqli($config["sql_uri"], $config["sql_username"], $config["sql_password"], $config["sql_database"]);
}
?>