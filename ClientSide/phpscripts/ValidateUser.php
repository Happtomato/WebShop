<?php

class ValidateUser
{
function isValid(){

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

    $userEmail = $_POST['email'];
    $userPassword = $_POST['password'];

    $sql = "SELECT password FROM useraccounts WHERE email $userEmail";
    $result = $conn->query($sql);

    $conn->close();

    if ($userPassword === $result) {
        return true;
    } else {
        return false;
    }

}

function signIn(){

    if($this->isValid()){

    }
}
}