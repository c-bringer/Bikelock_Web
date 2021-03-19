<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

function msg($success, $status, $message, $extra = [])
{
    return array_merge([
        'success' => $success,
        'status' => $status,
        'code' => $message
    ], $extra);
}

//Including database and making object
require __DIR__.'/config/Database.php';

$database = new Database();
$db = $database->getConnection();

//Get data
$data = json_decode(file_get_contents("php://input"));
$returnData = [];

try {
    $selectYears = "SELECT `year` FROM `year_motorcycles`";
    $selectYearsStmt = $db->prepare($selectYears);
    $selectYearsStmt->execute();
    $rows = $selectYearsStmt->fetchAll(PDO::FETCH_ASSOC);

    $years = array();

    foreach($rows as $row) {
        array_push($years, $row["year"]);
    }

    $returnData = msg(1, 201, "SUCCESS", array($years) );
} catch(PDOException $e) {
    $returnData = msg(0, 500, $e->getMessage());
}

echo json_encode($returnData);