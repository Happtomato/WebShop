<?php

session_start();

require_once("createNewUser.php");


$userName = $_POST['name'];
$userPreName = $_POST['preName'];
$userBirthday = $_POST['birthday'];
$userCountry = $_POST['country'];
$userAdress = $_POST['adress'];
$userEmail = $_POST['email'];
$userPassword = $_POST['passwd'];
$userZip = $_POST['zip'];

//create a new user
createUser($userName, $userPreName, $userBirthday, $userCountry,$userAdress, $userEmail, $userPassword, $userZip);

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

if(isset($_SESSION["cart_item"])) {
    echo "Session ist da";

    foreach ($_SESSION["cart_item"] as $item) {
        $itemName = $item["name"];
        $quantity = $item["quantity"];
        $datum = new DateTime();
        $date = $datum->format('Y-m-d H:i:s');

        echo "wird wiederholt";

        $sql = "INSERT INTO userOrders (Item_ID, User_ID, ItemQuantity, OrderDate, UserName)
            VALUES ('$itemName','$userName', '$quantity', '$date', '$userPreName')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }

        unset($_SESSION["cart_item"]);
}
    $conn->close();

header("Location: ../thankYou.html");


