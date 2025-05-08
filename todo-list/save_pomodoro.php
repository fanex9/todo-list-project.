<?php
include 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $duration = intval($data['duration']);

    $stmt = $conn->prepare("INSERT INTO pomodoro_sessions (duration) VALUES (?)");
    $stmt->bind_param("i", $duration);
    $stmt->execute();
    
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
    exit;
}