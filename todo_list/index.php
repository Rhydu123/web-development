<?php
// Connect to MySQL database
$conn = new mysqli('localhost', 'root', '', 'todo_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add a new task
if (isset($_POST['add_task'])) {
    $task = $_POST['task'];
    $day_of_week = $_POST['day_of_week'];
    $sql = "INSERT INTO tasks (task, day_of_week, status) VALUES ('$task', '$day_of_week', 'pending')";
    $conn->query($sql);
}

// Mark a task as completed
if (isset($_GET['complete'])) {
    $id = $_GET['complete'];
    $sql = "UPDATE tasks SET status='completed' WHERE id=$id";
    $conn->query($sql);
}

// Fetch tasks
$sql = "SELECT * FROM tasks ORDER BY day_of_week";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Weekly To-Do List</h1>

        <!-- Form to Add Tasks -->
        <form action="index.php" method="POST">
            <input type="text" name="task" placeholder="New Task" required>
            <select name="day_of_week" required>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
            </select>
            <button type="submit" name="add_task">Add Task</button>
        </form>

        <!-- Display Tasks -->
        <table>
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Day</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['task']; ?></td>
                        <td><?php echo $row['day_of_week']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <?php if ($row['status'] == 'pending') { ?>
                                <a href="index.php?complete=<?php echo $row['id']; ?>">Mark as Completed</a>
                            <?php } else { ?>
                                <span class="completed">Completed</span>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
