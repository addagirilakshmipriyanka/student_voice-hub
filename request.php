<?php session_start(); 
error_reporting(0);
include('link.php');
$user=$_SESSION["user"];
$roll=$_SESSION["roll"];
$conn=mysqli_connect('localhost','root',"",'wt');
$sqll="select * from signup where username='$user' ";
$resultt = mysqli_query($conn, $sqll);
if ($resultt->num_rows > 0) {
  while($row = mysqli_fetch_assoc($resultt)) {
    $fname = $row["fname"];
    $mail  = $row["email"];
    $user  = $row["username"];
  }
}
$type_of_election = $_POST['type_of_election'];
$candidate_eligible = $_POST['candidate_eligible'];
$voter_eligible = $_POST['voter_eligible'];
$start_date_nomination = $_POST['start_date_nomination'];
$end_date_nomination = $_POST['end_date_nomination'];
$start_date_voting = $_POST['start_date_voting'];
$end_date_voting = $_POST['end_date_voting'];
$message = $_POST['description'];
$election_id = mt_rand(100000, 999999);
if (isset($_POST['submit'])) { 
$sql= "insert into election_requests values('$user','$roll','$election_id','$type_of_election','$candidate_eligible','$voter_eligible','$start_date_nomination','$end_date_nomination','$start_date_voting','$end_date_voting','$message','0')";
$_POST = array();
if(mysqli_query($conn,$sql)){
    echo '<script> confirm("Your Request Submitted")</script>';
}
else{
    echo '<script> alert("Try Again , Request not Submitted")</script>';   
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Request for Online Voting</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        a{
          text-decoration:none;
        }
        .top{
            height:11vh;
        }
        body{
            /* background-color: #87CEEB; */
            height: 100vh;
            overflow: hidden;
            background: linear-gradient(to bottom,#748C84,#B0C4BA, #FFFFFF);
            
        }
        .container {
            height: calc(100vh - 10px); /* Adjust as needed, considering any margins or paddings */
            overflow-y: auto; /* Enable vertical scrolling for the container */
        }
        .container::-webkit-scrollbar {
        width: 0; /* Hide scrollbar width */
        }
        .card {
            background-color:white ;
            max-width: 700px;
            border-radius:15px;
            margin: 0 auto;
            border:1px solid #113333;
            padding: 20px;
        }
        h1{
            font-size:40px;
            font-weight:700;
        }
        #eligibilityText,#candidateStartDate,#candidateEndDate,#votingStartDate,#votingEndDate{
            width:300px;
        }
        
        label{
            font-size:18px;
        }
        input[type='text']{
            background-color:#C0C0C0;
            border:1px solid #748C84;
        }
        select:hover{
            background-color: #C0C0C0;
        }
        @media (max-width: 991px) {
        
        #eligibilityText,#candidateStartDate,#candidateEndDate,#votingStartDate,#votingEndDate{
            width:200px;
        }
        label{
            font-size:12px;
        }
        }



        /* pop up box */
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
<body>
    <?php include("Navbar.php"); ?>
    
    <div class="container">
    <div class="top"></div>
    <div class="card">
            <div class="card-body">
                <h1 class="text-center">Request for Election</h1>
                <form action="request.php" method="post" id="votingForm" name="myForm" onsubmit="return validateForm()">
                    <!-- Election Name -->
                    <br>
                    <div class="form-group">
                    
                        <label for="election">Election name :</label>
                        <select class="form-control custom-dropdown" id="electionName" name="type_of_election" required>
                            <option value="" selected disabled>Select an election</option>
                            <option>CR & GR</option>
                            <option>NSS</option>
                            <option>HHO</option>
                            <option>MESS_representative</option>
                            <option>dorm_representative</option>
                            <option>other</option>
                        </select>
                    </div>
                    <!-- Candidate Eligibility -->
                <div class="d-flex justify-content-between">
                    <div class="form-group">
                        <label for="eligibilityText">Candidate Eligibility :</label>
                        <select class="form-control custom-dropdown" id="eligibilityText" name="candidate_eligible" required>
                            <option value="" selected disabled>eligible candidates</option>
                            <option>O19</option>
                            <option>CSE</option>
                            <option>cse1</option>
                            <option>cse2</option>
                            <option>cse3</option>
                            <option>cse4</option>
                            <option>ECE</option>
                            <option>ece1</option>
                            <option>ece2</option>
                            <option>ece3</option>
                            <option>ece4</option>
                            <option>eee</option>
                            <option>civil</option>
                            <option>mech</option>
                        </select>
                    </div>
                    <!-- Voter Eligibility -->
                    <div class="form-group">
                        <label for="voterEligibilityText">Voter Eligibility :</label>
                        <select class="form-control custom-dropdown" id="eligibilityText" name="voter_eligible" required>
                            <option value="" selected disabled>Who can vote ?</option>
                            <option>O19</option>
                            <option>CSE</option>
                            <option>cse1</option>
                            <option>cse2</option>
                            <option>cse3</option>
                            <option>cse4</option>
                            <option>ECE</option>
                            <option>ece1</option>
                            <option>ece2</option>
                            <option>ece3</option>
                            <option>ece4</option>
                            <option>eee</option>
                            <option>civil</option>
                            <option>mech</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <!-- Candidate Start Date and Time -->
                    <div class="form-group">
                        <label for="candidateStartDate">Candidate Start Date and Time :</label>
                        <input type="text" class="form-control" id="candidateStartDate" name="start_date_nomination" required>
                    </div>
                    <div class="form-group">
                        <label for="candidateEndDate">Candidate End Date and Time :</label>
                        <input type="text" class="form-control" id="candidateEndDate" name="end_date_nomination" required>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <!-- Voting Start Date and Time -->
                    <div class="form-group">
                        <label for="votingStartDate">Voting Start Date and Time :</label>
                        <input type="text" class="form-control" id="votingStartDate" name="start_date_voting" required>
                    </div>
                    <div class="form-group">
                        <label for="votingEndDate">Voting End Date and Time :</label>
                        <input type="text" class="form-control" id="votingEndDate" name="end_date_voting" required>
                    </div>
                </div>
                    <!-- Description of the Election -->
                    <div class="form-group">
                        <label for="description">Description :</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                    </div>
                    <!-- Submit Button -->
                    <div class="text-center">
                        <button name="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var currentDate = new Date();
            var options = {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                minDate: currentDate,
            };

            flatpickr("#candidateStartDate", options);
            flatpickr("#candidateEndDate", options);
            flatpickr("#votingStartDate", options);
            flatpickr("#votingEndDate", options);
            
            // Validation to ensure candidate's start date and time, voter's start date and time,
            // and voter's end date and time have valid values
            $("#votingForm").submit(function(event) {
                var candidateStart = new Date(document.getElementById("candidateStartDate").value);
                var candidateEnd = new Date(document.getElementById("candidateEndDate").value);
                var votingStart = new Date(document.getElementById("votingStartDate").value);
                var votingEnd = new Date(document.getElementById("votingEndDate").value);
                
                if (candidateStart > candidateEnd) {
                    alert("Candidate start date and time cannot be greater than the candidate's end date and time.");
                    event.preventDefault();
                }
                
                if (votingStart < candidateEnd) {
                    alert("Voting start date and time cannot be less than the candidate's end date and time.");
                    event.preventDefault();
                }
                
                if (votingEnd < votingStart) {
                    alert("Voting end date and time cannot be less than the voting's start date and time.");
                    event.preventDefault();
                }
            });
        });

        function validateForm() {
            var x = document.forms["myForm"]["type_of_election"]["candidate_eligible"]["voter_eligible"]["start_date_nomination"]["end_date_nomination"]["start_date_voting"]["end_date_voting"]["description"].value;
            if (x == "") {
            alert("Name must be filled out");
            return false;
            }
        }
    </script>

    <?php
    // header("Location:request.php");
    exit();
    ?>

</body>
</html>

