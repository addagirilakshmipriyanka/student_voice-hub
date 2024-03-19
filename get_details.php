<?php
if(isset($_POST['id'])){
    $conn=mysqli_connect('localhost','root',"",'wt');

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_POST['id'];

    // SQL query to retrieve the details of the selected record
    $sql = "SELECT * FROM your_table_name WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h2>Record Details</h2>";
        echo "<p>ID: " . $row["election_id"] . "</p>";
        echo "<p>Name: " . $row["election_name"] . "</p>";
        }
    else {
        echo "Record not found.";
    }

    // Close the database connection
    $conn->close();
}
?>