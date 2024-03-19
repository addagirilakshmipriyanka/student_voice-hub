<?php 
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
    margin:0px;
    padding:0px;
    box-sizing:border-box;
}
.container{
    width:100%;
    min-height: 100vh;
    background-color:lightgrey;
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    padding: 0px 90px;
}
.content-section{
    display:flex;
    justify-content: center;
    align-items: center;
    text-align: center;
}
.content-section .card{
    flex:1;
    margin: 20px 150px;
    /* background-color:white; */
}
.content-section .card .cir {
    width: 150px;
    height: 150px;
    border-radius: 50%; /* Creates a circular shape */
    overflow: hidden; /* Clips content outside the circular shape */
    background-color: #fff; /* Background color for the circle */
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 60px;
    margin-right: 60px;
    margin-top: 20px;
    margin-bottom:40px;

}
.content-section .card .cir img{
    width:80%;
    height:60%;
    background-color: #ffffff;
}
.content-section .card a{
    margin: 50px 0px;
    font-size:15px;
    text-decoration: none;
    color:#113333;
    
}

@media screen and (max-width:768px){
    .content-section{
        flex-direction:column;
    }
}

    </style>
</head>
<body>
    <?php include("Navbar.php"); ?>
    <div class="container">
        <div class="content-section">
            <div class="card">
                <a href="display.php">
                <div  class="cir">
                <img class="circular-image" src="nomi.png" alt="Diverse group of people using digital devices for online elections">
                </div>
                <h1>NOMINATION</h1>     
            </div>
        
            <div class="card">
                <a href="display2.php">
                <div  class="cir">
                <img class="circular-image" src="vt.png" alt="Diverse group of people using digital devices for online elections">
                </div>
                <h1>VOTING</h1>
            
            </div>
        </div>
    
    </div>
</body>
</html>