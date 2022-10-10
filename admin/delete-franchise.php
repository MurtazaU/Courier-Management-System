<?php
include('../assets/modules/dbconnection.php');

// Main Id
$franchiseId = $_GET['franchise-id'];


// Delete From Agents
$agent = $con->prepare('delete from agent where AgentFranchiseId = ?');
$agent->bindParam(1, $franchiseId);
$agent->execute();

// Delete From Couriers
$courier = $con->prepare('delete from package where PackageFranchiseId = ?');
$courier->bindParam(1, $franchiseId);
$courier->execute();


// Deleting From Franchise
$sql = $con->prepare('delete from franchise where FranchiseId = ?');
$sql->bindParam(1, $franchiseId);
$sql->execute();

header('location: ./franchise.php');
