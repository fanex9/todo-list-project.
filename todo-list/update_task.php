<?php
include 'includes/config.php';

if (isset($_POST['task_id'])) {
    $task_id = (int)$_POST['task_id'];
    $stmt = $conn->prepare("UPDATE tasks SET task_status = 'completed' WHERE task_id = ?");
    $stmt->bind_param("i", $task_id);
    $stmt->execute();
}

header("Location: active_tasks.php");