<?php
header('Content-Type: application/json');

# DB connection here

# Fetch data according to request
$data = {"test"};

# Create JSON file
echo json_encode($data);

# DB close here
?>