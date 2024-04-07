<?php
// Start the session
session_start();

// Assuming you have already established a database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "scholarship";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming the user logs in using a form and submits the credentials
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check if username and password match
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        // Username and password matched, set the username in session
        $email_query = "SELECT email FROM users WHERE username = '$username'";
        $email_result = $conn->query($email_query);
        
        $_SESSION['username'] = $username;
        if ($email_result && $email_result->num_rows > 0) {
            // Fetch email from the result set
            $row = $email_result->fetch_assoc();
            $email = $row['email'];
            
            // Store email in session
            $_SESSION['email'] = $email;
        }
        
        // Redirect to the home page or any other page
        header("Location: load.html");
        exit();
    } else {
        // Username or password incorrect
        echo "Invalid username or password";
    }
}

// Close the database connection
$conn->close();
?>
