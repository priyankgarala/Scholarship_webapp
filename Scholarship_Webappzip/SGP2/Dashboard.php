<?php
// Protect route: Check if user is logged in
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html"); // Redirect to login page
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="./stylesheet/global.css" />
    <link rel="stylesheet" href="./stylesheet/index.css" /> 
</head>
<body>
    
    <div class="homepage">
        <header class="vector-parent flex" style="font-size: 16px;">
            <a href="Dashboard.php" style="text-decoration: none;"><h2>HOME</h2></a>
            <a href="search.php"style="text-decoration: none;"><h2>SCHOLARSHIPS</h2></a>
            <a href="desktop-1.html"style="text-decoration: none;"><h2>ABOUT US</h2></a>
            <h2>CONTACT US</h2></a>
            <?php
             echo "<div class='dropdown' onclick='toggleDropdown(event)'>";
             echo "<div class='dropbtn'>@" . $_SESSION['username'];
             echo "<div class='dropdown-content' id='myDropdown' style='display: none;'>";
             echo "<ul><li>". $_SESSION['email']."</li></ul>";
             echo "<ul><li><form method='post'><button type='submit' name='logout'>Logout</button></form></li></ul>"; // Add logout button
             echo "</div>";
             echo "</div>";
             
             // Check if logout button is clicked
             if(isset($_POST['logout'])) {
                 // Destroy the ses
                 session_destroy();
                 // Redirect to the login page
                 header("Location: index.html");
                 exit;
             }
             ?>

        </header>
        <section class="home-image-frame">
            <div class="homeimage-parent">
                <img
                    class="homeimage-icon"
                    loading="eager"
                    alt=""
                    src="./public/homeimage@2x.png"
                />
                <br><br><br><br><br><br><br><br>
                <div id="name"> <h1 >WELCOME TO&nbsp;<h2>CHATRAVRUTI</h2></h1></div>

                <img
                    class="empowering-the-next-generation"
                    loading="eager"
                    alt=""
                    src="./public/empowering-the-next-generation.svg"
                />

                <a href="search.php"> <!-- Add the link here -->
                    <img
                        class="view-scholarship-icon"
                        loading="eager"
                        alt=""
                        src="./public/view-scholarship.svg"
                    />
                </a>
            </div>
        </section>
    </div>
    <style>
        
.dropbtn {
  font-size: 28px;
  color: rgb(108, 97, 234); /* Text color */
  cursor: pointer;
  margin-top: 23px;
  font-family: 'Montserrat', sans-serif;
}

/* Dropdown container */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9; /* Dropdown background color */
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  z-index: 1;
  border: 2px solid black; /* Add border */
  margin-right: 1vw; /* Add margin */
  width: 10vw; /* Add width */
  font-size: 15px;
  margin-top: 20px;
  margin-right: 30px;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}

/* Style the dropdown menu items */
.dropdown-content ul {
  list-style-type: none;
  padding: 0;
}

.dropdown-content ul li {
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content ul li:hover {
  background-color: #f1f1f1; /* Hover background color */
}


        h1{
            font-size: 40px;
            font-weight: 500;

        }
        .vector-parent{
            display: flex;
            margin-right: 20px;
            justify-content: space-between;
        
        }
        .vector-parent h2{
            font-family: 'Montserrat', sans-serif;
            display: flex;
            font-size: 28px;
            font-weight: 500;
            
        }

        .vector-parent h2:hover{
            transform: scale(1.1);    
            transition: 0.2s;
         }
        h2{
            font-size: 40px;
            color: rgb(108, 97, 234);
            display: flex;
        }
        #name{
            display: flex;
            font-family: 'Montserrat', sans-serif;
        }
    </style>
    <script>
var dropdownVisible = false;

function toggleDropdown(event) {
  dropdownVisible = !dropdownVisible;
  var dropdownContent = document.getElementById("myDropdown");
  dropdownContent.style.display = dropdownVisible ? "block" : "none";
  
  // Stop propagation to prevent immediate hiding of dropdown
  event.stopPropagation();
}

// Event listener to hide dropdown on clicks outside of it
document.addEventListener("click", function(event) {
  if (!event.target.closest(".dropdown")) {
    var dropdownContent = document.getElementById("myDropdown");
    dropdownContent.style.display = "none";
    dropdownVisible = false;
  }
});
    </script>
</body>
</html>

