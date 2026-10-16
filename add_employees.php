```php
<?php
require_once "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $department_id = (int) $_POST["department_id"];

    $stmt = $conn->prepare(
        "INSERT INTO employees (name, email, department_id) VALUES (?, ?, ?)"
    );

    $stmt->bind_param("ssi", $name, $email, $department_id);

    if ($stmt->execute()) {
        $message = "Employee added successfully!";
    } else {
        $message = "Error adding employee.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Employee</title>
</head>
<body>

    <h2>Add Employee</h2>

    <p><?= htmlspecialchars($message) ?></p>

    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" required>
        <br><br>

        <label>Email:</label>
        <input type="email" name="email" required>
        <br><br>

        <label>Department ID:</label>
        <input type="number" name="department_id" min="1" required>
        <br><br>

        <button type="submit">Add Employee</button>
    </form>

    <br>

    <a href="employees.php">View Employee List</a>

</body>
</html>
