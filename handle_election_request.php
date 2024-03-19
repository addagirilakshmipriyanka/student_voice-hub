<!-- handle_election_request.php (Handles Election Request Submission) -->

<?php
session_start(); // Start a PHP session

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type_of_election = $_POST['type_of_election'];
    $start_date_nomination = $_POST['start_date_nomination'];
    $end_date_nomination = $_POST['end_date_nomination'];
    $start_date_voting = $_POST['start_date_voting'];
    $end_date_voting = $_POST['end_date_voting'];

    // Store the details (you might want to use a database here)
    // Example using session variable for demonstration
    $_SESSION['new_election_request'] = array(
        'type_of_election' => $type_of_election,
        'start_date_nomination' => $start_date_nomination,
        'end_date_nomination' => $end_date_nomination,
        'start_date_voting' => $start_date_voting,
        'end_date_voting' => $end_date_voting
    );

    // Redirect back to the main page
    header("Location: index.php");
    exit();
}
