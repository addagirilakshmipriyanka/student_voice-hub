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
    @import url('https://fonts.googleapis.com/css2?family=GT+Walsheim+Pro&display=swap');
body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            /* overflow: hidden; Prevent body from scrolling */
        }
.top{
    height:12vh;
}
img{
    position:relative;
    top:12vh;
}
h2{
    position:relative;
    top:13vh;
    left:6vw;
    font-family: 'GT Walsheim Pro', 'Helvetica';
    text-shadow: 1px 1px 5px #555; 
}
.card{
    width:750px;
    border:1px solid #113333;
}
form{  
    width:700px;
    border-radius:10px;
}
@media (max-width: 991.98px) {
    .card{
    width:600px;
    border:1px solid #113333;
}
form{
    width:550px;
}
} 
.card:hover{
   
    transform: scale(1.01);
    z-index: 1;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}
#left-column {
            width: 500px;
            z-index:1;
            position: fixed;
            top: 0;
            bottom: 0;
            overflow: hidden; /* Hide scrollbar in the left column */
        }
#right-column {
          text-align:center;
          margin-top:40px;
            flex: 1;
            overflow-y: auto; /* Allow scrolling in the right column */
            padding: 20px;
            display: flex;
            flex-direction: column; /* Elements in the right column as a column */
            align-items: flex-end;
            background: linear-gradient(to bottom, #D2E3CC, #FFFFFF);

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
<div id='left-column' class='d-none d-md-block'>
    <img src='results.png' width='100%'></img>
    <h2>"Results speak the language <br>&nbsp;of effort and commitment."</h2>
</div> 
<div id='right-column'>
<?php

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$indianTimeZone = new DateTimeZone('Asia/Kolkata');
$indianCurrentDate = new DateTime('now', $indianTimeZone);
$indianCurrentDateString = $indianCurrentDate->format('Y-m-d H:i:s');
$sql = "SELECT * FROM completed_election ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $completed_date = $row['completed_date'];
        $election_id = $row['election_id'];
        echo "<div class='card mb-3 m-4'>";
        echo "<div class='card-body'>";
        $formattedVotingStart = date('Y-m-d H:i:s', strtotime($row['completed_date']));
        $formattedVotingStart = htmlspecialchars($formattedVotingStart, ENT_QUOTES);
        $indianCurrentDateString = htmlspecialchars($indianCurrentDateString, ENT_QUOTES);
        echo "<form id='myForm_" . $row['election_id'] . "' action='results.php' method='post' >";
        echo "<button style ='border:0;background-color:white; 'class='w-100' id='button' name='submit'>";
        echo "<div class='d-flex w-100 justify-content-between'";
        echo "<h4 style='font-size:25px;'>" . $row['election_name'] ."&nbsp;&nbsp". $row['eligible_voter'] ." </h4>";
        echo "<input type='hidden' name='election_name' value='" . $row['election_name'] . "'>";
        echo "<input type='hidden' name='election_id' value='" . $row['election_id'] . "'>";
        echo "<h6 class='card-title'>Election ID:" . $row['election_id'] . "</h6>";
        echo "</div> <br>";
        echo "<div class='d-flex w-100 justify-content-between'";
        $votingStartTimestamp = strtotime($formattedVotingStart);
        $countDownTimestamp = $votingStartTimestamp + (10 * 24 * 60 * 60);
        $currentTimestamp = strtotime($indianCurrentDateString);
        if ($countDownTimestamp < $currentTimestamp) {
             $query5 = "DELETE FROM completed_election WHERE election_id = $election_id";
             $result5 = mysqli_query($conn, $query5);
        }
        echo "<p class='card-text'>Eligible candidates: " . $row['eligible_voter'] . "</p>";
        echo "<h6 style='color:#ff8c00'>Completed on <span class='bi bi-clock' style='font-size: 1.2em;'>&nbsp;". $formattedVotingStart ."</span></h6>";
        echo "</div>";
        echo "</button>";
        echo "</form></div></div>";
    }
} else {
    echo "No Completed elections";
}

?>
</div>
</body></html>
