<?php

include "ValidateUser.php";

$userID = getUserID();

$servername = "localhost";
$username = "root";
$password = "D0minik2005";
$dbname = "webshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$item = $_POST['itemName'];

$sql = "SELECT ItemQuantity FROM inventory WHERE ItemName $item";
$result = $conn->query($sql);

if($result > 0){
    $sql = "SELECT Item_ID FROM inventory WHERE ItemName $item";
    $result = $conn->query($sql);


    $sql = "INSERT INTO order (Order_ID, Item_ID)
    VALUES ('$userID','$result')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    exit;
}
else{
    echo "the item isn't available";
}


$result = $conn->query($sql);

$conn->close();



