<?php

$servername = "mysql";
$username = "user1";
$password = "s123";
$db_name = "reg";

// Connection
 $conn = new mysqli($servername,
    $username, $password, $db_name);

// For checking if connection is
// successful or not
if ($conn->connect_error) {
    die("Connection failed: "
        . $conn->connect_error);
}
