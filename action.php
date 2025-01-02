<?php
$host = 'localhost';
$db_name = 'crud_db';
$username = 'root';
$password = '';
$conn = new mysqli($host, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    if ($conn->query($sql)) {
        echo "User added successfully!";
    }
}

// Update
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";
    if ($conn->query($sql)) {
        echo "User updated successfully!";
    }
}

// Delete
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = $_POST['id'];
    $sql = "DELETE FROM users WHERE id=$id";
    if ($conn->query($sql)) {
        echo "User deleted successfully!";
    }
}

// Fetch
if (isset($_GET['action']) && $_GET['action'] == 'fetch') {
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    $output = '';
    while ($row = $result->fetch_assoc()) {
        $output .= "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>
                            <button class='editBtn' data-id='{$row['id']}'>Edit</button>
                            <button class='deleteBtn' data-id='{$row['id']}'>Delete</button>
                        </td>
                    </tr>";
    }
    echo $output;
}

// Edit
if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo json_encode($row);
}
?>
