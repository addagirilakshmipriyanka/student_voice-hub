<?php
session_start();
error_reporting(0);

$election_id = $_POST["election_id"];
$candidate_id = $_POST["candidate_id"];

$conn = mysqli_connect('localhost', 'root', '', 'wt');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE candidates SET votes = votes + 1 WHERE election_id = '$election_id' AND candidate_id = '$candidate_id'";

if ($conn->query($sql) === TRUE) {
    echo "Vote updated successfully";
} else {
    echo "Error updating vote: " . $conn->error;
}

$conn->close();
?>