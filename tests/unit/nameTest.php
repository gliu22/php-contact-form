<?php
require_once('public/app/Message.php');
class nameTest extends \PHPUnit\Framework\TestCase
{
    public function testName()
    {
        $Message = new App\Message;

        $Message->setName('Ken');
        $this->assertEquals($Message->getName(),'Ken');
    }

    public function testEmail()
    {
        $Message = new App\Message;

        $Message->setEmail('Ken@ken.com');
        $this->assertEquals($Message->getEmail(),'Ken@ken.com');
    }

    public function testPhone()
    {
        $Message = new App\Message;

        $Message->setPhone('1234567890');
        $this->assertEquals($Message->getPhone(),'1234567890');
    }

    public function testMessage()
    {
        $Message = new App\Message;

        $Message->setMessage('Hello Ken!');
        $this->assertEquals($Message->getMessage(),'Hello Ken!');
    }

    public function testDefaultRecipient()
    {
        $Message = new App\Message;
        $this->assertEquals($Message->getRecipient(),'guy-smiley@example.com');
    }

    public function testSetRecipient()
    {
        $Message = new App\Message;
        $Message->setRecipient('kenken@ken.com');
        $this->assertEquals($Message->getRecipient(),'kenken@ken.com');
    }

    public function testEmailBody()
    {
        $Message = new App\Message;
        $Message->setEmailBody('Name','Ken');
        $this->assertEquals($Message->getEmailBody(),'<div><div><label><b>Name:</b></label>&nbsp;<span>Ken</span></div></div>');
    }
}