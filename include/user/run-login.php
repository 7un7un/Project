<?php
$username=$_POST['username'];
$password=$_POST['password'];

$conn = new mysqli('localhost', 'root', '', 'bytesoft');
$sql = "SELECT * FROM user WHERE username = '$username'";
$result = $conn->query($sql)->fetch_assoc();

if($result['password'] == $password)
{
	session_start();
	$_SESSION["username"] = $username;
	$_SESSION["power"] = $result['power'];
	header("location:user-page.php");
}
else
{
    header("location:err-login.php");
}
$conn->close();
?>
