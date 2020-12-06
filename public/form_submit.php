<?php

require_once('app/Message.php');
function saveData($Message)
{
    // ***
    // Please update database connection before test
    // ***
    $servername = "localhost";
    $username = "root";
    $password = "So@5576550";
    $dbname = "test";
    // ***

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        return("Connection failed: " . $conn->connect_error);
    }
    $Message->saveMessage($conn);
    // close mysql connection
    $conn->close();
}

if($_POST){
    $Message = new App\Message();

    // Set customer name
    if(isset($_POST['name'])) {
        $Message->setName($_POST['name']);
    }

    // Set customer email
    if(isset($_POST['email'])) {
        $Message->setEmail($_POST['email']);
    }

    // Set customer phone
    if(isset($_POST['phone'])) {
        $Message->setPhone($_POST['phone']);
    }

    // Set Message
    if(isset($_POST['message'])) {
        $Message->setMessage($_POST['message']);
    }

    echo $Message->sendEmail();

    echo saveData($Message);
    
}

echo '<div><a href="index.html">Back to last page</a></div>';