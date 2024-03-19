<?php
session_start();
?>
<?php
$con=mysqli_connect('localhost','root',"",'wt');
if(isset($_POST["otp"])){
  $otp=$_POST["otp"]; 
}else{
$otp="";
}
global $res;
$code = $_SESSION["code"];
$username=$_SESSION["username"];
$password=$_SESSION["password"];
?>

<html>
<head>
<title>OTP | Student-Voice-Hub</title>
<?php include("link.php"); ?>
<style>
body{
text-align:center;
}
.right{
  background-image:url("bg10.jpg");
  background-position: center; 
  background-size: contain;
  background-repeat: no-repeat;
}
.row{
  height:100%;
}
.left{
  background-image: linear-gradient(to right, #D0F0C0 , white);

}
a{
  text-decoration:none;
}
.std{
background: rgba(255, 255, 255, 0.81);
backdrop-filter: blur(6.9px);
-webkit-backdrop-filter: blur(6.9px);
border: 1px solid rgba(255, 255, 255, 0.3);
box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.8), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
width:400px;
border-radius:10px;
margin-top:20vh;
}
h1{
margin:10px;
}
input[type=submit]{
  background-color:#4CAF50;
  color:white;
  border:none;
  border-radius:4px;
  padding:8px 20px;
}
td{
height:5vh;
display:flex;
justify-content:center;
}
.error{
color:red;
}
input[type=text],[type=password]{
width:15vw;
}
input[type=submit]{
width:8vw;
}
img{
width:70px;
height:70px;
position:relative;
right:10px;
}
lable{
  font-size:20px;
}

</style>
</head>
<body>
  <div class="row">
    <div class="col-md-5 left">
<form action = "<?php $_PHP_SELF ?>" method="post">
<center>
<div class="std">
<h1><img src="logo.png">OTP Verification</h1><hr>
<table><tr><td>
<lable>Enter your OTP</lable></td><td><input type=text name="otp" autocomplete=off required></td></tr>
<tr><td></td></tr>
<tr><td colspan=2>
<?php
if($otp==$code){
    $sql="update signup set password='$password' where username='$username' ";
    $res = mysqli_query($con, $sql);
}
else{
   echo "Enter Otp Correctly"; 
}
?>
</td></tr>
<tr><td colspan=2><input type=submit value=Verify></td></tr>
</table>
<b>back to login--><a href="login.php">login</a></b>
</div>
<?php
if($res)
{
    ?><h3 style="color:green;">Password Updated ! </h3>  <?php
}?>
</center>
</form>
</div>
<div class="col-md-7 d-md-inline d-sm-none right"></div>
</div>
</body>
</html>