<?php
// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "scholarship";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve user data from the users table
$sel = "SELECT * FROM users";
$query = mysqli_query($conn, $sel);

// Check if the query was successful and if it returned any rows
if ($query && mysqli_num_rows($query) > 0) {
    // Fetch the first row from the result set
    $result = mysqli_fetch_assoc($query);

} else {
    // Handle the case when no rows are returned
    echo '<img class="login-icon" loading="eager" alt="" src="./public/login.svg" />';
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarships</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./stylesheet/search_global.css" />
    <link rel="stylesheet" href="./stylesheet/search.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
        .scholarship-item {
            border: 2px solid black; /* Added border */
        }
        .bg-custom-color {
    background-color: rgb(108, 97, 234);
}

    </style>
</head>
<body class="bg-gray-100">
    <div class="scholarship-p">
        <header class="scholarships-frame">
            <div class="rectangle-parent">
                <div class="frame-child"></div>
                <div class="about-us-frame">
                    <a href="Dashboard.php"><div class="transition-transform duration-100 transform hover:scale-110"style="font-family:'Montserrat', sans-serif;color: rgb(108, 97, 234);font-weight: 500 ;">HOME</div></a>
                </div>
                <div class="about-us-frame1">
                    <a href="search.php" style="text-decoration: none; color: black;color: rgb(108, 97, 234); font-family:'Montserrat', sans-serif;">
                        <div class="transition-transform duration-100 transform hover:scale-110"style="font-weight: 500;">SCHOLARSHIPS</div>
                    </a>
                </div>
                <div class="transition-transform duration-100 transform hover:scale-110"style="font-family:'Montserrat', sans-serif; color: rgb(108, 97, 234); font-weight: 500;">ABOUT US</div>
                <div class="transition-transform duration-100 transform hover:scale-110"style="font-family:'Montserrat', sans-serif;font-weight: 500;color: rgb(108, 97, 234);">CONTACT US</div>
                <div class="transition-transform duration-100 transform hover:scale-110"style="font-family:'Montserrat', sans-serif;font-weight: 500;color: rgb(108, 97, 234);"><?php
                session_start();
                echo "<h2>@".$_SESSION['username']."</h2>"; ?></div>
            </div>
        </header>
        <div class="search-bar-frame">
    <div class="searchbar-parent">
        <form action="search.php" method="GET"> <!-- Replace "your_php_file.php" with the name of your PHP file -->
            <div class="searchbar" style="padding-left:6%; padding-top:5.5px; font-family:'Montserrat', sans-serif; ">
                <input
                    type="text"
                    name="search" 
                    style="width: 98%; border-radius: none;height :30px; background-color:transparent;border: none;
                    outline: none;
                    border-bottom: 1px solid #ccc; font-size :25px;"
                    placeholder="search for scholarships here!!!"
                />
                <div class="underline" style="width: 98%;"></div>
            </div>
            <button type="submit" class="frame-icon"> <!-- Submit button for the form -->
                <img alt="" src="./public/frame@2x.png" />
            </button>
        </form>
    </div>
</div>

        <div class="scholarship-list mt-8 grid gap-4">
        <?php
// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "scholarship";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the search query is set
if(isset($_GET['search'])) {
    // Sanitize the search query to prevent SQL injection
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    
    // Query to retrieve scholarships based on the search query
    $sql = "SELECT scholar_name, schlor_desc, eligibility, deadline, appl_link FROM scholarship_collec 
            WHERE scholr_short_name LIKE '%$search%' OR schlor_desc LIKE '%$search%' OR eligibility LIKE '%$search%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            // Display scholarship details
            echo "<div class='scholarship-item p-4 bg-white rounded-md shadow-md' style='width: 94.1%;'>";
            echo "<h2 class='text-lg font-bold mb-2'>" . $row["scholar_name"] . "</h2>";
            echo "<p class='mb-2'><strong>Description:</strong> " . $row["schlor_desc"] . "</p>";

            // Printing eligibility in bulleted form
            echo "<p class='mb-2'><strong>Eligibility:</strong></p>";
            echo "<ul class='list-disc pl-4'>";
            // Splitting eligibility by newline and creating list items
            $eligibility_items = explode("\n", $row["eligibility"]);
            foreach ($eligibility_items as $item) {
                // Check if the item is not empty
                if (!empty(trim($item))) {
                    echo "<li>" . trim($item) . "</li>";
                }
            }
            echo "</ul>";

            // Deadline
            echo "<p class='mb-2 mt-4'><strong>Deadline:</strong> " . $row["deadline"] . "</p>";

            // Apply Now button with fetched link
            echo "<a href='" . $row["appl_link"] . "' class='bg-custom-color hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block mt-2'>Apply Now</a>";
            echo "</div><br>";
        }
    } else {
        echo "No results found.";
    }
} else {
    // Query to retrieve all scholarships
    $sql = "SELECT scholar_name, schlor_desc, eligibility, deadline, appl_link FROM scholarship_collec";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            // Display all scholarships
            echo "<div class='scholarship-item p-4 bg-white rounded-md shadow-md' style='width: 94.1%;'>";
            echo "<h2 class='text-lg font-bold mb-2'>" . $row["scholar_name"] . "</h2>";
            echo "<p class='mb-2'><strong>Description:</strong> " . $row["schlor_desc"] . "</p>";

            // Printing eligibility in bulleted form
            echo "<p class='mb-2'><strong>Eligibility:</strong></p>";
            echo "<ul class='list-disc pl-4'>";
            // Splitting eligibility by newline and creating list items
            $eligibility_items = explode("\n", $row["eligibility"]);
            foreach ($eligibility_items as $item) {
                // Check if the item is not empty
                if (!empty(trim($item))) {
                    echo "<li>" . trim($item) . "</li>";
                }
            }
            echo "</ul>";

            // Deadline
            echo "<p class='mb-2 mt-4'><strong>Deadline:</strong> " . $row["deadline"] . "</p>";

            // Apply Now button with fetched link
            echo "<a href='" . $row["appl_link"] . "' class='bg-custom-color hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block mt-2'>Apply Now</a>";
            echo "</div><br>";
        }
    } else {
        echo "No scholarships available.";
    }
}

// Close the database connection
$conn->close();
?>
        </div>
    </div>
</body>
</html>
