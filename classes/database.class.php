<?php

class Database
{

    public function connect()
    {
        try {
            $username = "root";
            $password = "";
            $database = new PDO('mysql:host=localhost;dbname=bd_duomenu_baze', $username, $password);
            return $database;
        } catch (PDOException $exc) {
            print "Error!: " . $exc->getMessage() . "<br>";
            die();
        }
    }

    public function mysqli() 
    {
        try {
            $mysqli = new mysqli("localhost", "root", "", "bd_duomenu_baze");
            return $mysqli;
        } catch (mysqli_sql_exception $exc) {
            print "Error!: " . $exc->getMessage() . "<br>";
            die();
        }

    }
}
