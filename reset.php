<?php
session_start();
?>
<?php
$con=mysqli_connect('localhost','root',"",'wt');
if(isset($_POST["username"])){
  $username=$_POST["username"]; 
}else{
$username="Unknown";
}

if(isset($_POST["password"])){
  $password=$_POST["password"];
}else{
$password = "";
}
global $res;
$_SESSION["username"]=$username;
$_SESSION["password"]=$password;
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);
?>
<?php
include("send.php");
$V_code = mt_rand(100000, 999999);
$_SESSION["code"]=$V_code;
?>
<html>
<head>
<?php include("link.php"); ?>
<title>Reset | Student-Voice-Hub</title>
<style>
html,body{
margin:0px;
padding:0px;
overflow-x:hidden;
overflow-y:hidden;
}
.row{
  height:100%;
}
.row2{
  background-image:url("bg7.jpg");
  background-position: center; 
  background-size: cover;
  background-repeat: no-repeat;
  height:90%;
}
.row3{
  font-family: cursive;
  display:flex;
  position:relative;
  bottom:60px;
  left:70px;
}
.right{
  background-image: linear-gradient(to left,#7CB9E8 , white);
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
width:450px;
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
justify-content:space-evenly;
}
.error{
color:red;
}
h3{
  color:red;
  position:relative;
  bottom:2px;
}
input[type=text],[type=password]{
width:15vw;
}
.btn{
width:5vw;
}
img{
width:70px;
height:70px;
position:relative;
right:10px;
}
label{
  font-size:20px;
}
</style>
</head>
<body>
<div class="row">
<div class="col-md-5 d-md-inline d-sm-none left">
  <div class="row2"></div>
  <div class="row3"><h3>Oops&nbsp;</h3><h4>Forgot password ....</h4><h3>reset it!</h3></div>
</div>
<div class="col-md-7 right">
<form action = "<?php $_PHP_SELF ?>" method="post">
<center>
<div class="std">
<h1><img src="logo.png">RESET PASSWORD</h1><hr>
<table><tr><td>
<label>Username:</label><input type=text name="username" autocomplete=off required></td></tr>
<tr><td></td></tr>
<tr><td>
<label>New Password:</label><input type=password name="password" autocomplete=off required></td></tr>
<tr><td>
<?php
$sql="select * from signup where username='$username' ";
$result = mysqli_query($con, $sql);
if ($result->num_rows > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $email = $row["email"];
  }
}

if($password==null){
}
elseif(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) { ?>
 <div class="error">
  *Password should be at least 8 characters,<br>
 one upper case letter, one digit,and one special character.
 </div>
<?php }
else{
  if(send_mail("student.voice.hub.999@gmail.com","Student-Voice-Hub", $email,"User","OTP-Verify","$V_code : is your Student verification code")){
    header("location:otp2.php");
  }
}
?>
</td></tr>
<tr><td></td><td><button class="btn btn-primary" onclick=alrt()>Reset</button></td></tr>
</table>
<b>back to login--><a href="login.php">login</a></b>
</div>
</center>
</form>
</div>
</div>

<script>
  function alrt(){
    alert "otp sent to your mail";
  }
</body>
</html>

