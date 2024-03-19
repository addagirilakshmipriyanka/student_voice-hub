<?php
session_start();
error_reporting(0);
?>
<html>
<head> 
<?php 
include("link.php");
?>
<title>Signin | Student-Voice-Hub</title>
<style>
html{
margin:0px;
padding:0px;
overflow-x:hidden;
}
a{
  text-decoration:none;
  color:blue;
}
h3{
  color:red;
  position:relative;
  bottom:3px;
}
.row{
  height: 100%;
}
.row2{
  height:10%;
  display:flex;
  text-align:center;
  position:relative;
  top:50px;
  left:40px;
}
.row3{
  height:90%;
  background-image:url("bg6.jpg");
  background-position: center; 
  background-size: cover;
  background-repeat: no-repeat;
}
.right{
  background-image: linear-gradient(to left, #fd5c63 , white);
}
.std{
background: rgba(255, 255, 255, 0.81);
backdrop-filter: blur(6.9px);
-webkit-backdrop-filter: blur(6.9px);
border: 1px solid rgba(255, 255, 255, 0.3);
width:450px;
border-radius:10px;
box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 1.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
margin-top:15vh;
}
table{
text-align:center;
}
td{
height:3vh;
}
input[type=text],[type=password]{
width:15vw;

background-color: #F6F6F6;
    padding: 0px 5px;
    border: 1px solid grey;
    border-radius: 6px;
    overflow: hidden;
    justify-content: flex-start;
}
input[type=submit]{
  background-color:#4CAF50;
  color:white;
  border:none;
  border-radius:4px;
  padding:8px 20px;
}
.error{
color:red;
font-size:15px;
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

@media (max-width:770px) {
  .std{
    width:60vw;
    height:70vh;
  }
  td{
    display:block;
    height:20px;
  }
  input[type=text],[type=password]{
    width:250px;
    border-radius:10px;
  }
  input[type=submit]{
    margin-top:10px;
  }
  lable{
    font-size: 18px;
    margin-bottom:3px;
    color: black;
    margin-left:20px;;
    display:flex;
    font-family:'poppins',sans-serif;
   }
}
</style>
</head>
<body>

<?php
global $x , $y;
$username=$_POST["username"]; 
$password=$_POST["password"];
$fname=$_POST["fname"];
$lname=$_POST["lname"];
$email=$_POST["email"];
$_SESSION["uname"]=$username;
$_SESSION["pass"]=$password;
$_SESSION["fname"]=$fname;
$_SESSION["lname"]=$lname;
$_SESSION["email"]=$email;
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);
$con=mysqli_connect('localhost','root'," ",'wt');
$_SESSION["name"] = $username;
$regex = '/^[Oo]\d+@rguktong\.ac\.in$/';
?>
<div class="row">
  <div class="col-md-4 d-md-inline d-sm-none left">
  <div class="row2"><h4>The&nbsp;</h4><h3>Ballot&nbsp;</h3><h4>is Stronger than the</h4><h3>&nbsp;Bullet.</h3></div>
  <div class="row3"></div>
  </div>
  <div class="col-md-8 col-12 right">
<form action = "<?php $_PHP_SELF ?>" method="post">
<center>
<div class="std">
<h1 style="margin-top:10px"><img src="logo.png">CREATE ACCOUNT</h1>
<hr color=black />

<?php
$V_code = mt_rand(100000, 999999);
$_SESSION["otp"]=$V_code;
?>

<table>
<tr><td>
<lable>*First name:</lable>
</td>
<td>
<input type=text name=fname autocomplete=off required >
</td></tr>
<tr><td></td></tr>
<tr>
<td>
<lable>Last name:</lable></td>
<td><input type=text name=lname autocomplete=off ></td></tr><tr><td></td></tr>
<tr><td>
<lable>*Email:</lable></td>
<td><input type=text name=email autocomplete=off placeholder=" Id@rguktong.ac.in" required></td></tr>
<tr><td colspan=2>
<?php


 $sql3="select * from signup where email='$email' ";
 $result=mysqli_query($con,$sql3);
 $result2 = mysqli_num_rows($result);
 if($result2 != "0"){
 ?>
<p class="error">Already Account Existed On this Email !</p>
<?php
   mysqli_free_result($result);
 }

elseif (preg_match($regex, $email)) {
  $Vmail=$email;
  $x="t";
}
else{
  ?>
 <p class="error">*Invalid Email format | Use college mail</p>
<?php
}
?>
</td></tr>
<tr><td>
<lable>*username:</lable></td>
<td><input type=text name=username autocomplete=off required>
</td></tr>
<tr><td></td><td>
<?php
$sql2="select * from signup where username=`$username` ";
$res = mysqli_query($con,$sql2);
while($data= mysqli_fetch_array($res))
{ ?>
 <h4 style="color:red;">*username already exists</h4>
<?php
} 
?>
</td></tr>
<tr><td>
<lable>*password:</labke></td>
<td><input type=password name=password autocomplete=off placeholder=" 8+ (a, A, 1, #)" required >
</td></tr>
<tr><td></td><td>
<?php
if($password==null){
}
elseif(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) 
{ ?>
 <div class="error">
  *Password should be at least 8 characters,<br>
 one upper case letter, one digit,and one special character.
 </div>
<?php
}
else{
   $y="t";
}
?>
</td></tr>
<table>
<input type=submit value="Submit">
<br>
<p style=" font-family:'poppins',sans-serif;font-size: 18px;">Already have an account?<a href="login.php">Sign in</a></p>
</div>
</center>
</form>
</div>
</div>
<?php
 include("send.php");
if($x=="t" && $y=="t"){
  if(send_mail("student.voice.hub.999@gmail.com","Student-Voice-Hub", $Vmail,"User","OTP-Verify","$V_code : is your Student verification code")){
   header("location:otp.php");
  }
  else{
    echo "Network Connection Lost";
  }
}
else{
echo "error";
}
?>
</body>
</html>
