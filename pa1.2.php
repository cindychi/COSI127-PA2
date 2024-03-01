<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COSI 127b</title>
    
</head>
<body>
    <h1>IMDB Movie Database</h1>

    <div style="display: flex;">
    <form action="tabs.php" method="post">
        <input type="submit" name="v_tables" value="View All Tables">
        <input type="submit" name="v_actors" value="View All Actors">
    </form>
    <form action="allmovies.php" method="post">
        <input type="submit" name="v_movies" value="View All Movies">
    </form>
</div>

   


    <!-- Home button -->
    <a href="index.php" class="btn btn-primary">Home</a>

    <br>
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

    <div class="container">
        <h2>Like a Movie</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                <label for="motionPictureID">Motion Picture ID:</label>
                <input type="text" class="form-control" id="motionPictureID" name="motionPictureID">
            </div>
            <div class="form-group">
                <label for="userEmail">Your Email:</label>
                <input type="email" class="form-control" id="userEmail" name="userEmail">
            </div>
            <button type="submit" class="btn btn-primary" name="like">Like</button>
        </form>
    </div>




    <?php
// Check if the form has been submitted
if(isset($_POST['like'])) {
    // Retrieve form data
    $motionPictureID = $_POST['motionPictureID'];
    $userEmail = $_POST['userEmail'];

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cosi127_pa1.2";

    try {
        // Create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement to insert like data into the Likes table
        $stmt = $conn->prepare("INSERT INTO Likes (mpid, uemail) VALUES (:mpid, :uemail)");
        // Bind parameters
        $stmt->bindParam(':mpid', $motionPictureID);
        $stmt->bindParam(':uemail', $userEmail);
        // Execute the query
        $stmt->execute();

        echo "Liked movie successfully!";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $conn = null;
}
?>
















</body>
</html>
