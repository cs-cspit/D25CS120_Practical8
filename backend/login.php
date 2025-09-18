<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "music_project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$pass = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if (password_verify($pass, $row['password'])) {
        $_SESSION['username'] = $row['username'];
        header("Location: ../index.html"); // success → homepage
        exit();
    } else {
        echo "<script>alert('❌ Wrong password!'); window.location.href='../login.html';</script>";
    }
} else {
    echo "<script>alert('❌ User not found!'); window.location.href='../login.html';</script>";
}

$conn->close();
?>
