<?php
session_start();
if(isset($_SESSION['login_user']))
$username = $_SESSION['login_user'];

?>