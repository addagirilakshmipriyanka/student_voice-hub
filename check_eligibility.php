<?php
$roll = $_POST['roll'];
$voterEligible = $_POST['voterEligible'];
$election_id = $_POST['electionId'];
$conn=mysqli_connect('localhost','root',"",'wt');
$query = "SELECT COUNT(*) FROM $voterEligible WHERE ID = '$roll'";
$result = $conn->query($query);
$query2 ="SELECT COUNT(*) FROM voted WHERE election_id = '$election_id' and user_id = '$roll' ";
$result2 = $conn->query($query2);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['COUNT(*)'] > 0) {
        if ($result2->num_rows > 0) {
            $row2 = $result2->fetch_assoc();
            if ($row2['COUNT(*)'] > 0) {
                echo 'not';
            }
            else{
                echo 'true';
            }
        }
    } 
    else {
        echo 'false';
    }
} else {
    echo 'false';
}
?>
