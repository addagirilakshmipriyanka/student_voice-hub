<?php session_start();
error_reporting(0);
$election_id = $_POST["election_id"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Election Voting</title>
    <link rel="stylesheet" href="3.css">
</head>
<style>
      .candidates-container {
        display: flex;
        flex-wrap: wrap; /* Allow items to wrap to the next row */
        justify-content: space-around; /* Align items with space around them */
    }
</style>
<body>
<?php include("Navbar.php"); ?>
<div class="top"></div>
    <header>
        <?php echo $election_id; ?>
        <h1>Online Election Voting</h1>
    </header>
    <main>

<?php
$conn=mysqli_connect('localhost','root',"",'wt');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM candidates where election_id='$election_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='candidates-container'>"; // Start the flex container
    while($row = $result->fetch_assoc()) {
        echo "<div class='candidate-list'>";
        echo "<div class='candidate-card'>";
        echo "<div class='candidate-icon male'></div>";
        echo "<h2>". $row['candidate_name'] ."</h2>";
        echo "<h6 class='card-title'> ID:" . $row['candidate_id'] . "</h6>";
        echo "<button class='vote-button'>Vote</button>";
        echo "</div> <br>";
        echo "</div>";
    }
    echo "</div>"; // End the flex container
} else {
    echo "No election requests";
}

?>
    </main>
    <footer>
        <p>&copy; 2023 Online Election Voting</p>
    </footer>
    <script src="3.js"></script>
</body>
</html>