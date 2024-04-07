<?php
session_start();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "scholarship"; // Change this to your database name
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve user input
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the username or email already exists in the database
    $check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        // Username or email already exists
        echo "Username or email already exists. Please choose a different one.";
    } 
    else 
    {
        // Insert new user into the database
        $insert_query = "INSERT INTO users (name, username, email, password) VALUES ('$name', '$username', '$email', '$password')";

        if ($conn->query($insert_query) === TRUE) {
            // New user added successfully, set the username in session
            $_SESSION['username'] = $username;
            $_SESSION['email']= $email;
            // Redirect to the home page or any other page
            header("Location: load.html");
            exit();
        } else {
            // Error occurred while adding the new user
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
