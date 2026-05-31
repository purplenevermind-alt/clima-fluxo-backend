<?php
require "../../config/db.php";

$id = $_GET["id"] ?? null;

if (!$id) {
    echo json_encode([
        "success" => false,
        "message" => "ID inválido"
    ]);
    exit;
}

$sql = "DELETE FROM favorites WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}