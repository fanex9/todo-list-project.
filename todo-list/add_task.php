<?php include 'includes/config.php'; ?>
<?php include 'includes/header.php'; ?>

<div class="container">
    <h1>Add New Task</h1>
    <form method="POST" class="task-form">
        <input type="text" name="task" placeholder="Enter task description" required>
        <input type="date" name="due_date">
        <button type="submit" class="btn">Add Task</button>
    </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = htmlspecialchars($_POST['task']);
    $due_date = $_POST['due_date'] ?? null;
    
    $stmt = $conn->prepare("INSERT INTO tasks (task_description, due_date) VALUES (?, ?)");
    $stmt->bind_param("ss", $task, $due_date);
    $stmt->execute();
    header("Location: active_tasks.php");
}
?>

<?php include 'includes/footer.php'; ?>