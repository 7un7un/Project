<?php
require_once('../../database/connect.php');
$id = $_GET['id'];
$sql = "DELETE FROM post WHERE id ='".$id."'";
$stmt = $con->prepare($sql);
$stmt->execute();
header('location:../user/user-page.php');
?>
