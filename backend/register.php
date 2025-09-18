<?php
$servername = "localhost";
$username = "root"; // change if needed
$password = "";     // change if needed
$dbname = "music_project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fullname = $_POST['fullname'];
$user = $_POST['username'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$dob = $_POST['dob'];
$pass = password_hash($_POST['password'], PASSWORD_BCRYPT);

// Photo upload
$photoPath = "";
if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    $photoPath = $targetDir . basename($_FILES['photo']['name']);
    move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath);
}

$sql = "INSERT INTO users (fullname, username, email, mobile, dob, photo, password) 
        VALUES ('$fullname','$user','$email','$mobile','$dob','$photoPath','$pass')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../login.html"); // redirect to login
    exit();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
