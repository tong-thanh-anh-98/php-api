<?php

require '../inc/connect-data.php';

function error422($message)
{
    $data = [
        'status' => 422,
        'message' => $message,
    ];

    header("HTTP/1.0 422 Unprocessable entity.");
    echo json_encode($data);
    exit();
}

function getCustomerList()
{
    global $connect;

    $query = "SELECT * FROM customers";
    $query_run = mysqli_query($connect, $query);

    if ($query_run) {
        # code...
        if (mysqli_num_rows($query_run) > 0) {
            # code...
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'Customer list fetched successfully',
                'data' => $res,
            ];
        
            header("HTTP/1.0 200 OK!");
            return json_encode($data);
        } else {
            # code...
            $data = [
                'status' => 404,
                'message' => 'No customer found',
            ];
        
            header("HTTP/1.0 404 No customer found");
            return json_encode($data);
        }
        
    } else {
        # code...
        $data = [
            'status' => 500,
            'message' => 'Internal server error',
        ];
    
        header("HTTP/1.0 500 Internal server error");
        return json_encode($data);
    }
    
}

function storeCustomer($customerInput)
{
    global $connect;

    $name = mysqli_real_escape_string($connect, $customerInput['name']);
    $email = mysqli_real_escape_string($connect, $customerInput['email']);
    $phone = mysqli_real_escape_string($connect, $customerInput['phone']);

    if (empty(trim($name))) {
        # code...
        return error422('Enter your name');

    } elseif (empty(trim($email))) {
        # code...
        return error422('Enter your email');

    } elseif (empty(trim($phone))) {
        # code...
        return error422('Enter your phone');

    } else {
        $query = "INSERT INTO customers (name, email, phone) VALUE ('$name', '$email', '$phone')";
        $result = mysqli_query($connect, $query);

        if ($result) {
            # code...
            $data = [
                'status' => 201,
                'message' => 'Customer created successfully!',
            ];
        
            header("HTTP/1.0 201 Created!");
            return json_encode($data);
            
        } else {
            # code...
            $data = [
                'status' => 500,
                'message' => 'Internal server error',
            ];
        
            header("HTTP/1.0 500 Internal server error");
            return json_encode($data);
        }

    }
    
}

function getCustomer($customerParams)
{
    global $connect;

    if ($customerParams['id'] == null) {
        # code...
        return error422('Enter your customer id?');
    } 

    $customerId = mysqli_real_escape_string($connect, $customerParams['id']);
    $query = "SELECT * FROM customers WHERE id='$customerId' LIMIT 1";
    $result = mysqli_query($connect, $query);
    
    if ($result) {
        # code...
        if (mysqli_num_rows($result) == 1) {
            # code...
            $res = mysqli_fetch_assoc($result);

            $data = [
                'status' => 200,
                'message' => 'Customer fetched successfully',
                'data' => $res,
            ];
        
            header("HTTP/1.0 200 OK!");
            return json_encode($data);
        } else {
            # code...
            $data = [
                'status' => 404,
                'message' => 'No customer found.',
            ];
        
            header("HTTP/1.0 404 Not found.");
            return json_encode($data);
        }
        
    } else {
        # code...
        $data = [
            'status' => 500,
            'message' => 'Internal server error',
        ];
    
        header("HTTP/1.0 500 Internal server error");
        return json_encode($data);
    }
    
}

function updateCustomer($customerInput, $customerParams)
{
    global $connect;

    if (!isset($customerParams['id'])) {
        # code...
        return error422('Customer id not found in URL');
    } elseif ($customerParams['id'] == null) {
        # code...
        return error422('Enter your customer id');
    }

    $customerId = mysqli_real_escape_string($connect, $customerParams['id']);
    
    $name = mysqli_real_escape_string($connect, $customerInput['name']);
    $email = mysqli_real_escape_string($connect, $customerInput['email']);
    $phone = mysqli_real_escape_string($connect, $customerInput['phone']);

    if (empty(trim($name))) {
        # code...
        return error422('Enter your name');

    } elseif (empty(trim($email))) {
        # code...
        return error422('Enter your email');

    } elseif (empty(trim($phone))) {
        # code...
        return error422('Enter your phone');

    } else {
        $query = "UPDATE customers SET name='$name', email='$email', phone='$phone' WHERE id='$customerId' LIMIT 1";
        $result = mysqli_query($connect, $query);

        if ($result) {
            # code...
            $data = [
                'status' => 200,
                'message' => 'Customer updated successfully!',
            ];
        
            header("HTTP/1.0 200 Updated!");
            return json_encode($data);
            
        } else {
            # code...
            $data = [
                'status' => 500,
                'message' => 'Internal server error',
            ];
        
            header("HTTP/1.0 500 Internal server error");
            return json_encode($data);
        }

    }
    
}