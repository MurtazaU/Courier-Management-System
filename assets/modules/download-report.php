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
$value = $_POST['download-report-date-wise'];
$city = $_POST['download-report-city-wise'];

// Defaul Variables
$count = 3;


// Sender Email Id
$customer = $con->prepare('select CustomerId, CustomerEmail from customer');
$customer->execute();
$customerRecord = $customer->fetchAll(PDO::FETCH_OBJ);
// Country Id
$country = $con->prepare('select CountryId, CountryName from country');
$country->execute();
$countryRecord = $country->fetchAll(PDO::FETCH_OBJ);
// Weight Class id
$weight = $con->prepare('select WeightClassId, WeightClassName from weightclass');
$weight->execute();
$weightRecord = $weight->fetchAll(PDO::FETCH_OBJ);
// Product Type Id
$productType = $con->prepare('select ProductTypeId, ProductTypeName from producttype');
$productType->execute();
$productTypeRecord = $productType->fetchAll(PDO::FETCH_OBJ);
// Agent Id
$agent = $con->prepare('select AgentId, AgentEmail from agent');
$agent->execute();
$agentRecord = $agent->fetchAll(PDO::FETCH_OBJ);
// Franchise Id
$franchise = $con->prepare('select FranchiseId, FranchiseName from franchise');
$franchise->execute();
$franchiseRecord = $franchise->fetchAll(PDO::FETCH_OBJ);
// Delivery Service Id
$deliveryService = $con->prepare('select DeliveryServiceId, DeliveryServiceName from deliveryservice');
$deliveryService->execute();
$deliveryServiceRecord = $deliveryService->fetchAll(PDO::FETCH_OBJ);


// Date Variables
$today = date('Y-m-d');
$days7 = date('Y-m-d', strtotime('-7 days'));
$days14 = date('Y-m-d', strtotime('-14 days'));
$days30 = date('Y-m-d', strtotime('-30 days'));

// Conditions
if ($value == 1) {
    $sql = $con->prepare('select * from package where PackageDateReceived >= ? && PackageRegistrationCity = ? ');
    $sql->bindParam(1, $today);
    $sql->bindParam(2, $city);
    $sql->execute();
}
if ($value == 2) {
    $sql = $con->prepare('select * from package where PackageDateReceived >=  ?  && PackageRegistrationCity = ?');
    $sql->bindParam(1, $days7);
    $sql->bindParam(2, $city);
    $sql->execute();
}
if ($value == 3) {
    $sql = $con->prepare('select * from package where PackageDateReceived >=  ? && PackageRegistrationCity = ? ');
    $sql->bindParam(1, $days14);
    $sql->bindParam(2, $city);
    $sql->execute();
}
if ($value == 4) {
    $sql = $con->prepare('select * from package where PackageDateReceived >=  ? && PackageRegistrationCity = ? ');
    $sql->bindParam(1, $days30);
    $sql->bindParam(2, $city);
    $sql->execute();
}

// All Time
if ($value == 5) {
    $sql = $con->prepare('select * from package where PackageRegistrationCity = ? ');
    $sql->bindParam(1, $city);
    $sql->execute();
}
// All Cities
if ($city == 1) {
    if ($value == 1) {
        $sql = $con->prepare('select * from package where PackageDateReceived >= ?');
        $sql->bindParam(1, $today);
        $sql->execute();
    }
    if ($value == 2) {
        $sql = $con->prepare('select * from package where PackageDateReceived >= ?');
        $sql->bindParam(1, $days7);
        $sql->execute();
    }
    if ($value == 3) {
        $sql = $con->prepare('select * from package where PackageDateReceived >= ?');
        $sql->bindParam(1, $days14);
        $sql->execute();
    }
    if ($value == 4) {
        $sql = $con->prepare('select * from package where PackageDateReceived >= ?');
        $sql->bindParam(1, $days30);
        $sql->execute();
    }
    if ($value == 5) {
        $sql = $con->prepare('select * from package');
        $sql->execute();
    }
}



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


// Printing Data through loop
foreach ($data as $row) {
    // Customer Loop
    foreach ($customerRecord as $customer) {
        if ($customer->CustomerId == $row->PackageSenderId) {
            $customerEmail = $customer->CustomerEmail;
        }
    }
    // Country Loop
    foreach ($countryRecord as $country) {
        if ($country->CountryId == $row->PackageReceiverCountry) {
            $countryReceiver = $country->CountryName;
        }
    }
    // Weight Loop
    foreach ($weightRecord as $weight) {
        if ($weight->WeightClassId == $row->PackageWeightId) {
            $weightClass = $weight->WeightClassName;
        }
    }
    // Product Type Loop
    foreach ($productTypeRecord as $type) {
        if ($type->ProductTypeId == $row->PackageProductTypeId) {
            $productType = $type->ProductTypeName;
        }
    }
    // Agent Loop
    foreach ($agentRecord as $agent) {
        if ($agent->AgentId == $row->PackageAgentId) {
            $agentEmail = $agent->AgentEmail;
        }
    }
    // Franchise Loop
    foreach ($franchiseRecord as $franchise) {
        if ($franchise->FranchiseId == $row->PackageFranchiseId) {
            $franchiseName = $franchise->FranchiseName;
        }
    }
    // Delivery Service Loop
    foreach ($deliveryServiceRecord as $delivery) {
        if ($delivery->DeliveryServiceId == $row->PackageDeliveryServiceId) {
            $deliveryName = $delivery->DeliveryServiceName;
        }
    }

    $active_sheet->setCellValue('A' . $count, $row->PackageId);
    $active_sheet->setCellValue('B' . $count, $customerEmail);
    $active_sheet->setCellValue('C' . $count, $row->PackageReceiverName);
    $active_sheet->setCellValue('D' . $count, $row->PackageReceiverNumber);
    $active_sheet->setCellValue('E' . $count, $row->PackageFromAddress);
    $active_sheet->setCellValue('F' . $count, $row->PackageToAddress);
    $active_sheet->setCellValue('G' . $count, $row->PackageReceiverZipCode);
    $active_sheet->setCellValue('H' . $count, $row->PackageReceiverCity);
    $active_sheet->setCellValue('I' . $count, $countryReceiver);
    $active_sheet->setCellValue('J' . $count, $row->PackageCode);
    $active_sheet->setCellValue('K' . $count, $weightClass);
    $active_sheet->setCellValue('L' . $count, $productType);
    $active_sheet->setCellValue('M' . $count, $agentEmail);
    $active_sheet->setCellValue('N' . $count, $franchiseName);
    $active_sheet->setCellValue('O' . $count, $deliveryName);
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
