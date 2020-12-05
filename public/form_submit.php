<?php
function sendEmail($recipient = "guy-smiley@example.com", $name, $email, $email_body)
{
    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $email . "\r\n";

    $email_title = 'Customer Message From '.$name;
      
    if(mail($recipient, $email_title, $email_body, $headers)) {
        return "<p>Thank you for contacting Guy Smiley , $name.</p>";
    } else {
        return '<p>We are sorry but the email did not go through.</p>';
    }
}

function saveData($name, $email, $phone, $message)
{
    $servername = "localhost";
    $username = "ken";
    $password = "So@5576550";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    return "Connected successfully";
}

if($_POST){
    $name = "";
    $email = "";
    $phone = "";
    $message = "";
    $recipient = "guy-smiley@example.com";

    // Start Email Body
    $email_body = "<div>";

    if(isset($_POST['name'])) {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Customer Name:</b></label>&nbsp;<span>".$name."</span>
                        </div>";
    }
 
    if(isset($_POST['email'])) {
        $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $email_body .= "<div>
                           <label><b>Customer Email:</b></label>&nbsp;<span>".$email."</span>
                        </div>";
    }

    if(isset($_POST['phone'])) {
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
        $phone = preg_replace('/[^0-9]/', '', $phone);
        $email_body .= "<div>
                           <label><b>Customer Phone Number:</b></label>&nbsp;<span>".$phone."</span>
                        </div>";
    }

    if(isset($_POST['message'])) {
        $message = htmlspecialchars($_POST['message']);
        $email_body .= "<div>
                           <label><b>Visitor Message:</b></label>
                           <div>".$message."</div>
                        </div>";
    }

    // End email body
    $email_body .= "</div>";

    $return_message = sendEmail($recipient, $name, $email, $email_body);
    echo $return_message;

    $return_message2 = saveData($name, $email, $phone, $message);
    echo $return_message2;
    // Test email output
    //var_dump($email_body);
    //var_dump($recipient);
    //var_dump($email_title);
}

echo '<div><a href="index.html">Back to last page</a></div>';