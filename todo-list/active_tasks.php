<?php include 'includes/config.php'; ?>
<?php include 'includes/header.php'; ?>

<div class="container">
    <h1>Active Tasks</h1>
    <?php
    $result = $conn->query("SELECT * FROM tasks WHERE task_status = 'active'");
    while ($row = $result->fetch_assoc()):
    ?>
    <div class="task-card">
        <form action="update_task.php" method="POST">
            <input type="checkbox" onChange="this.form.submit()">
            <input type="hidden" name="task_id" value="<?= $row['task_id'] ?>">
            <span class="task-text"><?= htmlspecialchars($row['task_description']) ?></span>
            <?php if($row['due_date']): ?>
                <span class="due-date">📅 <?= date('M j, Y', strtotime($row['due_date'])) ?></span>
            <?php endif; ?>
        </form>
    </div>
    <?php endwhile; ?>
</div>

<?php include 'includes/footer.php'; ?>