<!DOCTYPE html>
<?php session_start();
error_reporting(0);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <style>
        body {
            margin: 0;
            display: flex;
            justify-content: center;
            height: 100vh;
            background-color: #0000; /* Set your desired background color */
            overflow: hidden;
        }
        .top{
            height:12vh;
        }
        img {
            width: 60vw;
            height: 110vh;
        }
    </style>
</head>
<?php include("Navbar.php"); ?>
<body>
<div class="top"></div>
    <img src="thankyou.jpg" alt="Thank You Image">
</body>
</html>
