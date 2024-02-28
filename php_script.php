
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
                $dbname = "cosi127b"; // Your MySQL database name,,, changed from cosi127_pa1.2

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
                $dbname = "cosi127b"; // Your MySQL database name,, changed from cosi127_pa1.2

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



<?php
// Check if the form is submitted
// FOR THE ACTUALY QUERY PART

if(isset($_POST['submitted'])) {
    // Check if inputmpid is set and not empty
    if(isset($_POST['inputmpid']) && !empty($_POST['inputmpid'])) {
        // Sanitize the input
        $inputmpid = $_POST['inputmpid'];

        // Establish a connection to your database
        $servername = "localhost"; // Change if your MySQL server is hosted elsewhere
        $username = "root"; // Your MySQL username
        $password = ""; // Your MySQL password
        $dbname = "cosi127b"; // Your MySQL database name,,, changed from cosi127_pa1.2


        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL query
        $query = "SELECT * FROM MotionPicture WHERE id = '$inputmpid'";
        

        $result = $conn->query($query);
        if (!$result) {
            echo "Error executing the query: " ;
        }

        

        // Check if query executed successfully
        if ($result) {
            // Check if any rows were returned
            if ($result->num_rows > 0) {
                // Display table header
                echo "<table border='1'>";
                echo "<tr><th>ID</th><th>Name</th></tr>";

                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    // Display table row
                    echo "<tr>";
                    echo "<td>".$row["id"]."</td>";
                    echo "<td>".$row["name"]."</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No results found";
            }
        } else {
            echo "Error executing the query: " . $conn->error;
        }

        // Close the database connection
        $conn->close();
    } else {
        // Handle case when inputmpid is empty
        echo "Please enter an mpid";
    }
} else {
    // Handle case when form is not submitted
    echo "Form not submitted";
}


?>

