<?php
session_start();
$roll = $_SESSION["roll"];
$candidateId = $_POST['candidateId'];
$electionId = $_POST['electionId'];
$currentDate = date('Y-m-d');
$conn=mysqli_connect('localhost','root',"",'wt');
$query = "UPDATE candidates SET vote_count = vote_count + 1 WHERE election_id = '$electionId' and candidate_id = '$candidateId'";
$result = $conn->query($query);
$query2 ="INSERT into voted (election_id, user_id) values('$electionId','$roll')";
$result2 = $conn->query($query2);
$query3 = "UPDATE admin_election SET vote_count = vote_count + 1 WHERE election_id = '$electionId' ";
$result3 = $conn->query($query3);
$sqlCheck = "SELECT * FROM daily_count WHERE election_id = $electionId AND dates = '$currentDate'";
$resultCheck = $conn->query($sqlCheck);

if ($resultCheck->num_rows > 0) {
    // If a record exists, update the vote count
    $sqlUpdate = "UPDATE daily_count SET vote_count = vote_count + 1 WHERE election_id = $electionId AND dates = '$currentDate'";
    $conn->query($sqlUpdate);
} else {
    // If no record exists, insert a new record
    $sqlInsert = "INSERT INTO daily_count (election_id,dates, vote_count) VALUES ($electionId, '$currentDate', 1)";
    $conn->query($sqlInsert);
}


if ($result && $result2 && $result3) {
        echo 'true';
} else {
    echo 'false';
}
$conn->close();
?>
