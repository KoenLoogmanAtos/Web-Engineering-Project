<?php
header('Content-Type: application/json');

# DB connection here

# Fetch data according to request
$data = ["test1" => "test2"];

# Create JSON file
echo json_encode($data);

# DB close here
?>