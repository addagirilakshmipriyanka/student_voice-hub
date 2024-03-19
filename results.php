<?php session_start(); 
error_reporting();
include('link.php');
$election_id = $_POST["election_id"];
$election_name = $_POST["election_name"];
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

$sql="select * from completed_election where election_id='$election_id' ";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $vote_count = $row["vote_count"];
    $num  = $row["num_candidates"];
    $voters = $row["eligible_voter"];
    $completed_date = $row["completed_date"];
  }
}

$sql2 = "SELECT COUNT(*) as count FROM $voters";
$result2 = mysqli_query($conn, $sql2);
$row = mysqli_fetch_assoc($result2);
$total_voters = $row['count'];

$sql4 = "SELECT dates, vote_count FROM daily_count WHERE election_id = $election_id ORDER BY dates ASC";
$result4 = mysqli_query($conn, $sql4);
$dates = [];
$voteCounts = [];

if ($result4) {
    while ($row = mysqli_fetch_assoc($result4)) {  // Corrected to use $result4
        $dates[] = $row['dates'];
        $voteCounts[] = $row['vote_count'];
    }
}
$jsDates = array_map(function($date) {
  return date('Y-m-d', strtotime($date));
}, $dates);
// Convert PHP arrays to JSON for JavaScript
$jsDatesJSON = json_encode($jsDates);
$jsVoteCountsJSON = json_encode($voteCounts);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Election Information</title>
  <style>
    body {
      background-color:#ecf0f1; 
      overflow-x:hidden;
    }
    .top{
            height:12vh;
        }
    .header-section {
      padding: 20px;
    }

    .info-box {
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 5px;
      color: #fff;
      text-align: center;
    }

    #positions {
      background-color: #007bff; /* Blue */
    }

    #candidates {
      background-color: #28a745; /* Green */
      height: 110px;
    }

    #totalVoters {
      background-color: #dc3545; /* Red */
      height: 110px;
    }

    #votersVoted {
      background-color: #ffc107; /* Yellow */
    }

    .countdown-container {
      text-align: center;
      margin-top: 20px;
      background-color: #007bff; /* Blue */
      color: #fff;
      padding: 10px;
      border-radius: 5px;
    }

    .chart-container {
      width: 700px;
      height:700px;
      background-color: #ecf0f1; /* Light grey background for the chart container */
     
    }

    .results-container {
      background-color: #ecf0f1; /* Light blue background for the results container */
      padding: 20px;
      width:20px;
    }

    .candidate-container {
      background-color: #ecf0f1; /* Light grey background for each candidate container */
    }

/* For large screens */
@media (min-width: 992px) {
  .flex-container {
    display: flex;
  }

  .col-7 {
    flex: 0 0 70%; /* 70% width for col-7 */
  }

  .col-5 {
    flex: 0 0 30%; /* 30% width for col-5 */
  }
  .col-7,
  .col-5 {
    justify-content: center;
    align-items: center;
  }

}

/* For small screens */
@media (max-width: 991px) {
  .flex-container {
    display: block;
  }

  /* Reset flex properties for small screens */
  .col-7,
  .col-5 {
    flex: 0 0 100%; /* 100% width for both col-7 and col-5 */
  }
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
<body style="background-color: #ecf0f1;">
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

  <div class="header-section">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div id="positions" class="info-box">
            <h4>No. of Positions</h4>
            <p>2</p>
          </div>
        </div>

        <div class="col-md-3">
          <div id="candidates" class="info-box">
            <h4>No. of Candidates</h4>
            <p><?php echo $num; ?></p>
          </div>
        </div>

        <div class="col-md-3">
          <div id="totalVoters" class="info-box">
            <h4>Total Voters</h4>
            <p><?php echo $total_voters; ?></p>
          </div>
        </div>

        <div class="col-md-3">
          <div id="votersVoted" class="info-box">
            <h4>Voters Voted</h4>
            <p><?php echo $vote_count; ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="countdown-container">
        <h4>Results will disappear in <span id="countdown" class="countdown"></span></h4>
      </div>
    </div>
  </div>
  
  
  <div class="container mt-5">
    <div class="small-chart-container">
      <canvas id="myChart" width="80vw" height="20vh"></canvas>
    </div>
  </div>

  

  <!-- Bootstrap JS and Popper.js (required for some Bootstrap components) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    var days = <?php echo $jsDatesJSON; ?>;
    var votersData = <?php echo $jsVoteCountsJSON; ?>;
    console.log(days);
    var startDate = new Date(); // Replace with your election start date
    // Get the canvas element
    var ctx = document.getElementById('myChart').getContext('2d');

    // Create a new Chart instance
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: days,
        datasets: [{
          label: 'Number of Voters vote in each day',
          data: votersData.slice(0, 10),
          borderColor: 'rgba(52, 152, 219, 1)',
          backgroundColor: 'rgba(52, 152, 219, 0.2)',
          tension: 0.5,
          fill: true
        }]
      },
      options: {
        plugins: {
          title: {
            display: false
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 50
            }
          }
        }
      }
    });
  </script>

  <!-- Google Charts -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script>
    var completedDate = new Date("<?php echo $completed_date; ?>");
    // Set the date we're counting down to
    // var countDownDate = new Date("Nov 21, 2023 00:00:00").getTime();
    var countDownDate = new Date(completedDate.getTime() + 10 * 24 * 60 * 60 * 1000).getTime();

    // Update the countdown every 1 second
    var x = setInterval(function () {
      // Get the current date and time
      var now = new Date().getTime();

      // Calculate the remaining time
      var distance = countDownDate - now;

      // Calculate days, hours, minutes, and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Display the result in the element with id="countdown"
      document.getElementById("countdown").innerHTML = days + "d " + hours + "h " +
        minutes + "m " + seconds + "s ";

      // If the countdown is over, display a message
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("countdown").innerHTML = "Results Closed!";
      }
    }, 1000);
  </script>

  <div class="flex-container mt-5">
  <div class="col-7">
    <h3 class="xs-4 text-info"><center><br><br>selection of <?php echo $election_name; ?></center></h3>
      <div class="chart-container" id="chart"></div>
  </div>
  <div class="col-5">
  <h3 class="text-info"><center>winner in <?php echo $election_name; ?></center></h3>
    
    <?php
    $sql3 = "SELECT * FROM candidates WHERE election_id = '$election_id' ORDER BY vote_count DESC ";
    $result3 = mysqli_query($conn, $sql3);
    if ($result3->num_rows > 0) {
        while($row = mysqli_fetch_assoc($result3)){ 
      echo "<div class='card bg-primary'>";
      echo "<div class='card-body'>";
      echo "<h4>". $row['candidate_name'] ."</h4>";
      echo  "<p>Votes: <span>". $row['vote_count'] ."</span></p>";
      echo "</div></div>";
      echo "<br>";
        }
    }
    ?>
  </div>
</div>
</div>

<?php
$query = "SELECT candidate_name, vote_count FROM candidates WHERE election_id = '$election_id'";
$result4 = mysqli_query($conn, $query);
$data = array();
while ($row = mysqli_fetch_assoc($result4)) {
    $data[] = $row;
}
$chartData = array();
$chartData[] = ['Candidate', 'Votes'];

foreach ($data as $row) {
    $chartData[] = [$row['candidate_name'], (int)$row['vote_count']];
}
?>
<script>

  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    console.log(<?php echo json_encode($chartData); ?>);
    var data = google.visualization.arrayToDataTable(<?php echo json_encode($chartData); ?>);

    var options = {
      is3D: true,
      backgroundColor:'#ecf0f1'      };

    var chart = new google.visualization.PieChart(document.getElementById('chart'));
    chart.draw(data, options);
  }
</script>
</body>
</html>