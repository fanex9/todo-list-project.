<?php include 'includes/config.php'; ?>
<?php include 'includes/header.php'; ?>

<div class="container">
    <h1>Completed Tasks</h1>
    <?php
    $result = $conn->query("SELECT * FROM tasks WHERE task_status = 'completed'");
    while ($row = $result->fetch_assoc()):
    ?>
    <div class="task-card completed">
        <?= htmlspecialchars($row['task_description']) ?>
        <small>Completed on: <?= date('M j, Y', strtotime($row['created_at'])) ?></small>
    </div>
    <?php endwhile; ?>
</div>
//dsf

<?php include 'includes/footer.php'; ?>
