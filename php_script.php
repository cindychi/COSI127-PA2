<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
        <input type="hidden" name="submitted" value="true"> 
        <input type="submit" name="v_genre" value="View Chosen Genre">
        <input type="submit" name="v_movies" value="View All Movies">
        <input type="submit" name="v_actors" value="View All Actors">
        <select name="sort_order">
        <option value="ASC">Ascending</option>
        <option value="DESC">Descending</option>
        </select>
    </form>
    <a href="index.php" class="btn btn-primary">Home</a>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["v_movies"])) {
            // Code to display all movies
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
                echo "<h2>All Actors</h2>";
                echo "<table>";
                echo "<tr><th>Name</th><th>Nationality</th><th>Date of Birth</th><th>Gender</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["name"] . "</td><td>" . $row["nationality"] . "</td><td>" . $row["dob"] . "</td><td>" . $row["gender"] . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
            $conn->close();
        } 
        
        
        
        elseif (isset($_POST["inputgenre_name"])) {
            $inputgenre_name = $_POST["inputgenre_name"];

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

            // Prepare SQL query
            $query = "SELECT * 
                      FROM MotionPicture mp
                      INNER JOIN Genre g ON mp.id = g.mpid
                      WHERE g.genre_name = '$inputgenre_name'";

            $result = $conn->query($query);

            if ($result && $result->num_rows > 0) {
                echo "<h2>Motion Pictures under the Genre: $inputgenre_name</h2>";
                echo "<table border='1'>";
                echo "<tr><th>ID</th><th>Name</th></tr>";

                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["id"]."</td>";
                    echo "<td>".$row["name"]."</td>";
                    echo "</tr>";
                }
                echo "</table>";

                







            } else {
                echo "No results found for the genre: $inputgenre_name";
            }

            $conn->close();
        } else {
            echo "Form not submitted or genre input is not set.";
        }
    } else {
        echo "Form not submitted.";
    }
    ?>







</body>
</html>
