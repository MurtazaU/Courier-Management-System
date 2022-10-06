<?php 
include('../assets/modules/dbconnection.php');

$sql = $con-> prepare('delete from package where PackageId = ?');
$sql -> bindParam(1, $_GET['courier-id']);

$sql -> execute();

header('location: ./courier.php');


?>