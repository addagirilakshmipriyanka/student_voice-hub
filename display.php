
<?php session_start();
error_reporting();
include("link.php");
$conn=mysqli_connect('localhost','root',"",'wt');
$user = $_SESSION["user"];
$roll = $_SESSION["roll"];
$sqll="select * from signup where username='$user' ";
$resultt = mysqli_query($conn, $sqll);
if ($resultt->num_rows > 0) {
  while($row = mysqli_fetch_assoc($resultt)) {
    $fname = $row["fname"];
    $mail  = $row["email"];
    $user  = $row["username"];
  }
}
?>

<!DOCTYPE html>
<head>
<style>
body{

            /* background-color: #87CEEB; */
            height: 100vh;
            overflow: hidden;
            background: linear-gradient(to bottom,#748C84,#B0C4BA, #FFFFFF);      
}
.container {
            height: calc(100vh - 60px); /* Adjust as needed, considering any margins or paddings */
            overflow-y: auto; /* Enable vertical scrolling for the container */
}
.container::-webkit-scrollbar {
        width: 0; /* Hide scrollbar width */
}
form{
    
    border-radius:10px;
}
.card:hover{
    transform: scale(1.01);
  z-index: 1;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}
.top{
    height:11vh;
}

.btn-primary:hover {
    transform: scale(1.05);
}
/* pop-up-box  */
p {
    font-size: 17px;
    align-items: center;
}
.box a {
    display: inline-block;
    background-color: #fff;
    padding: 15px;
    border-radius: 3px;
}
.modal {
    z-index: 100;
    align-items: center;
    display: flex;
    justify-content: center;
    position:fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    transition: all 0.4s;
    visibility: hidden;
    opacity: 0;
}
.content {
    position: absolute;
    background: white;
    width: 400px;
    height:400px;
    border:1px solid;
    padding: 1em 2em;
    border-radius: 4px;
}
.modal:target {
    visibility: visible;
    opacity: 1;
}
.box-close {
    position: absolute;
    top: 0;
    right: 15px;
    color: #fe0606;
    text-decoration: none;
    font-size: 30px;
}
</style>
</head>
<body>

<?php include("Navbar.php"); ?>
<div class="top"></div>
<div class="container">
<div id="popup-box" class="modal">
		<div class="content">
			<h1 style="color: green;">
				Hello <?php echo $fname; ?> !
			</h1><hr>
            <table>
            <tr >
            <td ><label>Username : </label></td><td><?php echo $user; ?></td></tr>
            <tr><td><label>Id : </label></td><td> <?php echo $roll; ?> </td></tr>
             <tr><td><label>E-mail : </label></td><td> <?php echo $mail; ?></td></tr>
             <tr colspan=2><td> Edit your profile <a href="register.php">here</a> </td></tr> 
            </table>
			<a href="#"
			class="box-close">
            <span class='bi bi-x' style='font-size: 1.2em; color: red;'></span>
			</a>
		</div>
</div> 
<?php

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
 
    // code for completed nominations post into voting 
    // Get current Indian date and time
$indianTimeZone = new DateTimeZone('Asia/Kolkata');
$indianCurrentDate = new DateTime('now', $indianTimeZone);
$indianCurrentDateString = $indianCurrentDate->format('Y-m-d H:i:s');

// SQL query with formatted end_date_nomination and Indian current date
    $sql5 = "SELECT * FROM election_requests WHERE admin_accepted = 1 AND end_date_nomination <= '$indianCurrentDateString'";
    $result5 = mysqli_query($conn, $sql5);
    
    if ($result5) {
        while ($row = mysqli_fetch_assoc($result5)) {
            $election_id = $row['election_id'];
            $sql6 = "SELECT COUNT(*) as candidate_count FROM candidates WHERE election_id='$election_id'";
            $result6 = mysqli_query($conn, $sql6);
            
            if ($result6) {
                $row2 = mysqli_fetch_assoc($result6);
                $candidateCount = $row2['candidate_count'];
            } else {
                $candidateCount = 0; // Default candidate count if there is an error in the query
            }
    
            // Insert completed Nomination records into the admin_election table
            $insertQuery = "INSERT INTO admin_election  VALUES ('{$row['election_id']}', '{$row['type_of_election']}', '{$row['voter_eligible']}', '$candidateCount', '{$row['start_date_voting']}', '{$row['end_date_voting']}', '{$row['message']}', '{$row['user_name']}',0)";
            mysqli_query($conn, $insertQuery);
    
            // Delete the completed election records from the election_requests table
            $deleteQuery = "DELETE FROM election_requests WHERE election_id = '{$row['election_id']}'";
            mysqli_query($conn, $deleteQuery);
        }
    } 




    $sql = "SELECT * FROM election_requests where admin_accepted=1 ";
    $result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='card mb-3 '>";
        echo "<div class='card-body'>";
        echo "<form action='display.php' method='post'>";
        echo "<div class='d-flex w-100 justify-content-between'";
        echo "<h4 style='font-size:25px;'>" . $row['type_of_election'] . "</h4>";
        echo "<input type='hidden' name='election_id' value='" . $row['election_id'] . "'>";
        echo "<h6 class='card-title'>Election ID:" . $row['election_id'] . "</h6>";
        echo "</div> <br>";
        echo "<div class='d-flex w-100 justify-content-between'";
        echo "<p class='card-text'>Eligible candidates: " . $row['candidate_eligible'] . "</p>";
        $formattedVotingStart = date('Y-m-d H:i:s', strtotime($row['start_date_nomination']));
        $candidate_eligible = $row['candidate_eligible'];
if($row['start_date_nomination'] <= $indianCurrentDateString){
    if (isUserEligible($roll, $candidate_eligible, $conn)) {
            $user_already_registered = false; 
        if (isUserRegistered($roll, $row['election_id'],$conn)) {
            $user_already_registered = true;
        }
       
        if ($user_already_registered) {
            echo "<h5 style='color:green'>Already Registered</h5>";
        } else {
            echo "<h5 class='d-none d-md-block'>Are you interested as candidate ?&nbsp;&nbsp;&nbsp;</h5>";
            echo "<button class='btn btn-primary' id='button' name='submit'>Register</button>";
        }
        }
    else{
        echo "<h5 style='color:red'>Not Permitted</h5>";
    }
}
else{
        echo "<h5>Nomination strats on &nbsp;". $formattedVotingStart."</h5>" ;
}

        echo "</div>";
        echo "<small>created by ". $row['user_name'] ."</small>";
        echo "<small>&nbsp;&nbsp; ". $row['id'] ."</small>";
        echo "</form></div></div>";
    }
} else {
    echo "No election requests";
}


if(isset($_POST["submit"])) {
    $election_id = mysqli_real_escape_string($conn, $_POST['election_id']);
    if(empty($election_id) || empty($user) || empty($roll)) {
        echo '<script>alert("Please Login !");</script>';
    } else {
        $sql2 = "SELECT candidate_name FROM candidates WHERE election_id='$election_id'";
        $result2 = $conn->query($sql2);

        // Check if the user is already registered for this election
        $existingCandidates = [];
        while($row = $result2->fetch_assoc()) {
            $existingCandidates[] = $row['candidate_name'];
        }

        if (in_array($user, $existingCandidates)) {
            echo '<script>alert("You are already registered for this Election!");</script>';
        } 
        else {
            // Insert the new candidate if not already registered
            $sql3 = "INSERT INTO candidates (election_id, candidate_name, candidate_id) VALUES ('$election_id', '$user', '$roll')";
            if ($conn->query($sql3) === TRUE) {
                echo '<script>alert("Your Request id ' . $election_id . ' has been accepted.");</script>';
                header("Location: display.php");
                exit();
            } else {
                // Handle error if the SQL query fails
                echo "Error: " . $conn->error;
            }
        }
    }
}

function isUserEligible($roll, $candidate_eligible, $conn) {
    $query = "SELECT COUNT(*) FROM $candidate_eligible WHERE ID = '$roll' ";
    $result0 = $conn->query($query);
    if($result0->num_rows > 0){
        $row0 = $result0->fetch_assoc();
        return $row0['COUNT(*)'] > 0;
    }
    else{
        return FALSE;
    }
}


function isUserRegistered($user_id, $election_id, $conn) {
    $sql4 = "SELECT COUNT(*) FROM candidates WHERE candidate_id='$user_id' AND election_id='$election_id'";
    $result4 = $conn->query($sql4);

    if ($result4->num_rows > 0) {
        $row = $result4->fetch_assoc();
        return $row['COUNT(*)'] > 0;
    } else {
        return false;
    }
}

mysqli_close($conn);
?>

</body>
</html>
