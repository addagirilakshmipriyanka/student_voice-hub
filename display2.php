<!DOCTYPE html>
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
.top{
    height:11vh;
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
/* end  */
form{  
    border-radius:10px;
}
.card:hover{
    transform: scale(1.01);
  z-index: 1;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}
.open-for-voting:hover {
    border: 1px solid green;
    box-shadow: 0 0 10px rgba(0, 255, 0, 0.5); /* Green shadow */
}

.not-open:hover {
    border: 1px solid orange;
    box-shadow: 0 0 10px rgba(255, 165, 0, 0.5); /* Orange shadow */
}
.already-voted:hover {
    border: 1px solid blue;
    box-shadow: 0 0 10px rgba(0, 0, 255, 0.5);
}
.not-permit:hover {
    border: 1px solid red;
    box-shadow: 0 0 10px rgba(255, 0, 0, 0.5); /* Red shadow */
}

</style>
</head>
<body>

<?php include("Navbar.php"); ?>
<div class="top"></div>
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
<div class="container">
<?php

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$indianTimeZone = new DateTimeZone('Asia/Kolkata');
$indianCurrentDate = new DateTime('now', $indianTimeZone);
$indianCurrentDateString = $indianCurrentDate->format('Y-m-d H:i:s');

$sql5 = "SELECT * FROM admin_election where voting_end <= '$indianCurrentDateString'";
$result5 = mysqli_query($conn, $sql5);

if ($result5) {
    while ($row = mysqli_fetch_assoc($result5)) {
         $election_id = $row['election_id'];
         $insertquery = "INSERT INTO completed_election VALUES ('$election_id', '{$row['election_name']}', '{$row['eligible_voter']}', '{$row['no_candidates']}', '{$row['voting_end']}', '{$row['vote_count']}')";
         mysqli_query($conn, $insertquery);
        $deleteQuery = "DELETE FROM admin_election WHERE election_id = '{$row['election_id']}'";
        mysqli_query($conn, $deleteQuery);
    }
} 
$sql = "SELECT * FROM admin_election ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $voter_eligible = $row['eligible_voter'];
        $election_id = $row['election_id'];
        echo "<div class='card mb-3 m-4";

        if ($row['voting_start'] > $indianCurrentDateString) {
            echo " not-open"; 
        } elseif (isUserEligible($roll, $voter_eligible, $conn)) {
           if(alreadyvoted($election_id,$roll,$conn)){
            echo " already-voted";
           }
           else{
            echo " open-for-voting";
            }
        } else {
            echo " not-permit";
        }
        
        echo "'>";
        
        echo "<div class='card-body'>";
        $election_id = $row['election_id'];
        $formattedVotingStart = date('Y-m-d H:i:s', strtotime($row['voting_start']));
        $formattedVotingStart = htmlspecialchars($formattedVotingStart, ENT_QUOTES);
        $indianCurrentDateString = htmlspecialchars($indianCurrentDateString, ENT_QUOTES);
        $roll = htmlspecialchars($roll, ENT_QUOTES);
        $voter_eligible = htmlspecialchars($voter_eligible, ENT_QUOTES);
        echo "<form id='myForm_" . $row['election_id'] . "' action='voting.php' method='post' onsubmit='return validateForm(\"$formattedVotingStart\", \"$indianCurrentDateString\", \"$roll\", \"$voter_eligible\", \"" . $row['election_id'] . "\")'>";
        echo "<button style ='border:0;background-color:white; 'class='w-100' id='button' name='submitbutton'>";
        echo "<div class='d-flex w-100 justify-content-between'";
        echo "<h4 style='font-size:25px;'>" . $row['election_name'] ."&nbsp;&nbsp". $row['eligible_voter'] ." </h4>";
        echo "<input type='hidden' name='election_name' value='" . $row['election_name'] . "'>";
        echo "<input type='hidden' name='election_id' value='" . $row['election_id'] . "'>";
        echo "<h6 class='card-title'>Election ID:" . $row['election_id'] . "</h6>";
        echo "</div> <br>";
        echo "<div class='d-flex w-100 justify-content-between'";
        echo "<p class='card-text'>Eligible candidates: " . $row['eligible_voter'] . "</p>";
        if($row['voting_start'] <= $indianCurrentDateString ){
            if(alreadyvoted($election_id,$roll,$conn)){
                echo "<h5 style='color:blue'>Already voted <i class='fas fa-check-circle'></i></h5>";
            }
            elseif (isUserEligible($roll, $voter_eligible, $conn)) {
            echo "<h5 style='color:green'>Vote&nbsp;Now&nbsp;<span class='bi bi-check' style='font-size: 1.2em;'></span></h5>";
            }
            else{
            echo "<h5 style='color:red'>Not Permitted&nbsp;<span class='bi bi-x' style='font-size: 1.2em; color: red;'></span></h5>";
            }
        }
        else{
            echo "<h5 style='color:#ff8c00'>Not opened <span class='bi bi-clock' style='font-size: 1.2em;'></span></h5>";
        }
        echo "<small class='d-none d-md-block'>created by ". $row['user_name'] ."</small>";
        echo "</div>";
        echo "</button>";
        echo "</form></div></div>";
    }
} else {
    echo "No election requests";
}?>
</div>
<script>
function validateForm(votingStart, currentDateString, roll, voter_eligible, electionId) {
    var form = document.getElementById("myForm_" + electionId);
    if (votingStart > currentDateString) {
        alert('The Election Opens for Voting on ' + votingStart);
        return false;
    } else {
            checkEligibility(roll, voter_eligible,electionId, function(response) {
            console.log("Server Response: " + response);
            if (response === "true") {
                console.log("User is eligible");
                // Submit the form programmatically
                form.submit();
            }else if(response === "false") {
                alert('You are not eligible to vote.');
            }
            else{
                alert('You Already Voted.');
            }
        });
        return false; // Prevent form submission for now
    }
}

function checkEligibility(roll, voter_eligible,electionId, callback) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "check_eligibility.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Call the callback function with the response
                callback(xhr.responseText.trim());
            }
        }
    };
    xhr.send("roll=" + roll + "&voterEligible=" + voter_eligible + "&electionId=" + electionId);
}


</script>
<?php

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

function alreadyvoted($election_id ,$roll ,$conn){
    $query2 ="SELECT COUNT(*) FROM voted WHERE election_id = '$election_id' and user_id = '$roll' ";
    $result2 = $conn->query($query2);
    if($result2->num_rows > 0){
        $row2 = $result2->fetch_assoc();
        return $row2['COUNT(*)'] > 0;
    }
    else{
        return FALSE;
    }

}
?>

</body></html>
