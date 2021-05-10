<?php
require_once('../../database/connect.php');

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$power = '2';

$sql = "INSERT INTO user (username, password, email, power) values ('".$username."' ,'".$password."' ,'".$email."' ,'".$power."')";
$stmt = $con->prepare($sql);
$stmt->execute();
header('location:../../index.php');
?>
