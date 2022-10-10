<?php
// DB Connection
include('./dbconnection.php');
// Auto Load
include '../../vendor/autoload.php';
// SpreadSheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// Alignment Class
use PhpOffice\PhpSpreadsheet\Style\Alignment;
// Fille Class
use PhpOffice\PhpSpreadsheet\Style\Fill;

// Getting Value
$city = $_POST['download-report-city-wise'];

// Sender Email Id
// Country Id
// Weight Class id
// Product Type Id
// Agent Id
// Franchise Id
// Delivery Service Id


$sql = $con->prepare('select * from package where PackageRegistrationCity =  ? ');
$sql->bindParam(1, $city);
$sql->execute();
$data = $sql->fetchAll(PDO::FETCH_OBJ);

// Create Class
$file = new Spreadsheet();

// Get Active Sheet
$active_sheet = $file->getActiveSheet();


// Heading
$active_sheet->setCellValue('A1', 'Couriers');
$active_sheet->mergeCells("A1:S1");
$active_sheet->getStyle("A1")->getFont()->setSize(30);
$active_sheet->getStyle("A1")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


// Header Text
$active_sheet->setCellValue('A2', 'Package Id');
$active_sheet->setCellValue('B2', 'Package Sender Email');
$active_sheet->setCellValue('C2', 'Package Receiver Name');
$active_sheet->setCellValue('D2', 'Package Receiver Number');
$active_sheet->setCellValue('E2', 'Package Sender Address');
$active_sheet->setCellValue('F2', 'Package Receiver Address');
$active_sheet->setCellValue('G2', 'Package Receiver Zip Code');
$active_sheet->setCellValue('H2', 'Package Receiver City');
$active_sheet->setCellValue('I2', 'Package Receiver Country');
$active_sheet->setCellValue('J2', 'Package Code');
$active_sheet->setCellValue('K2', 'Package Weight Class');
$active_sheet->setCellValue('L2', 'Package Product Type');
$active_sheet->setCellValue('M2', 'Package Agent Email');
$active_sheet->setCellValue('N2', 'Package Franchise');
$active_sheet->setCellValue('O2', 'Package Delivery Service Type');
$active_sheet->setCellValue('P2', 'Package Status');
$active_sheet->setCellValue('Q2', 'Package Registration Date');
$active_sheet->setCellValue('R2', 'Package Delivery Date');
$active_sheet->setCellValue('S2', 'Package Registration City');

// Table Header Styling
$tableHead = [
    'font' => [
        'color' => [
            'rgb' => 'FFFFFF'
        ],
        'bold' => true,
        'size' => 15
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'f46711'
        ],
    ],
];

// Header Background Color
$active_sheet->getStyle("A2:S2")->applyFromArray($tableHead);

$count = 3;

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
    $active_sheet->setCellValue('R' . $count, $row->PackageDateDelivered);
    $active_sheet->setCellValue('S' . $count, $row->PackageRegistrationCity);

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
