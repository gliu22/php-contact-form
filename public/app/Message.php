<?php
namespace App;

class Message{
    // customer name
    private $name;

    // customer email address
    private $email;

    // customer phone number
    private $phone;

    // customer message body
    private $content;

    // customer email recipient
    private $recipient;

    // customer email body
    protected $email_body;

    function __construct() {
        $this->recipient = "guy-smiley@example.com";
        $this->email_body = '<div>';
        $this->phone = 'N/A';
        $this->content = '';
        $this->email = 'N/A';
        $this->name = 'N/A';
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getConent()
    {
        return $this->content;
    }

    public function getMessage()
    {
        return $this->content;
    }

    public function getRecipient()
    {
        return $this->recipient;
    }

    public function setName($name)
    {
        $this->name = filter_var($name, FILTER_SANITIZE_STRING);
        if(strlen($this->getName()) == 0){
            return false;
        }
        $this->setEmailBody('Customer Name', $this->getName());
        return true;
    }

    public function setEmail($email)
    {
        $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $email);
        $this->email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if($this->getEmail() == false){
            return false;
        }
        $this->setEmailBody('Customer Email', $this->getEmail());
        return true;
    }

    public function setPhone($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        $this->phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        $this->setEmailBody('Customer Phone', $this->getPhone());
    }

    public function setMessage($message)
    {
        $this->content = htmlspecialchars($message);
        $this->setEmailBody('Message', $this->getMessage());
    }

    public function setEmailBody($name, $value)
    {
        $this->email_body .= "<div><label><b>".$name.":</b></label>&nbsp;<span>".$value."</span></div>";
    }

    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
    }

    public function getEmailBody()
    {
        return $this->email_body."</div>";
    }

    // have test plan with 
    // function setUp() { $this->db->exec("BEGIN"); }
    // function tearDown() { $this->db->exec("ROLLBACK"); }
    // but will failed phpunit command if does not change database configuration
    // so leave it for now 
    public function saveMessage($conn)
    {
        // thie query also included in public folder
        $sql = "CREATE TABLE IF NOT EXISTS message_log(
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(50) NOT NULL,
                email VARCHAR(50),
                phone VARCHAR(20),
                message TEXT,
                created_by TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )";
    
        if ($conn->query($sql) === TRUE) {
            $sql2 = "INSERT INTO message_log (name, email, phone, message) VALUES('".$this->getName()."','".$this->getEmail()."','".$this->getPhone()."','".$this->getMessage()."')";
            $conn->query($sql2);
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // unable to test this part in local machine
    public function sendEmail($recipient = "guy-smiley@example.com")
    {
        $this->setRecipient($recipient);
        // build header of email
        $headers  = 'MIME-Version: 1.0' . "\r\n"
        .'Content-type: text/html; charset=utf-8' . "\r\n"
        .'From: ' . $this->getEmail() . "\r\n";

        // build title of email
        $email_subject = 'Customer Message From '.$this->getName();

        // send email
        if(mail($this->getRecipient(), $email_subject, $this->getEmailBody(), $headers)) {
            return "<p>Thank you for contacting Guy Smiley , ".$this->getName()."</p>";
        } else {
            return '<p>We are sorry but the email did not go through.</p>';
        }
    }
}