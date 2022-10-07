<?php 
include('../assets/modules/dbconnection.php');

// Deleting User
$sql = $con -> prepare('delete from customer where CustomerId = ?');
$sql -> bindParam(1, $_GET['customer-id']);
$sql -> execute();

header("location: ./customer.php");

?>

