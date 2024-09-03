<?php
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'register';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "CREATE TABLE IF NOT EXISTS teams (
  id INT PRIMARY KEY AUTO_INCREMENT,
  team_name VARCHAR(50),
  leader_name VARCHAR(50),
  leader_email VARCHAR(100),
  leader_contact VARCHAR(20),
  department VARCHAR(50),
  gender VARCHAR(10)
)";
$conn->query($query);

$query = "CREATE TABLE IF NOT EXISTS projects (
  id INT PRIMARY KEY AUTO_INCREMENT,
  team_id INT,
  project_title VARCHAR(100),
  project_theme VARCHAR(50),
  abstract VARCHAR(100)
)";
$conn->query($query);

$query = "CREATE TABLE IF NOT EXISTS team_members (
    id INT PRIMARY KEY AUTO_INCREMENT,
    team_id INT,
    member_name VARCHAR(50),
    member_email VARCHAR(100),
    member_contact VARCHAR(20)
  )";
$conn->query($query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $team_name = $_POST['teamname'];
    $leader_name = $_POST['tlname'];
    $leader_email = $_POST['tlemail'];
    $leader_contact = $_POST['tlcontact'];
    $department = $_POST['dept'];
    $gender = $_POST['gender'];
    $no_of_members = $_POST['noteammembers'];
    $project_title = $_POST['projecttitle'];
    $project_theme = $_POST['projecttheme'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES['abstract']['name']);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES['abstract']['size'] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($fileType != "pdf" && $fileType != "doc" && $fileType != "docx") {
        echo "Sorry, only PDF, DOC & DOCX files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES['abstract']['tmp_name'], $target_file)) {
            echo "The file " . basename($_FILES['abstract']['name']) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $query = "INSERT INTO teams (team_name, leader_name, leader_email, leader_contact, department, gender) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $team_name, $leader_name, $leader_email, $leader_contact, $department, $gender);
    $stmt->execute();
    $team_id = $stmt->insert_id;

    $query = "INSERT INTO projects (team_id, project_title, project_theme, abstract) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isss", $team_id, $project_title, $project_theme, $target_file);
    $stmt->execute();

    header('Location: registered.php');
    exit;
}

$conn->close();
?>