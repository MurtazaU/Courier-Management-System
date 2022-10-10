<?php

//php_spreadsheet_export.php

include 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

include('./assets/modules/dbconnection.php');


$query = "SELECT * FROM package ORDER BY PackageId DESC";

$statement = $con->prepare($query);

$statement->execute();

$result = $statement->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST["export"])) {
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
    foreach ($result as $row) {
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

        $count = $count + 1;
    }

    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, $_POST["file_type"]);

    $file_name = time() . '.' . strtolower($_POST["file_type"]);

    $writer->save($file_name);

    header('Content-Type: application/x-www-form-urlencoded');

    header('Content-Transfer-Encoding: Binary');

    header("Content-disposition: attachment; filename=\"" . $file_name . "\"");

    readfile($file_name);

    unlink($file_name);

    exit;
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Export Data From Mysql to Excel using PHPSpreadsheet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>

<body>
    <div class="container">
        <br />
        <h3 align="center">Export Data From Mysql to Excel using PHPSpreadsheet</h3>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <form method="post">
                    <div class="row">
                        <div class="col-md-6">User Data</div>
                        <div class="col-md-4">
                            <select name="file_type" class="form-control input-sm">
                                <option value="Xlsx">Xlsx</option>
                                <option value="Xls">Xls</option>
                                <option value="Csv">Csv</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="submit" name="export" class="btn btn-primary btn-sm" value="Export" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br />
    <br />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</body>

</html>