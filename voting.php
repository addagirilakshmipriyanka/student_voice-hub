<!-- index.html -->
<?php session_start();
error_reporting(0);
include('link.php');
$conn=mysqli_connect('localhost','root',"",'wt');
$user = $_SESSION["user"];
$roll = $_SESSION["roll"];
$election_id = isset($_POST['election_id']) ? $_POST['election_id'] : null;
echo "<script> console.log('Election ID:', election_id) </script>";
$election_name = $_POST["election_name"];
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Election Voting</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-GLhlTQ8iKIo6ejiG8t0tZ1fNc5Jgg1gZa5F5R5uH1Q5qF5kKtWx5F5uLq5meM5C" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="voting.css">
</head>
<body>
<?php include("Navbar.php"); ?>
<div class="top"></div>
    <header class='d-flex justify-content-center' >
        <h1><?php echo $election_name; ?></h1>
    </header>
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

    <main>
<div id="candidates-container" class="candidates-container">
            <!-- Candidate profiles with profile photos will be dynamically added here -->
<?php
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM candidates where election_id='$election_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='candidates-container'>"; // Start the flex container
    while($row = $result->fetch_assoc()) {
        echo "<div class='candidate-list'>";
        echo "<div class='candidate-card'onclick='selectCard(this)' data-candidate-id='" . $row['candidate_id'] . "' id='card'>";
        if(male($row['candidate_id'],$conn)){
            echo "<img src='Male.jpg' class='profile-photo'>";
        }
        else{
        echo "<img src='female.jpg' class='profile-photo'>";
        }
        echo "<div>";
        echo "<h2>". $row['candidate_name'] ."</h2>";
        echo "<h5 class='card-title'>" . $row['candidate_id'] . "</h5>";
        echo "<button class='vote-button'>Vote</button>";
        echo "</div>";
        echo "</div> <br>";
        echo "</div>";
    }
    echo "</div>"; // End the flex container
} else {
    echo "No election requests";
}
            
    echo "</div>";
    echo "<div id='vote-info' class='vote-info'></div>";
    echo "<div class='submit-container'>";
    echo "<button class='submit-button' onclick='confirmation($election_id);'>Submit</button>";
    echo "</div>";
?>
    <br>
    <marquee id="quoteMarquee" behavior="scroll" direction="left" scrollamount="8">
    <!-- The quotes will be displayed here -->
    </marquee>
    
    </main>

   
    <footer>
        <p>&copy; 2023 Online Election Voting</p>
    </footer>

<?php

function male($id,$conn){
    $sql0 = "SELECT * FROM o19 where ID ='$id'";
    $result0 = $conn->query($sql0);
    if ($result0->num_rows > 0) {
        while($row = $result0->fetch_assoc()) {
            if($row['Gender']=='M'){
                return true;
            }
            else{
                return false;
            }
        }
    }
}
?>
<script src="voting.js">
</script>
</body>
</html>

