<?php 
include('../assets/modules/dbconnection.php');

$sql = $con->prepare("delete from agent where AgentId = ?");
$sql -> bindParam(1, $_GET['agent-id']);
$sql -> execute();

header("location: ./agent.php");

?>