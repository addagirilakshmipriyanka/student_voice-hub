<?php
// delete_election.php

if (isset($_POST['election_id'])) {
    $election_id = $_POST['election_id'];

    // Perform the deletion in the database
    $query = "DELETE FROM completed_election WHERE election_id = $election_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request";
}
?>
