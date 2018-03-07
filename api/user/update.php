<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once("../config/database.php");
include_once("../objects/user.php");

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare user object
$user = new User($db);

// get id of user to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of user to be edited
$user->id = $data->id;

// set user property values
$user->username = $data->username;
$user->password = password_hash($data->password, PASSWORD_DEFAULT);

// update the user
if($user->update()) {
    echo json_encode(
        array("message" => "User was updated.")
    );
} else {
    echo json_encode(
        array("message" => "Unable to updated user.")
    );
}
?>