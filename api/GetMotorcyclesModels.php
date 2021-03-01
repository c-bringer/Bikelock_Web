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

//If request method is not post
if($_SERVER["REQUEST_METHOD"] != "POST") {
    $returnData = msg(0, 404, 'Page introuvable');
}

//Checking empty fields
else if(!isset($data->model)) {
        $fields = ['fields' => ['model']];
        $returnData = msg(0, 422, 'ALL_INPUT_INCOMPLETE', $fields);
    }

//If there are no empty fields then
else {
    $model = trim($data->model);

    try {
        $selectModels = "SELECT model
                        FROM model_motorcycles AS MM, brand_motorcycles AS BM
                        WHERE BM.brand = :model
                        AND BM.id = MM.id_brand";
        $selectModelsStmt = $db->prepare($selectModels);

        //Data binding
        $selectModelsStmt->bindValue(':model', $model, PDO::PARAM_STR);

        $selectModelsStmt->execute();
        $rows = $selectModelsStmt->fetchAll(PDO::FETCH_ASSOC);

        $models = array();

        foreach($rows as $row) {
            array_push($models, $row["model"]);
        }

        $returnData = msg(1, 201, "SUCCESS", array($models) );
    } catch(PDOException $e) {
        $returnData = msg(0, 500, $e->getMessage());
    }
}

echo json_encode($returnData);