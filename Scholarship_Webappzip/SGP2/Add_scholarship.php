<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scholarship";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$scholar_name = $_POST['scholar_name'];
$scholr_short_name = $_POST['scholr_short_name'];
$schlor_desc = $_POST['schlor_desc'];
$doc_req = $_POST['doc_req'];
$category = $_POST['category'];
$caste = $_POST['caste'];
$eligibility = $_POST['eligibility'];
$for_whom = $_POST['for_whom'];
$deadline = $_POST['deadline'];
$name_org = $_POST['name_org'];
$appl_link = $_POST['appl_link'];
$which_country = $_POST['which_country'];
$which_state = $_POST['which_state'];

// SQL query using prepared statement
$sql = "INSERT INTO scholarship_collec (scholar_name, scholr_short_name, schlor_desc, doc_req, category, caste, eligibility, for_whom, deadline, name_org, appl_link, which_country, state) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssssss", $scholar_name, $scholr_short_name, $schlor_desc, $doc_req, $category, $caste, $eligibility, $for_whom, $deadline, $name_org, $appl_link, $which_country, $which_state);

if ($stmt->execute()) {
    echo "<script>alert('New record created successfully');</script>";
} else {
    echo "<script>alert('Error: " . $stmt->error . "');</script>";
}

$stmt->close();
$conn->close();
?>
