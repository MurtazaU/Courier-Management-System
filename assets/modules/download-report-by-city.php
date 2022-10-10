<?php
// Auto Load
include '../../vendor/autoload.php';
// SpreadSheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// DB Connection
include('./dbconnection.php');

// Getting Value
$value = $_POST['download-report-city-wise'];

// SQL Query
$sql = $con->prepare('select * from package where PackageRegistrationCity = ?');
$sql->bindParam(1, $value);
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
$active_sheet->setCellValue('R1', 'Package Registraion City');

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

    $active_sheet->getColumnDimension('S')
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
