<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="style1-1.css">
</head>
<?php
$_SESSION["count"]= 1;
?>
<body>
    <div class="sidebar">
        <h2>DASHBOARD</h2>
        <ul>
            <li id="section1"><img src="/home/bhargavi/Downloads/compose.png" alt="" height="20px" width="20px">&nbsp;&nbsp;Create Election</li>
            <li id="section2"><img src="/home/bhargavi/Downloads/compose.png" alt="" height="20px" width="20px">&nbsp;&nbsp;Requests</li>
            <li id="section3"><img src="/home/bhargavi/Downloads/compose.png" alt="" height="20px" width="20px">&nbsp;&nbsp;Monitoring Results</li>
            <li id="section4"><img src="/home/bhargavi/Downloads/compose.png" alt="" height="20px" width="20px">&nbsp;&nbsp;Student Database</li>
        </ul>
    </div>
    <div class="main-content" id="main-content">
        <h2>Welcome to the Admin Page</h2>
    </div>
       <script src="ascript.js"></script>

    </body>

</html>