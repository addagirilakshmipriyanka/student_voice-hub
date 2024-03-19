<?php
$conn=mysqli_connect('localhost','root',"",'wt');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM election_requests where admin_accepted=1";
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Display Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1>Display Data</h1>

    <?php foreach($data as $row): ?>
        <div class="row mb-3">
            <div class="col">
                <strong>User Name:</strong> <?php echo $row['user_name']; ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <strong>Type of Election:</strong> <?php echo $row['type_of_election']; ?>
            </div>
        </div>
        <!-- Add more rows as needed -->
        <div class="row mb-3">
            <div class="col">
                <strong>Start Date for Nomination:</strong> <?php echo $row['start_date_nomination']; ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <strong>End Date for Nomination:</strong> <?php echo $row['end_date_nomination']; ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <strong>Start Date for Voting:</strong> <?php echo $row['start_date_voting']; ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <strong>End Date for Voting:</strong> <?php echo $row['end_date_voting']; ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <strong>Admin Accepted:</strong> <?php echo ($row['admin_accepted'] ? 'Yes' : 'No'); ?>
            </div>
        </div>
        <hr>
    <?php endforeach; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>