<?php
// Auto Load
include '../../vendor/autoload.php';
// SpreadSheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// DB Connection
include('./dbconnection.php');

// Getting Value
$value = $_POST['download-report-date-wise'];

// Date Variables
$today = date('Y-m-d');
$days7 = date('Y-m-d', strtotime('-7 days'));
$days14 = date('Y-m-d', strtotime('-14 days'));
$days30 = date('Y-m-d', strtotime('-30 days'));

// Conditions
if ($value == 1) {
    $sql = $con->prepare('select * from package where PackageDateReceived >= ? ');
    $sql->bindParam(1, $today);
}
if ($value == 2) {
    $sql = $con->prepare('select * from package where PackageDateReceived >=  ? ');
    $sql->bindParam(1, $days7);
}
if ($value == 3) {
    $sql = $con->prepare('select * from package where PackageDateReceived >=  ? ');
    $sql->bindParam(1, $days14);
}
if ($value == 4) {
    $sql = $con->prepare('select * from package where PackageDateReceived >=  ? ');
    $sql->bindParam(1, $days30);
}

if ($value == 5) {
    $sql = $con->prepare('select * from package ');
}

$sql->execute();
$data = $sql->fetchAll(PDO::FETCH_OBJ);

// Create Class
$file = new Spreadsheet();

// Get Active Sheet
$active_sheet = $file->getActiveSheet();

// Setting values
$active_sheet->setCellValue('A1', 'Package Id');
$active_sheet->setCellValue('B1', 'Package Sender Email');
$active_sheet->setCellValue('C1', 'Package Receiver Name');
$active_sheet->setCellValue('D1', 'Package Receiver Number');
$active_sheet->setCellValue('E1', 'Package Sender Address');
$active_sheet->setCellValue('F1', 'Package Receiver Address');
$active_sheet->setCellValue('G1', 'Package Receiver Zip Code');
$active_sheet->setCellValue('H1', 'Package Receiver City');
$active_sheet->setCellValue('I1', 'Package Receiver Country');
$active_sheet->setCellValue('J1', 'Package Code');
$active_sheet->setCellValue('K1', 'Package Weight Class');
$active_sheet->setCellValue('L1', 'Package Product Type');
$active_sheet->setCellValue('M1', 'Package Agent Email');
$active_sheet->setCellValue('N1', 'Package Franchise');
$active_sheet->setCellValue('O1', 'Package Delivery Service Type');
$active_sheet->setCellValue('P1', 'Package Status');
$active_sheet->setCellValue('Q1', 'Package Registration Date');
$active_sheet->setCellValue('R1', 'Package Delivery Date');

$count = 2;

// Printing Data through loop
foreach ($data as $row) {
    $active_sheet->setCellValue('A' . $count, $row->PackageId);
    $active_sheet->setCellValue('B' . $count, $row->PackageSenderId);
    $active_sheet->setCellValue('C' . $count, $row->PackageReceiverName);
    $active_sheet->setCellValue('D' . $count, $row->PackageReceiverNumber);
    $active_sheet->setCellValue('E' . $count, $row->PackageFromAddress);
    $active_sheet->setCellValue('F' . $count, $row->PackageToAddress);
    $active_sheet->setCellValue('G' . $count, $row->PackageReceiverZipCode);
    $active_sheet->setCellValue('H' . $count, $row->PackageReceiverCity);
    $active_sheet->setCellValue('I' . $count, $row->PackageReceiverCountry);
    $active_sheet->setCellValue('J' . $count, $row->PackageCode);
    $active_sheet->setCellValue('K' . $count, $row->PackageWeightId);
    $active_sheet->setCellValue('L' . $count, $row->PackageProductTypeId);
    $active_sheet->setCellValue('M' . $count, $row->PackageAgentId);
    $active_sheet->setCellValue('N' . $count, $row->PackageFranchiseId);
    $active_sheet->setCellValue('O' . $count, $row->PackageDeliveryServiceId);
    $active_sheet->setCellValue('P' . $count, $row->PackageStatus);
    $active_sheet->setCellValue('Q' . $count, $row->PackageDateReceived);
    $active_sheet->setCellValue('R' . $count, $row->PackageDateReceived);
    $active_sheet->setCellValue('S' . $count, $row->PackageDateDelivered);
    $active_sheet->setCellValue('T' . $count, $row->PackageRegistrationCity);

    $count = $count + 1;
    // Making columns auto size
    $active_sheet->getColumnDimension('A')
        ->setAutoSize(true);
    $active_sheet->getColumnDimension('B')
        ->setAutoSize(true);
    $active_sheet->getColumnDimension('C')
        ->setAutoSize(true);
    $active_sheet->getColumnDimension('D')
        ->setAutoSize(true);
    $active_sheet->getColumnDimension('E')
        ->setAutoSize(true);
    $active_sheet->getColumnDimension('F')
        ->setAutoSize(true);
    $active_sheet->getColumnDimension('G')
        ->setAutoSize(true);
    $active_sheet->getColumnDimension('H')
        ->setAutoSize(true);
    $active_sheet->getColumnDimension('I')
        ->setAutoSize(true);
    $active_sheet->getColumnDimension('J')
        ->setAutoSize(true);
    $active_sheet->getColumnDimension('K')
        ->setAutoSize(true);
    $active_sheet->getColumnDimension('L')
        ->setAutoSize(true);
    $active_sheet->getColumnDimension('M')
        ->setAutoSize(true);
    $active_sheet->getColumnDimension('N')
        ->setAutoSize(true);
    $active_sheet->getColumnDimension('O')
        ->setAutoSize(true);
    $active_sheet->getColumnDimension('P')
        ->setAutoSize(true);
    $active_sheet->getColumnDimension('Q')
        ->setAutoSize(true);
    $active_sheet->getColumnDimension('R')
        ->setAutoSize(true);
    $active_sheet->getColumnDimension('S')
        ->setAutoSize(true);
    $active_sheet->getColumnDimension('T')
        ->setAutoSize(true);
}

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, "Xlsx");

$file_name = 'Report.xlsx';

$writer->save($file_name);

header('Content-Type: application/x-www-form-urlencoded');

header('Content-Transfer-Encoding: Binary');

header("Content-disposition: attachment; filename=\"" . $file_name . "\"");

readfile($file_name);

unlink($file_name);

exit;
