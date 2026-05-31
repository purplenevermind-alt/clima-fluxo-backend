<?php
require "../config/db.php";

$data = json_decode(file_get_contents("php://input"), true);

$email = $data["email"];

// gera código simples
$code = rand(1000, 9999);

// guarda no banco
$sql = "INSERT INTO password_resets (email, code) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $code);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "code" => $code
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Erro ao gerar código"
    ]);
}