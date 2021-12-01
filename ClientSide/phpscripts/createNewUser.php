<?php

function createUser($userName, $userPreName, $userBirthday, $userCountry, $userAdress, $userEmail, $userPassword, $userZip)
{
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

    $sql = "INSERT INTO useraccounts (Name, PreName, Birthday, Country, Adress, Email, Password, zip)
VALUES ('$userName','$userPreName', '$userBirthday','$userCountry','$userAdress','$userEmail','$userPassword','$userZip')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
