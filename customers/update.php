<?php
error_reporting(0);

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Content-Control-Allow-Method: PUT');
header('Content-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

include('function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "PUT") {
    # code...
    $inputData = json_decode(file_get_contents("php://input"), true);

    if (empty($inputData)) {
        # code...
        $updateCustomer = updateCustomer($_POST, $_GET);
    } else {
        # code...
        $updateCustomer = updateCustomer($inputData, $_GET);
    }

    echo $updateCustomer;
} else {
    # code...
    $data = [
        'status' => 405,
        'message' => $requestMethod. ' Method not allowed',
    ];

    header("HTTP/1.0 405 Method not allowed");
    echo json_encode($data);
}
