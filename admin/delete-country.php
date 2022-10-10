<?php
include('../assets/modules/dbconnection.php');

// Main Id
$countryId = $_GET['country-id'];


// Deleting From country
$sql = $con->prepare('delete from country where countryId = ?');
$sql->bindParam(1, $countryId);
$sql->execute();

// Delete From Couriers
$courier = $con->prepare('delete from package where PackageReceiverCountry = ?');
$courier->bindParam(1, $countryId);
$courier->execute();


// Franchise
$check = $con->prepare('delete from franchise where FranchiseCountryId = ?');
$check->bindParam(1, $countryId);
$check->execute();




header('location: ./country.php');
