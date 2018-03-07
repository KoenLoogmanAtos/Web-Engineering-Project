<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once("../config/database.php");
include_once("../objects/user.php");

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare user object
$user = new User($db);

// set ID property of user to be edited
$user->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of user to be edited
$user->read_one();

// create array
$user_arr = array(
    "id" =>  $user->id,
    "user_role_id" => $user->user_role_id,
    "username" => $user->username,
    "created" => $user->created
);

// make it json format
echo json_encode($user_arr);
?>