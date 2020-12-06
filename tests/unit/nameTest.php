<?php
require_once('public/app/Message.php');
class nameTest extends \PHPUnit\Framework\TestCase
{
    // Test Message class name setter and getter
    public function testName()
    {
        $Message = new App\Message;

        $Message->setName('Ken');
        $this->assertEquals($Message->getName(),'Ken');
    }

    // Test Message class email setter and getter
    public function testEmail()
    {
        $Message = new App\Message;

        $Message->setEmail('Ken@ken.com');
        $this->assertEquals($Message->getEmail(),'Ken@ken.com');
    }

    // Test Message class phone setter and getter
    public function testPhone()
    {
        $Message = new App\Message;

        $Message->setPhone('1234567890');
        $this->assertEquals($Message->getPhone(),'1234567890');
    }

    // Test Message class message setter and getter
    public function testMessage()
    {
        $Message = new App\Message;

        $Message->setMessage('Hello Ken!');
        $this->assertEquals($Message->getMessage(),'Hello Ken!');
    }

    // Test Message class recipient getter and setter
    public function testSetRecipient()
    {
        $Message = new App\Message;
        $Message->setRecipient('kenken@ken.com');
        $this->assertEquals($Message->getRecipient(),'kenken@ken.com');
    }

    // Test Message class email_body setter and getter
    public function testEmailBody()
    {
        $Message = new App\Message;
        $Message->setEmailBody('Name','Ken');
        $this->assertEquals($Message->getEmailBody(),'<div><div><label><b>Name:</b></label>&nbsp;<span>Ken</span></div></div>');
    }

    // Test Message class default recipient value
    public function testDefaultRecipient()
    {
        $Message = new App\Message;
        $this->assertEquals($Message->getRecipient(),'guy-smiley@example.com');
    }

    // Test Message class default message value
    public function testDefaultMessage()
    {
        $Message = new App\Message;
        $this->assertEquals($Message->getMessage(),'');
    }

    // Test Message class default phone value
    public function testDefaultPhone()
    {
        $Message = new App\Message;
        $this->assertEquals($Message->getPhone(),'N/A');
    }

    // Test Message class default name value
    public function testDefaultName()
    {
        $Message = new App\Message;
        $this->assertEquals($Message->getName(),'N/A');
    }

    // Test Message class default email value
    public function testDefaultEmail()
    {
        $Message = new App\Message;
        $this->assertEquals($Message->getEmail(),'N/A');
    }

    // Test Message class default email_body value
    public function testDefaultEmailBody()
    {
        $Message = new App\Message;
        $this->assertEquals($Message->getEmailBody(),'<div></div>');
    }

    // Test MEssage class name setter filter
    public function testNameFilter()
    {
        $Message = new App\Message;
        $Message->setName('<h1>Ken</h1>');
        $this->assertEquals($Message->getName(),'Ken');
    }

    // Test MEssage class name setter filter2
    public function testNameEmpty()
    {
        $Message = new App\Message;
        $Message->setName('<h1></h1>');
        $this->assertEquals($Message->getName(),'');
    }

    // Test MEssage class email setter filter
    public function testEmailFilter()
    {
        $Message = new App\Message;
        $Message->setEmail('ken@ken.com\n');
        $this->assertFalse($Message->getEmail());
    }

    // Test MEssage class phone setter filter
    public function testPhoneFilter()
    {
        $Message = new App\Message;
        $Message->setPhone('123-123-1234ababa');
        $this->assertEquals($Message->getPhone(),'1231231234');
    }

    // Test MEssage class phone setter filter2
    public function testPhoneEmpty()
    {
        $Message = new App\Message;
        $Message->setPhone('asdqwe-=-=');
        $this->assertEquals($Message->getPhone(),'');
    }
}