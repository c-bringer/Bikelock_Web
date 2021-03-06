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
    $selectModels = "SELECT `id_brand`, `model` FROM `model_motorcycles`";
    $selectModelsStmt = $db->prepare($selectModels);
    $selectModelsStmt->execute();
    $rows = $selectModelsStmt->fetchAll(PDO::FETCH_ASSOC);

    $models = array();

    foreach($rows as $row) {
        array_push($models, $row);
    }

    $returnData = msg(1, 201, "SUCCESS", array($models) );
} catch(PDOException $e) {
    $returnData = msg(0, 500, $e->getMessage());
}

echo json_encode($returnData);