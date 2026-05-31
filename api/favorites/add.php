<?php
require "../../config/db.php";

$data = json_decode(file_get_contents("php://input"), true);

$user_id = $data["user_id"] ?? null;
$city = $data["city"] ?? "";

if (!$user_id || !$city) {
    echo json_encode([
        "success" => false,
        "message" => "Dados inválidos"
    ]);
    exit;
}

$sql = "INSERT INTO favorites (user_id, city) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $user_id, $city);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}