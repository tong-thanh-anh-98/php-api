<?php
error_reporting(0);

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Content-Control-Allow-Method: GET');
header('Content-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

include('function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "POST") {
    # code...
    $inputData = json_decode(file_get_contents("php://input"), true);

    if (empty($inputData)) {
        # code...
        $storeCustomer = storeCustomer($_POST);
    } else {
        # code...
        $storeCustomer = storeCustomer($inputData);
    }

    echo $storeCustomer;
} else {
    # code...
    $data = [
        'status' => 405,
        'message' => $requestMethod. ' Method not allowed',
    ];

    header("HTTP/1.0 405 Method not allowed");
    echo json_encode($data);
}
