<?php
require_once 'database.class.php';
session_start();

class Login extends Database
{

    protected function getUser($username, $password)
    {
        $prepareStmt = $this->connect()->prepare('SELECT user_Password FROM users WHERE user_Username = ? OR user_Email = ?;');

        if (!$prepareStmt->execute(array($username, $password))) {
            $prepareStmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($prepareStmt->rowCount() == 0) {
            $prepareStmt = null;
            header("location: ../login.php?error=usernotfound");
            exit();
        }

        $hashedPassword = $prepareStmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPassword = password_verify($password, $hashedPassword[0]["user_Password"]);

        if ($checkPassword == false) {
            $prepareStmt = null;
            header("location: ../login.php?error=wrongpassword&username=" . $username);
            exit();
        } elseif ($checkPassword == true) {
           
            $prepareStmt = $this->connect()->prepare('SELECT * FROM users WHERE user_Username = ? OR user_Email = ? AND user_Password = ?;');

            if (!$prepareStmt->execute(array($username, $username, $password))) {
                $prepareStmt = null;
                header("location: ../login.php?error=stmtfailed");
                exit();
            }

            if ($prepareStmt->rowCount() == 0) {
                $prepareStmt = null;
                header("location: ../login.php?error=usernotfound");
                exit();
            }

            $user = $prepareStmt->fetchAll(PDO::FETCH_ASSOC);

            $_SESSION['userID'] = $user[0]["userID"];
            $_SESSION['username'] = $user[0]["user_Username"];
            $_SESSION['userType'] = $user[0]['user_Type'];
            $_SESSION['userEmail'] = $user[0]['user_Email'];
            $_SESSION['isAbleToComment'] = $user[0]['is_Able_To_Comment'];
            $_SESSION['logged'] = 'Yes';

            $prepareStmt = null;
        }

        $prepareStmt = null;
    }

}




