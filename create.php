<?php
session_start();
error_reporting(0);

$electionName = $_POST['electionName'];
$numCandidates = $_POST['numCandidates'];
$eligiblevoter = $_POST['eligiblevoter'];
$votingStartTime = $_POST['votingStartTime'];
$votingEndTime = $_POST['votingEndTime'];
$message = $_POST['description'];
$election_id = mt_rand(100000, 999999);
$conn = mysqli_connect('localhost', 'root', '', 'wt');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    for ($n = 1; $n <= $numCandidates; $n++) {
        $candidate_name = mysqli_real_escape_string($conn, $_POST['candidateName' . $n]);
        $candidate_id = mysqli_real_escape_string($conn, $_POST['candidateID' . $n]);

        $sql2 = "INSERT INTO candidates (election_id, candidate_name, candidate_id,vote_count) VALUES ('$election_id', '$candidate_name', '$candidate_id',0)";

        mysqli_query($conn, $sql2);
    }

    $sql = "INSERT INTO admin_election  VALUES ('$election_id', '$electionName', '$eligiblevoter', '$numCandidates', '$votingStartTime', '$votingEndTime', '$message','Admin',0)";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Your Request Submitted");</script>';
    } else {
        echo '<script>alert("Try Again, Request not Submitted");</script>';
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Election System</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f0f0;
        }
        .container {
            background-color:white; /* Set the container background color to white */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px; /* Set a suitable form width */
            margin: 0 auto; /* Center the form on the page */
        }
        form{
            /* --tw-bg-opacity: 1; */
            /* background-color: rgb(31 41 55 / var(--tw-bg-opacity)); */
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

<?php
$_SESSION["name"] = $_POST["electionName"];
$_SESSION["sub"] = $_POST["eligiblevoter"];

?>

<body>
    <div class="container">
        <h3><center>election create by admin</centre></h1>
   <form id="votingForm" method="post" action="create.php">
            <!-- Election Name -->
            <div class="form-group">
                <label for="electionName">Election Name:</label>
                <input type="text" class="form-control" id="electionName" name="electionName" required>
            </div>

            <!-- Voter eligible -->
               <div class="form-group">
                        <label for="voterEligibilityText">Voter Eligibility :</label>
                        <select class="form-control custom-dropdown" id="eligiblevoter" name="eligiblevoter" required>
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
            
            <!-- Number of Candidates -->
            <div class="form-group">
                <label for="numCandidates">Number of Candidates:</label>
                <input type="number" class="form-control" id="numCandidates" name="numCandidates" min="1" required>
            </div>

            <!-- Candidate Information Divisions -->
            <div id="candidateDivisions">
                <!-- Candidate input divisions will be added here using JavaScript -->
            </div>
            
           
           <div class="form-group">
                        <div class="form-group">
                <label for="votingStartTime">voting Start Time:</label>
                <input type="datetime-local" class="form-control" id="votingStartTime" name="votingStartTime" required>
            </div>
            
            <div class="form-group">
                <label for="votingEndTime">voting End Time:</label>
                <input type="datetime-local" class="form-control" id="votingEndTime" name="votingEndTime" required>
            </div>
                    <!-- Description of the Election -->
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                    </div>
            
            <button type="submit" id="button" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>

    <!-- Include Bootstrap JS and jQuery (required for dynamic candidate input divisions) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Include Flatpickr JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // Add input divisions for candidate details based on the number entered
        $('#numCandidates').on('input', function () {
            const numCandidates = $(this).val();
            const candidateDivisions = $('#candidateDivisions');
            candidateDivisions.empty();

            for (let i = 1; i <= numCandidates; i++) {
                const candidateDivision = `
                <div class="card bg-light mb-3">
                    <div class="card-header">Candidate ${i} Information</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="candidateName${i}">Name:</label>
                            <input type="text" class="form-control" id="candidateName" name="candidateName${i}" required>
                        </div>
                        <div class="form-group">
                            <label for="candidateID${i}">ID:</label>
                            <input type="text" class="form-control" id="candidateID" name="candidateID${i}" required>
                        </div>
                    </div>
                </div>`;
                candidateDivisions.append(candidateDivision);
                
            }
        });
          // Initialize Flatpickr for candidate start and end time inputs
        const candidateStartTimeInput = document.getElementById("votingStartTime");
        const candidateEndTimeInput = document.getElementById("votingEndTime");

        flatpickr(candidateStartTimeInput, {
            enableTime: true,
            minDate: "today",
        });

        flatpickr(candidateEndTimeInput, {
            enableTime: true,
            minDate: "today",
        });

        // Validate candidate start and end times
        $('#votingForm').on('submit', function (event) {
            const startTime = new Date(candidateStartTimeInput.value).getTime();
            const endTime = new Date(candidateEndTimeInput.value).getTime();
            const now = new Date().getTime();
            const yesterday = new Date(now - 24 * 60 * 60 * 1000).getTime(); // 24 hours ago
 
            if (startTime >= endTime) {
                alert("voting start time should be earlier than the end time.");
                event.preventDefault(); // Prevent form submission
            }
            
            if (startTime <= yesterday || endTime <= yesterday) {
                alert("voting start and end times cannot be in the past 24 hours or earlier.");
                event.preventDefault(); // Prevent form submission
            }
        });
    </script>
     <script>
      for (let i = 1; i <= numCandidates; i++) {
                const candidateName = document.getElementById('candidateName').value;
                const candidateID = document.getElementById('candidateID').value;
                alert(candidateName);
             }
    </script>
</body>
</html>