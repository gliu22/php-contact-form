<?php

require_once('app/Message.php');
function saveData($Message)
{
    // ***
    // Please update database connection before test form submission
    // ***
    $servername = "localhost";
    $username = "root";
    $password = "So@5576550";
    $dbname = "test_db";
    // *** !!!important

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

    echo '<div><a href="index.html">Back to last page</a></div>';
    // Set customer name
    if(isset($_POST['name'])) {
        if(!$Message->setName($_POST['name'])){
            echo '<div style="color:red">Name is invalid! Send Email Failed.</div>';
            exit();
        }
    }

    // Set customer email
    if(isset($_POST['email'])) {
        if(!$Message->setEmail($_POST['email'])){
            echo '<div style="color:red">Email is invalid! Send Eamil Failed.</div>';
            exit();
        }
    }

    // Set customer phone
    if(isset($_POST['phone'])) {
        $Message->setPhone($_POST['phone']);
    }

    // Set Message
    if(isset($_POST['message'])) {
        $Message->setMessage($_POST['message']);
    }

    // unable to test this part in local machine
    echo $Message->sendEmail();

    echo saveData($Message);
    
}

