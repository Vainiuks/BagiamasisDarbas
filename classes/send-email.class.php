<?php

require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'PHPMailer/src/Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class EmailSender {

    
    public function sendEmail($productsArr) {
        $mail = new PHPMailer;
        // if(!empty($productsArr) {
            try {
                //Server settings
                $mail->CharSet = 'UTF-8';
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
                $mail->isSMTP(true);                                            
                $mail->Host       = 'smtp.gmail.com';                   
                $mail->SMTPAuth   = true;                                   
                $mail->Username   = 'vainius.daraskevicius@gmail.com';                     
                $mail->Password   = 'wbwsjvhugarfdkec';                              
                $mail->SMTPSecure = 'ssl';            
                $mail->Port       = 465;                                    
            
                $mail->setFrom('vainius.daraskevicius@gmail.com');
                $mail->addAddress('vainius.daraskevicius@gmail.com');     
            
                $orderPrice = 0;
                $cartCount = count($productsArr);
                $counter = 0;
     
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = "Automobilio dalių užsakymo čekis";
                $mail->Body    = "Jūsų užsakymas yra priimtas!<br>5 darbo dienų bėgyje, pristatysime Jūsų užsakymą<br><br>"
                 . "<b>Jūsų krepšelis:</b>"
                 . "<table style='border-collapse: collapse; border: 1px solid;'> "
                 . "<tr style='border-collapse: collapse; border: 1px solid;'> "
                 . "<th style='border-collapse: collapse; border: 1px solid;'>Paveiksliukas</th>"
                 . "<th style='border-collapse: collapse; border: 1px solid;'>Prekės pavadinimas</th>"
                 . "<th style='border-collapse: collapse; border: 1px solid;'>Kaina</th>"
                 . "<th style='border-collapse: collapse; border: 1px solid;'>Kiekis</th>"
                 . "<th style='border-collapse: collapse; border: 1px solid;'>Galutinė prekės kaina</th>"
                 . "</tr>";
                 foreach($productsArr as $product => $value) {
                    $mail->Body .=
                    "<tr style='border-collapse: collapse; border: 1px solid;'>"
                    . "<td style='border-collapse: collapse; border: 1px solid;'><img src='cid:imageName' alt='' border=3 height=50 width=50</img></td>"
                    . "<td style='border-collapse: collapse; border: 1px solid;'>" . $value['product_Name'] . "</td>" 
                    . "<td style='border-collapse: collapse; border: 1px solid;'>" . $value['product_Price'] . "€</td>" 
                    . "<td style='border-collapse: collapse; border: 1px solid;'>" . $value['quantity'] . "</td>" 
                    . "<td style='border-collapse: collapse; border: 1px solid;'>" . $value['product_Price'] * $value['quantity'] . "€</td>";
                    $orderPrice += $value['product_Price'] * $value['quantity'];
                    $mail->addEmbeddedImage(dirname(__FILE__) .  $value['productImage'], 'imageName');
                    $counter++;
                    
                    $mail->Body .= "</tr>";
                }
                $mail->Body .= "</table>";
                if($counter == $cartCount) {
                    $mail->Body .= "<br><hr>"
                    . "<p>Sumokėta suma už užsakymą: <b>" . $orderPrice . " €</b></p>";
                }
    
                // $lol =  
                $mail->send();
                //  return $lol;
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        // }
    }
}













