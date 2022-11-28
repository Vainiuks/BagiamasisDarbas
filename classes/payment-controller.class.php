<?php
require_once 'cart.class.php';

class PaymentController extends Cart
{

    private $first_Name;
    private $last_Name;
    private $email_Address;
    private $phone_Number;
    private $city;
    private $home_Address;

    public function __construct($first_Name, $last_Name, $email_Address, $city, $home_Address, $phone_Number)
    {
        $this->first_Name = $first_Name;
        $this->last_Name = $last_Name;
        $this->email_Address = $email_Address;
        $this->city = $city;
        $this->home_Address = $home_Address;
        $this->phone_Number = $phone_Number;
    }

    public function checkPaymentInput()
    {
        if ($this->inputHandling() == false) {
            header("location: ../payment.php?error=emptyfields");
            exit();
        }

        if ($this->emailHandling() == false) {
            header("location: ../payment.php?error=wrongemail");
            exit();
        }

        $cart = new Cart();
        $this->formatReceipt($this->first_Name, $this->last_Name, $this->email_Address, $this->city, $this->home_Address, $this->phone_Number);


    }

    private function inputHandling()
    {
        $result;

        if (empty($this->first_Name) || empty($this->last_Name) || empty($this->email_Address) || empty($this->phone_Number) || empty($this->city)|| empty($this->home_Address)) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

   private function emailHandling()
    {
        $result;

        if (!filter_var($this->email_Address, FILTER_VALIDATE_EMAIL) ? $result = false : $result = true);

        return $result;
    } 
}
