<?php
session_start();
error_reporting(0);
include("link.php");
?>

<html>  
<head>
<style>
    *{
	margin:0px;
	padding:0px;
	box-sizing:border-box;
	font-family:'Lato',sans-serif;;
	}
body{
background-color:#f2f2f2;
}
.heading{
width:90%;
display:flex;
justify-content:center;
align-items:center;
flex-direction:column;
margin:20px auto;
}
.heading h1{
	font-size:50px;
	color:#000;
	margin-bottom:25px;
	position:relative;
	letter-spacing:20px;
	}
.heading h1::after{
content:"";
position:absolute;
width:100%;
height:4px;
display:block;
margin:0 auto;
background-color:#4caf50;
}
.heading h2{
font-size:50px;
color:#666;
margin-bottom:35px;
word-spacing:10px;
letter-spacing:5px;
}
.container{
width:90%;
margin:0 auto;
padding:10px 20px;
}
.about{
display:flex;
justify-content:space-between;
align-items:center;
flex-wrap:wrap;
}
.about-image{
flex:1;
/* margin-right:40px; */
overflow:hidden;
}
.about-image img{
max-width:100%;
height:auto;
display:block;
transition:0.5% ease;
/* height:200px;
width:350px; */
margin-bottom:30px;
}
.about-image img:hover{
transform:scale(1.1);
}

.about-content h3{
font-size:30px;
margin-bottom:30px;
color:black;
font-family:sans-serif;
}
.about-content p{
font-size:20px;
line-height:18px;
color:#666;
}
.module{
margin-top:30px;
}
.module h3{
margin-bottom:15px;
font-family:sans-serif;
color:black;
font-size:25px;
}
.module p{
font-size:20px;
line-height:18px;
color:#666;
padding-bottom:15px;
}
.advantages{
margin-top:30px;
}
.advantages h3{
margin-bottom:15px;
font-family:sans-serif;
color:black;
font-size:25px;
}
.advantages p{
font-size:20px;
line-height:18px;
color:#666;
padding-bottom:15px;
}
.disadvantage{
margin-top:30px;
}
.disadvantage h3{
margin-bottom:15px;
font-family:sans-serif;
color:black;
font-size:25px;
}
.disadvantage p{
font-size:20px;
line-height:18px;
color:#666;
padding-bottom:15px;
}
.conclusion{
margin-top:20px;
}
.conclusion p{
font-size:20px;
line-height:18px;
color:#666;
padding-bottom:20px;
line-height:25px;
}
.conclusion h3{
font-size:30px;
font-family:sans-serif;
display:flex;
justify-content:center;
}
.follow-us-section {
  background-color: #f2f2f2;
}
.follow-us-section-heading {
  text-align: left;
  color: black;
  font-family: sans-serif;
  font-size: 30px;
  font-weight: 800px;
}
.follow-us-icon-container {
  background-color: gray;
  width: 80px;
  height: 80px;
  border-radius: 40px;
  margin: 15px;
  padding-top: 22px;
  padding-bottom: 14px;
  padding-right: 16px;
  padding-left: 22px;
}
.follow-us-icon-container:hover{
background-color:red;
color:black;
}
.icon {
  color:black;
  font-size:35px;
}

/* pop up box */
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

<?php include("Navbar.php"); ?>

</head>
<body>
<div id="nav-placeholder"></div>
<br><br>
<div class="heading">
<h1>About</h1>
<h2>Student Voice Hub</h2>
<p></p>
</div>
<div class="container">
<section class="about">
<div class="about-image">
<center><img src="logo.png" width="300px" height="300px"></center>
</div>
<div class="about-content">
<center><h3>Student Voice Hub Is A Student Elections In Our University</h3><center>
<p>Hello All!! Our website provides online elctions for students in RGUKT IIIT ongole.<br>With this web application we can conduct elections and cast our votes through online voting system.Using this we can acheive free and fair elections.<br>We can conduct various elections like Students CR and GR elections, mess representatives elections, HHO elections and also dorm leaders etc..</p>
<p>-> This project aims to create a fair,inclusive and democratic environment for campus elections,ensuring that every voice heard and evry votes counts.</p>
<p>-> The platform empowers both candidates and voters by providing a user friendly interface for nomination submissions,candidate profiles,and secure onlinevoting.</p>
</div>
<div class="module">
<h3>Modules</h3>
<p>-> Admin login.</p>
<p>-> Students login.</p>
<p>-> Elections creation.</p>
<p>-> Profile update.</p>
<p>-> Student can view the candidate data.</p>
<p>-> Result calculation.</p>
</div>
</section>
<div class="advantages">
<h3>Advantages</h3>
<p>-> Increased Frequency.</p>
<p>-> Improved Accuracy.</p>
<p>-> More convinience.</p>
<p>-> Fast and easy way of conducting Election.</p>
<p>->Voters can view background of each Candidate.</p>
</div>
<div class="disadvantage">
<h3>Disadvantage.</h3>
<p>-> privacy concerns.</p>
<p>-> Lack of transparency.</p>
</div>
<div class="conclusion">
<p>"Thank you for taking the time learn about the upcoming Student online elections.Your participition is essential to make  this democratic process a success.We believe in the values of fairness,transparency,and inclusivity,and we invite you to be an active part of the exciting  journey .Make your voice heard,cast your vote,and together,let's shape te future of our student body."</p>
<h3>******.Together,We can make a Difference.******</h3>
</div>
<div class="follow-us-section pt-5 pb-5">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1 class="follow-us-section-heading">Follow Us</h1>
          </div>
          <div class="col-12">
            <div class="d-flex flex-row justify-content-center">
              <div class="follow-us-icon-container">
                <i class="fab fa-twitter icon"></i>
              </div>
              <div class="follow-us-icon-container">
                <i class="fab fa-instagram icon"></i>
              </div>
              <div class="follow-us-icon-container">
                <i class="fab fa-facebook icon"></i>
              </div>
            </div>
          </div>
        </div>
</div>
</div>

<div id="popup-box" class="modal">
		<div class="content">
			<h1 style="color: green;">
				Hello <?php echo $fname; ?> !
			</h1><hr>
            <table>
            <tr >
            <td ><label>Username : </label></td><td><?php echo $_SESSION["user"]; ?></td></tr>
            <tr><td><label>Id : </label></td><td> <?php echo $_SESSION["roll"]; ?> </td></tr>
             <tr><td><label>E-mail : </label></td><td> <?php echo $_SESSION["mail"]; ?></td></tr>
			<tr colspan=2><td> Edit your profile <a href="register.php">here</a> </td></tr> 
            </table>
			<a href="#"
			class="box-close">
				×
			</a>
		</div>
</div>



</body>
</html>