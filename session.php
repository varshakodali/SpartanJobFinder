<?php
session_start();
$id = "";
if(isset($_SESSION['login_user'])) {
	$username = $_SESSION['login_user'];

    $error = "";
    $con = new PDO("mysql:host=localhost;dbname=test","root", "sesame");
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $ps = $con->prepare("SELECT ID FROM applicant WHERE Email = :email");

    $vars = array(':email' => $username);
    $ps->execute($vars);
    $data = $ps->fetchAll(PDO::FETCH_ASSOC); 

    if(sizeof($data) > 0) {

        foreach($data as $row){
            foreach ($row as $key => $value) {
                $id =  $value;
            }                           
        } 
    }           
}

?>