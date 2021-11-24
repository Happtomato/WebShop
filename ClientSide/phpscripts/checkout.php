<?php


require_once("createNewUser.php");

$userName = $_POST['name'];
$userPreName = $_POST['preName'];
$userBirthday = $_POST['birthday'];
$userCountry = $_POST['country'];
$userAdress = $_POST['adress'];
$userEmail = $_POST['email'];
$userPassword = $_POST['password'];
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
    foreach ($_SESSION["cart_item"] as $item) {
        $item = $item["name"];

        $date = date("Y-m-d H:i:s");

        $sql = "INSERT INTO userOrders (Item_ID, User_ID, OrderDate)
            VALUES ('$item','$userName', '$date')";
    }
        unset($_SESSION["cart_item"]);
}
    $conn->close();

header("Location: ../index.html");


