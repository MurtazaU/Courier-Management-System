<?php

// 4 Variables
$dbname = 'courierms';
$host = "localhost";
$username = "root";
$password = "";

try {
  $con = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
