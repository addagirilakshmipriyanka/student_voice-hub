<?php
session_start();
error_reporting(0);
?>

<html>
<head>

  <?php include("link.php"); ?>
  
<title>Login | Student-Voice-Hub</title>

<style>
html{
margin:0px;
padding:0px;
overflow-x:hidden;
}
.back{

  background-image: linear-gradient(to right, #28282B , white);
  background-position: center; 
  background-size: cover;
  background-repeat: no-repeat;
}
a{
  text-decoration:none;
}
input[type=submit]{
  background-color:#4CAF50;
  color:white;
  border:none;
  border-radius:4px;
  padding:8px 20px;
}
.std{
background: rgba(255, 255, 255, 0.8);
backdrop-filter: blur(6.9px);
-webkit-backdrop-filter: blur(6.9px);
border: 1px solid rgba(255, 255, 255, 0.3);
width:350px;
height:420px;
border-radius:14px;
margin-top:20vh;
box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 1.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
text-align: center;
}
.error{
color:red;
}
.row{
  height:100%;
}
.row2{
  height:40%;
}
.row3{
  height:40%;
  text-align:center;
  color:white;
}
.row4{
 display:flex;
}
.left{
  background-image:url("bg.jpg");
  background-position: center; 
  background-size: cover;
  background-repeat: no-repeat;
  white-space: nowrap;
}
img{
width:70px;
height:70px;
position:relative;
right:5px;
}
nav{
height:20px;
}
label{
  font-family:'poppins',sans-serif;
  font-size:18px;
}
input{
font-size:15px;
}
h3{
  color:#FF5733;
  position:relative;
  bottom:2px;
}

.end{
margin-top:10px;
}
</style>
</head>
<body>
<div class="row">
<div class="col-12 col-md-7 back">
<form action = "<?php $_PHP_SELF ?>" method="post">
<center>
<div class="std">
<h2 style="margin-top:10px"><img src="logo.png">VOTER LOG IN</h2>
<hr>
<label><b>Username:</b></label><input type=text name="username" autocomplete=off required><br><br>
<label><b>Password:</b></label><input type=password name="password"autocomplete=off required>
<?php
$con=mysqli_connect('localhost','root',"",'wt');
$username=$_POST["username"]; 
$_SESSION["user"]=$_POST["username"];
$password=$_POST["password"];
$sql2="select * from signup where username='$username' ";
$res = mysqli_query($con,$sql2);
$sql3="select * from signup where password='$password' ";
$res2 = mysqli_query($con,$sql3);
if($data= mysqli_fetch_array($res))
{ 
 if($data= mysqli_fetch_array($res2)){
     header("Location:main.php");
 }
 else{?>
  <div class="error">*Wrong Password<br> forgot password---> <b><a href="reset.php">reset</a></b></div>
<?php }
}
elseif($username==null){

}
else{
 ?>
<p style="color:red">*Account not found with this username.</p>
<?php } ?><br>
<div class="end">
  <br>
<input type=Submit value=submit>
<br><br>
<label>Create your account ---></label><a href=signup.php>Signup</a>
<br>
</div>
</div>
</center>
</form>
</div>
<div class="col-md-5 d-md-inline d-sm-none left ">
  <div class="row2"></div>
  <div class="row3"></div>
  <div class="row4"><h4>Your</h4>&nbsp;<h3>Voice</h3>&nbsp;<h4>-</h4>&nbsp;<h4>Your</h4>&nbsp;<h3>Choice</h3></div>
</div>
</div>
</body>
<?php
session_close();
?>
</html>
