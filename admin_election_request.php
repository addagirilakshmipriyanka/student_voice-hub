<!-- admin_election_requests.php (Admin Page for Viewing and Accepting Requests) -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Election Requests</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1>Admin Election Requests</h1>

    <?php
    $conn=mysqli_connect('localhost','root',"",'wt');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM election_requests where admin_accepted=0";
    $result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='card mb-3 bg-light'>";
        echo "<div class='card-body'>";
        echo "<form action='admin_election_request.php' method='post'>";
        echo "<input type='hidden' name='election_id' value='" . $row['election_id'] . "'>";
        echo "<h5 class='card-title'>Election Request ID:" . $row['election_id'] . "</h5>";
        echo "<p class='card-text'>Request from: " . $row['user_name'] . "</p>";
        echo "<p class='card-text'>Type of Election: " . $row['type_of_election'] . "</p>";
        echo "<p class='card-text'>Start Date for Nomination: " . $row['start_date_nomination'] . "</p>";
        echo "<p class='card-text'>End Date for Nomination: " . $row['end_date_nomination'] . "</p>";
        echo "<p class='card-text'>Message: " . $row['message'] . "</p>";
        echo "<button class='btn btn-success' id='button' name='submit'>Accept Request</button>";
        echo "</form></div></div>";
    }
} else {
    echo "No election requests";
}

if(isset($_POST["submit"])) {
    $election_id = $_POST['election_id'];
    $sql2 = "UPDATE election_requests SET admin_accepted='1' WHERE election_id='$election_id'";
    $res = mysqli_query($conn, $sql2);
    if ($res) {
        // Election request successfully accepted, you can provide a success message here if needed
        header("Location: admin_election_request.php"); // Redirect back to the same page to refresh the request list
        exit();
    } else {
        // Handle error if the SQL query fails
        echo "Error: " . mysqli_error($conn);
    }
}

// Close the database connection after performing the operations
mysqli_close($conn);
?>


    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
