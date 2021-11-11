<?php

class ValidateUser{

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

function getUserID()
{

    if ($this->isValid()) {
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

        $sql = "SELECT user_ID FROM useraccounts WHERE email ";
        $result = $conn->query($sql);

        $conn->close();

        return $result;
    }
    echo "error";
    return "";
}
}