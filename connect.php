<?php
             function connect_to_db(){
               $con = new PDO("mysql:host=localhost;dbname=test","root", "sesame");
               $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
               return $con;
             }
?>
