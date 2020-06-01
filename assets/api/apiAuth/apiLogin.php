<?php

header("Content-type: application/json");

$rawBody = file_get_contents("php://input");
$json = json_decode($rawBody, true);

if (isset($json['email'])
    && isset($json['password'])
) {

    require_once __DIR__ . '/../services/auth/AuthService.php';
    require_once __DIR__ . '/../utils/databases/DatabaseManager.php';

    $email = $json['email'];
    $pwd = $json['password'];

    $dbManager = new DatabaseManager();
    $authService = new AuthService($dbManager);
    $token = $authService->login($email, $pwd);

    if ($token === null) {
        http_response_code(401);
        die();
    }
    echo json_encode(['token' => $token,]);
} else {
    http_response_code(412);
}
