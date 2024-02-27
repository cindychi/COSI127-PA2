<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>IMDB Movie Database</title>
            <style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                    }
                th, td {
                    border: 1px solid #ddd;
                    padding: 8px;
                    text-align: left;
                    }
                th {
                    background-color: #f2f2f2;
                    }
            </style>
        </head>

<body>
        <h1>IMDB Movie Database</h1>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="submit" name="v_movies" value="View All Movies">
            <input type="submit" name="v_actors" value="View All Actors">
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["v_movies"])) {
                // Code to display all movies
                // MySQL database connection
                $servername = "localhost"; // Change if your MySQL server is hosted elsewhere
                $username = "root"; // Your MySQL username
                $password = ""; // Your MySQL password
                $dbname = "cosi127_pa1.2"; // Your MySQL database name

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query to fetch all movies
                $sql = "SELECT mp.name, mp.rating, mp.production, mp.budget, m.boxoffice_collection 
                        FROM MotionPicture mp
                        LEFT JOIN Movie m ON mp.id = m.mpid";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    echo "<h2>All Movies</h2>";
                    echo "<table>";
                    echo "<tr><th>Name</th><th>Rating</th><th>Production</th><th>Budget</th><th>Box Office Collection</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["name"] . "</td><td>" . $row["rating"] . "</td><td>" . $row["production"] . "</td><td>" . $row["budget"] . "</td><td>" . $row["boxoffice_collection"] . "</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }
                $conn->close();
            } elseif (isset($_POST["v_actors"])) {
                // Code to display all actors
                // MySQL database connection
                $servername = "localhost"; // Change if your MySQL server is hosted elsewhere
                $username = "root"; // Your MySQL username
                $password = ""; // Your MySQL password
                $dbname = "cosi127_pa1.2"; // Your MySQL database name

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query to fetch all actors
                $sql = "SELECT name, nationality, dob, gender FROM People";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    echo "<h2>All Actors</h2>";
                    echo "<table>";
                    echo "<tr><th>Name</th><th>Nationality</th><th>Date of Birth</th><th>Gender</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["name"] . "</td><td>" . $row["nationality"] . "</td><td>" . $row["dob"] . "</td><td>" . $row["gender"] . "</td></tr>";
                    }
                    echo "</table>";
                }    
                    else {
                    echo "0 results";
                    }
                    $conn->close();
                }
            }   
        ?>
</body>
</html>
