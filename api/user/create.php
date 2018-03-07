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
 
// instantiate database and user object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$user = new User($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set user property values
$user->username = $data->username;
$user->password = password_hash($data->password, PASSWORD_DEFAULT);
$user->created = date('Y-m-d H:i:s');
 
// create the user
if($user->create()) {
    echo json_encode(
        array("message" => "User was created.")
    );
} else {
    echo json_encode(
        array("message" => "Unable to create user.")
    );
}
?>