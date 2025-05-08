<?php include 'includes/config.php'; ?>
<?php include 'includes/header.php'; ?>

<div class="container">
    <h1>Pomodoro Timer</h1>
    <div class="pomodoro-timer" id="timer">25:00</div>
    <button class="btn" onclick="startPomodoro()">Start</button>
    <button class="btn" onclick="resetTimer()">Reset</button>

    <?php
    // Display previous sessions
    $result = $conn->query("SELECT * FROM pomodoro_sessions ORDER BY created_at DESC LIMIT 5");
    if ($result->num_rows > 0):
    ?>
    <h2>Recent Sessions</h2>
    <div class="session-list">
        <?php while($row = $result->fetch_assoc()): ?>
        <div class="task-card">
            <span><?= $row['duration'] ?> minutes</span>
            <small><?= date('M j, Y g:i A', strtotime($row['created_at'])) ?></small>
        </div>
        <?php endwhile; ?>
    </div>
    <?php endif; ?>
</div>

<script>
let timeLeft = 1500; // 25 minutes
let timerId = null;

function updateDisplay() {
    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    document.getElementById('timer').textContent = 
        `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
}

function startPomodoro() {
    if (!timerId) {
        timerId = setInterval(() => {
            timeLeft--;
            updateDisplay();
            if (timeLeft === 0) {
                clearInterval(timerId);
                saveSession();
            }
        }, 1000);
    }
}

function resetTimer() {
    clearInterval(timerId);
    timerId = null;
    timeLeft = 1500;
    updateDisplay();
}

async function saveSession() {
    try {
        const response = await fetch('save_pomodoro.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ duration: 25 })
        });
        if (response.ok) location.reload();
    } catch (error) {
        console.error('Error saving session:', error);
    }
}
</script>

<?php include 'includes/footer.php'; ?>