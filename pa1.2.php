<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Bootstrap JS dependencies -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COSI 127b</title>
    
</head>



<html>
<head>
    <title>IMDB Movie Database</title></br>
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
        <input type="submit" name="v_actors" value="View All Actors"><br>
    </form>      


        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["v_movies"])) {
                // Code to display all movies
                // MySQL database connection
                $servername = "localhost"; // Change if your MySQL server is hosted elsewhere
                $username = "root"; // Your MySQL username
                $password = ""; // Your MySQL password
                $dbname = "cosi127_pa1.2"; // Your MySQL database name,,, changed from cosi127_pa1.2

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
                $dbname = "cosi127_pa1.2"; // Your MySQL database name,, changed from cosi127_pa1.2

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





<body>

<div class="container">
    <form id="genreForm" method="post" action="php_script.php"> <!-- Specify php_script.php as the action -->
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Enter a genre" name="inputgenre_name" id="inputgenre_name">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" name="submitted" id="button-addon2">Query This</button>
            </div>
        </div>
    </form>
</div>





<!-- 


<body>
    <div class="container">
        <h1 style="text-align:center">COSI 127 - PA2</h1><br>
        <h3 style="text-align:center">OUR IMBD </h3><br>
    </div>

    <div class="container">
    <form id="mpidForm" method="post" action="php_script.php">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Enter mpid" name="inputmpid" id="inputmpid">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" name="submitted" id="button-addon2">Query This</button>
            </div>
        </div>
    </form>
    </div> -->



    <div class="container">
    <h1>Motion Pictures</h1>
    <?php
    // Check if the submit button has been clicked
    if(isset($_POST['submitted'])) {
        // Set age limit to whatever input we get
        $mpid = $_POST["inputMPID"]; 
    } else {
        // If the button was not clicked, set age limit to 0 
        $mpid = 0;
    }


    
    // Create a table for Motion Picture
    echo "<table class='table table-md table-bordered'>";
    echo "<thead class='thead-dark' style='text-align: center'>";
    echo "<tr><th class='col-md-2'>id</th>  <th class='col-md-2'>name</th> <th class='col-md-2'>rating</th>  <th class='col-md-2'>production</th> <th class='col-md-2'>budget</th>";

    // Define a class for table rows
    class MotionPictureTableRows extends RecursiveIteratorIterator {
        function __construct($it) {
            parent::__construct($it, self::LEAVES_ONLY);
        }

        function current() {
            return "<td style='text-align:center'>" . parent::current(). "</td>";
        }

        function beginChildren() {
            echo "<tr>";
        }

        function endChildren() {
            echo "</tr>" . "\n";
        }
    }

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cosi127_pa1.2";

    try {
        // Connect to MySQL DB using PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement for Motion Pictures
        $stmt = $conn->prepare("SELECT id, name, rating, production, budget FROM MotionPicture where rating>=$mpid");
        $stmt->execute();

        // Set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Display table rows for Motion Pictures
        foreach(new MotionPictureTableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    echo "</table>";
    $conn = null;
    ?>
</div>


<div class="container">
    <h1>User</h1>
    <?php
    // Check if the submit button has been clicked
    if(isset($_POST['submitted'])) {
        // Set age limit to whatever input we get
        $mpid = $_POST["inputMPID"]; 
    } else {
        // If the button was not clicked, set age limit to 0 
        $mpid = 0;
    }

    // Create a table for Users
    echo "<table class='table table-md table-bordered'>";
    echo "<thead class='thead-dark' style='text-align: center'>";
    echo "<tr><th class='col-md-2'>Email</th><th class='col-md-2'>Name</th><th class='col-md-2'>Age</th></tr></thead>";

    // Define a class for table rows
    class UserTableRows extends RecursiveIteratorIterator {
        function __construct($it) {
            parent::__construct($it, self::LEAVES_ONLY);
        }

        function current() {
            return "<td style='text-align:center'>" . parent::current(). "</td>";
        }

        function beginChildren() {
            echo "<tr>";
        }

        function endChildren() {
            echo "</tr>" . "\n";
        }
    }

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cosi127_pa1.2";

    try {
        // Connect to MySQL DB using PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement for Users
        $stmt = $conn->prepare("SELECT email, name, age FROM User where age>=$mpid");
        $stmt->execute();

        // Set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Display table rows for Users
        foreach(new UserTableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    echo "</table>";
    $conn = null;
    ?>
</div>



<div class="container">
    <h1>Movies</h1>
    <?php
    // Check if the submit button has been clicked
    if(isset($_POST['submitted'])) {
        // Set age limit to whatever input we get
        $mpid = $_POST["inputMPID"]; 
    } else {
        // If the button was not clicked, set age limit to 0 
        $mpid = 0;
    }

    // Create a table for Movies
    echo "<table class='table table-md table-bordered'>";
    echo "<thead class='thead-dark' style='text-align: center'>";
    echo "<tr><th class='col-md-2'>Movie ID</th><th class='col-md-2'>Box Office Collection</th></tr></thead>";

    // Define a class for table rows
    class MovieTableRows extends RecursiveIteratorIterator {
        function __construct($it) {
            parent::__construct($it, self::LEAVES_ONLY);
        }

        function current() {
            return "<td style='text-align:center'>" . parent::current(). "</td>";
        }

        function beginChildren() {
            echo "<tr>";
        }

        function endChildren() {
            echo "</tr>" . "\n";
        }
    }

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cosi127_pa1.2";

    try {
        // Connect to MySQL DB using PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement for Movies
        $stmt = $conn->prepare("SELECT mpid, boxoffice_collection FROM movie where mpid>=$mpid");
        $stmt->execute();

        // Set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Display table rows for Movies
        foreach(new MovieTableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    echo "</table>";
    $conn = null;
    ?>
</div>


<div class="container">
    <h1>Series</h1>
    <?php
    // Check if the submit button has been clicked
    if(isset($_POST['submitted'])) {
        // Set age limit to whatever input we get
        $mpid = $_POST["inputMPID"]; 
    } else {
        // If the button was not clicked, set age limit to 0 
        $mpid = 0;
    }

    // Create a table for Series
    echo "<table class='table table-md table-bordered'>";
    echo "<thead class='thead-dark' style='text-align: center'>";
    echo "<tr><th class='col-md-2'>Series ID</th><th class='col-md-2'>Season Count</th></tr></thead>";

    // Define a class for table rows
    class SeriesTableRows extends RecursiveIteratorIterator {
        function __construct($it) {
            parent::__construct($it, self::LEAVES_ONLY);
        }

        function current() {
            return "<td style='text-align:center'>" . parent::current(). "</td>";
        }

        function beginChildren() {
            echo "<tr>";
        }

        function endChildren() {
            echo "</tr>" . "\n";
        }
    }

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cosi127_pa1.2";

    try {
        // Connect to MySQL DB using PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement for Series
        $stmt = $conn->prepare("SELECT mpid, season_count FROM Series where mpid>=$mpid");
        $stmt->execute();

        // Set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Display table rows for Series
        foreach(new SeriesTableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    echo "</table>";
    $conn = null;
    ?>
</div>


<div class="container">
    <h1>People</h1>
    <?php
    // Check if the submit button has been clicked
    if(isset($_POST['submitted'])) {
        // Set age limit to whatever input we get
        $mpid = $_POST["inputMPID"]; 
    } else {
        // If the button was not clicked, set age limit to 0 
        $mpid = 0;
    }

    // Create a table for People
    echo "<table class='table table-md table-bordered'>";
    echo "<thead class='thead-dark' style='text-align: center'>";
    echo "<tr><th class='col-md-2'>ID</th><th class='col-md-2'>Name</th><th class='col-md-2'>Nationality</th><th class='col-md-2'>Date of Birth</th><th class='col-md-2'>Gender</th></tr></thead>";

    // Define a class for table rows
    class PeopleTableRows extends RecursiveIteratorIterator {
        function __construct($it) {
            parent::__construct($it, self::LEAVES_ONLY);
        }

        function current() {
            return "<td style='text-align:center'>" . parent::current(). "</td>";
        }

        function beginChildren() {
            echo "<tr>";
        }

        function endChildren() {
            echo "</tr>" . "\n";
        }
    }

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cosi127_pa1.2";

    try {
        // Connect to MySQL DB using PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement for People
        $stmt = $conn->prepare("SELECT id, name, nationality, dob, gender FROM People where id>=$mpid");
        $stmt->execute();

        // Set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Display table rows for People
        foreach(new PeopleTableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    echo "</table>";
    $conn = null;
    ?>
</div>


<div class="container">
    <h1>Roles</h1>
    <?php
    // Check if the submit button has been clicked
    if(isset($_POST['submitted'])) {
        // Set age limit to whatever input we get
        $mpid = $_POST["inputMPID"]; 
    } else {
        // If the button was not clicked, set age limit to 0 
        $mpid = 0;
    }

    // Create a table for Roles
    echo "<table class='table table-md table-bordered'>";
    echo "<thead class='thead-dark' style='text-align: center'>";
    echo "<tr><th class='col-md-2'>Movie ID</th><th class='col-md-2'>Person ID</th><th class='col-md-2'>Role Name</th></tr></thead>";

    // Define a class for table rows
    class RoleTableRows extends RecursiveIteratorIterator {
        function __construct($it) {
            parent::__construct($it, self::LEAVES_ONLY);
        }

        function current() {
            return "<td style='text-align:center'>" . parent::current(). "</td>";
        }

        function beginChildren() {
            echo "<tr>";
        }

        function endChildren() {
            echo "</tr>" . "\n";
        }
    }

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cosi127_pa1.2";

    try {
        // Connect to MySQL DB using PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement for Roles
        $stmt = $conn->prepare("SELECT mpid, pid, role_name FROM Role where mpid>=$mpid");
        $stmt->execute();

        // Set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Display table rows for Roles
        foreach(new RoleTableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    echo "</table>";
    $conn = null;
    ?>
</div>



<div class="container">
    <h1>Awards</h1>
    <?php
    // Check if the submit button has been clicked
    if(isset($_POST['submitted'])) {
        // Set age limit to whatever input we get
        $mpid = $_POST["inputMPID"]; 
    } else {
        // If the button was not clicked, set age limit to 0 
        $mpid = 0;
    }

    // Create a table for Awards
    echo "<table class='table table-md table-bordered'>";
    echo "<thead class='thead-dark' style='text-align: center'>";
    echo "<tr><th class='col-md-2'>Movie ID</th><th class='col-md-2'>Person ID</th><th class='col-md-2'>Award Name</th><th class='col-md-2'>Award Year</th></tr></thead>";

    // Define a class for table rows
    class AwardTableRows extends RecursiveIteratorIterator {
        function __construct($it) {
            parent::__construct($it, self::LEAVES_ONLY);
        }

        function current() {
            return "<td style='text-align:center'>" . parent::current(). "</td>";
        }

        function beginChildren() {
            echo "<tr>";
        }

        function endChildren() {
            echo "</tr>" . "\n";
        }
    }

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cosi127_pa1.2";

    try {
        // Connect to MySQL DB using PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement for Awards
        $stmt = $conn->prepare("SELECT mpid, pid, award_name, award_year FROM Award where mpid>=$mpid");
        $stmt->execute();

        // Set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Display table rows for Awards
        foreach(new AwardTableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    echo "</table>";
    $conn = null;
    ?>
</div>


<div class="container">
    <h1>Genres</h1>
    <?php
    // Check if the submit button has been clicked
    if(isset($_POST['submitted'])) {
        // Set age limit to whatever input we get
        $mpid = $_POST["inputMPID"]; 
    } else {
        // If the button was not clicked, set age limit to 0 
        $mpid = 0;
    }

    // Create a table for Genres
    echo "<table class='table table-md table-bordered'>";
    echo "<thead class='thead-dark' style='text-align: center'>";
    echo "<tr><th class='col-md-2'>Movie ID</th><th class='col-md-2'>Genre Name</th></tr></thead>";

    // Define a class for table rows
    class GenreTableRows extends RecursiveIteratorIterator {
        function __construct($it) {
            parent::__construct($it, self::LEAVES_ONLY);
        }

        function current() {
            return "<td style='text-align:center'>" . parent::current(). "</td>";
        }

        function beginChildren() {
            echo "<tr>";
        }

        function endChildren() {
            echo "</tr>" . "\n";
        }
    }

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cosi127_pa1.2";

    try {
        // Connect to MySQL DB using PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement for Genres
        $stmt = $conn->prepare("SELECT mpid, genre_name FROM Genre where mpid>=$mpid");
        $stmt->execute();

        // Set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Display table rows for Genres
        foreach(new GenreTableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    echo "</table>";
    $conn = null;
    ?>
</div>

<div class="container">
    <h1>Locations</h1>
    <?php
    // Check if the submit button has been clicked
    if(isset($_POST['submitted'])) {
        // Set age limit to whatever input we get
        $mpid = $_POST["inputMPID"]; 
    } else {
        // If the button was not clicked, set age limit to 0 
        $mpid = 0;
    }

    // Create a table for Locations
    echo "<table class='table table-md table-bordered'>";
    echo "<thead class='thead-dark' style='text-align: center'>";
    echo "<tr><th class='col-md-2'>Movie ID</th><th class='col-md-2'>ZIP</th><th class='col-md-2'>City</th><th class='col-md-2'>Country</th></tr></thead>";

    // Define a class for table rows
    class LocationTableRows extends RecursiveIteratorIterator {
        function __construct($it) {
            parent::__construct($it, self::LEAVES_ONLY);
        }

        function current() {
            return "<td style='text-align:center'>" . parent::current(). "</td>";
        }

        function beginChildren() {
            echo "<tr>";
        }

        function endChildren() {
            echo "</tr>" . "\n";
        }
    }

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cosi127_pa1.2";

    try {
        // Connect to MySQL DB using PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement for Locations
        $stmt = $conn->prepare("SELECT mpid, zip, city, country FROM Location where mpid>=$mpid");
        $stmt->execute();

        // Set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Display table rows for Locations
        foreach(new LocationTableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    echo "</table>";
    $conn = null;
    ?>
</div>

<div class="container">
    <h1>Likes</h1>
    <?php
    // Check if the submit button has been clicked
    if(isset($_POST['submitted'])) {
        // Set age limit to whatever input we get
        $mpid = $_POST["inputMPID"]; 
    } else {
        // If the button was not clicked, set age limit to 0 
        $mpid = 0;
    }

    // Create a table for Likes
    echo "<table class='table table-md table-bordered'>";
    echo "<thead class='thead-dark' style='text-align: center'>";
    echo "<tr><th class='col-md-2'>Motion Picture ID</th><th class='col-md-2'>User Email</th></tr></thead>";

    // Define a class for table rows
    class LikesTableRows extends RecursiveIteratorIterator {
        function __construct($it) {
            parent::__construct($it, self::LEAVES_ONLY);
        }

        function current() {
            return "<td style='text-align:center'>" . parent::current(). "</td>";
        }

        function beginChildren() {
            echo "<tr>";
        }

        function endChildren() {
            echo "</tr>" . "\n";
        }
    }

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cosi127_pa1.2";

    try {
        // Connect to MySQL DB using PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement for Likes
        $stmt = $conn->prepare("SELECT mpid, uemail FROM Likes WHERE mpid >= :mpid");
        $stmt->bindParam(':mpid', $mpid, PDO::PARAM_INT);
        $stmt->execute();

        // Set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Display table rows for Likes
        foreach(new LikesTableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    echo "</table>";
    $conn = null;
    ?>
</div>



</body>
</html>
