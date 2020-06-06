<?php

header("Content-type: application/json");

$rawBody = file_get_contents("php://input");
$json = json_decode($rawBody, true);

if (isset($json['token'])) {

    require_once __DIR__ . '/../../services/auth/AuthService.php';
    require_once __DIR__ . '/../../utils/databases/DatabaseManager.php';

    $token = $json['token'];

    $dbManager = new DatabaseManager();
    $authService = new AuthService($dbManager);
    $user = $authService->subscribeFidelity($token);

    if ($user === null) {
        http_response_code(401);
    }

    echo json_encode($user);

} else {
    http_response_code(400);
}