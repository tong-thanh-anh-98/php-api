<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Content-Control-Allow-Method: GET');
header('Content-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

include('function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "GET") {
    # code...

    if (isset($_GET['id'])) {
        # code...
        $customer = getCustomer($_GET);
        echo $customer;

    } else {
        # code...
        $customerList = getCustomerList();
        echo $customerList;

    }
    
} else {
    # code...
    $data = [
        'status' => 405,
        'message' => $requestMethod. ' Method not allowed',
    ];

    header("HTTP/1.0 405 Method not allowed");
    echo json_encode($data);
}
