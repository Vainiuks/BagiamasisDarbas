<?php

class Signup extends Database
{

    protected function setUser($username, $password, $email)
    {
        $prepareStmt = $this->connect()->prepare('INSERT INTO users(user_Username, user_Password, user_Email, user_Type, is_Able_To_Comment) VALUES(?,?,?,?,?);');

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if (!$prepareStmt->execute(array($username, $hashedPassword, $email, "User", "Yes"))) {
            $prepareStmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $prepareStmt = null;
    }

    protected function checkUser($username, $email)
    {
        $prepareStmt = $this->connect()->prepare('SELECT user_Username FROM users WHERE user_Username = ? OR user_Email = ?;');

        if (!$prepareStmt->execute(array($username, $email))) {
            $prepareStmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $results;
        if ($prepareStmt->rowCount() > 0) {
            $results = false;
        } else {
            $results = true;
        }

        return $results;
    }
}
