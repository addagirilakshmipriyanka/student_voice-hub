<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if(strlen($_SESSION["user"])==0){
    header("location:login.php");
}
?>
<?php
$con=mysqli_connect('localhost','root',"",'wt');
if(!empty($_SESSION["user"]))
{
    $uname = $_SESSION["user"];
}
$sql="select * from signup where username='$uname' ";
$result = mysqli_query($con, $sql);
if ($result->num_rows > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $fname = $row["fname"];
    $mail  = $row["email"];
    $user  = $row["username"];
  }
}
$_SESSION["mail"] = $mail;
$id = explode("@",$mail);
$_SESSION["roll"] = $id[0];
require_once("link.php");

// if (isset($_POST['submit'])) {
//  $message = $_POST['message'];
//  $stars = $_POST['rating'];
//  $sql2="insert into review values('$uname','$id[0]' ,'$message','$stars')";
//  if(mysqli_query($con, $sql2)){
//    echo "<script> alert('Thanks For Your Valuable Review'); </script>";
//  }
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="home.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <style>
        body{
          overflow-x:hidden;
          margin:0px;
          padding:0px;

        }
        .btn-success:hover{
          transform: scale(1.05);
        }
    </style>
</head>
<body>
<?php include("Navbar.php"); ?>
<div class='nav'></div>
<section class='head'>
<div class="row2 custom-lg-flex">
    <div class="col-lg-5 lg-col-5 typing-effect">
      <h5 id="quote"></h5>
      <p>Try Online Voting with</p>
      <p> Our Student-voice-hub.</p>
      <h1>- it's easy ! </h1>
      <br>
      <div class="d-flex justify-content-around">
      <button id="button2"> <i class="bi bi-plus plus-icon" style="font-size: 1.5em;"></i> Create Election</button>
      <button id="button">Vote now &nbsp;<i class="bi bi-arrow-right arrow-icon" style="font-size: 1.5em;"></i></button>
      </div>
    </div>
    
    <div class="col-lg-7 lg-col-7 d-none d-md-block ">
    <div id="myCarousel" class="carousel slide square-carousel" data-ride="carousel">
    <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="image1.jpg" alt="First Slide" width="100%" height="100%">
    </div>
    <div class="carousel-item">
      <img src="image2.jpg" alt="Second Slide">
    </div>
    <div class="carousel-item">
      <img src="image3.jpg" alt="Third Slide">
    </div>
    </div>
    </div>
    </div>
</div>
<br><br>
</section>

<script src="home.js"></script>
<section class="howitworks">
<br>
    <div class="row">
                <h2 style="color:#113333;">How it works?</h2>
                <p>Conducting online election on Student-Voice-Hub is a simple 3 step process.</p>
    </div>
    <br>

    <div class="step-container">
        <div class="step-image">
            <img src="home images/images1.jpeg" alt="Step 1 Image" width="130">
        </div>
        <div class="step-content">
            <h3>Step 1: Setup Election</h3>
            <p>On successful registration,with our effortless ballot setup,you can set-up election in no time by defining the election parameters, including date, time, and eligibility criteria.</p>
        </div>
    </div>

    <div class="step-container">
        <div class="step-image">
            <img src="home images/images2.jpeg" alt="Step 2 Image" width="130">
        </div>
        <div class="step-content">
            <h3>Step 2: Vote</h3>
            <p>Broadcast SMS and E-mails are sent to your voters to notify them about the election link, clicking on which voters can record their vote through any internet-enabled device.</p>
        </div>
    </div>

    <div class="step-container">
        <div class="step-image">
            <img src="home images/images2.jpeg" alt="Step 3 Image" width="130">
        </div>
        <div class="step-content">
            <h3>Step 3: Results</h3>
            <p>After the election ends, on approval of election officer,  the result can be generated which is automatically tabulated. This is solely for security purposes. The outcome can be published and shared with the voters on your eVote website.</p>
        </div>
    </div>
</section> 

<div style="height:40px;" class="news">
<marquee>
<h3> Hoorrayyy ... Election results released. </h3>
</marquee>
</div><br>
<center><h1 style="color:#113333;">Featuers <i class="bi bi-award"></i></h1></center>
<div class="row row-cols-1 row-cols-sm-3 g-3 mt-3 mb-5 text-center m-5">
    <div class="col">
      <div class="card border-light">
        <div class="card-body">
          <div class="card-text">
            <span style="font-size: 3rem; color: #333;">
              <span class="bi bi-heart"></span>
            </span>
            <h5 class="card-title mt-1" style="font-weight: bold;">Free</h5>
            <div style="color: #666;" class='d-none d-md-block'>Student Voice Hub online Voting by offering a free service without advertisements</div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card border-light">
        <div class="card-body">
          <div class="card-text">
            <span style="font-size: 3rem; color: #333;">
              <span class="bi bi-card-checklist"></span>
            </span>
            <h5 class="card-title mt-1" style="font-weight: bold;">Tailored questions</h5>
            <div style="color: #666;" class='d-none d-md-block'>Ask different types of questions: multiple-choice, ranking of proposals, and more</div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card border-light">
        <div class="card-body">
          <div class="card-text">
            <span style="font-size: 3rem; color: #333;">
              <span class="bi bi-bell"></span>
            </span>
            <h5 class="card-title mt-1" style="font-weight: bold;">Reminders</h5>
            <div style="color: #666;" class='d-none d-md-block'>Send reminders to voters who haven't voted yet</div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card border-light">
        <div class="card-body">
          <div class="card-text">
            <span style="font-size: 3rem; color: #333;">
              <span class="bi bi-star"></span>
            </span>
            <h5 class="card-title mt-1" style="font-weight: bold;">Accessible</h5>
            <div style="color: #666;" class='d-none d-md-block'>Easy to use, you'll achieve high participation rates</div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card border-light">
        <div class="card-body">
          <div class="card-text">
            <span style="font-size: 3rem; color: #333;">
              <span class="bi bi-key"></span>
            </span>
            <h5 class="card-title mt-1" style="font-weight: bold;">Secret ballots</h5>
            <div style="color: #666;" class='d-none d-md-block'>Balotilo simplifies the creation and management of votes, eliminating complexity associated with confidential ballots</div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card border-light">
        <div class="card-body">
          <div class="card-text">
            <span style="font-size: 3rem; color: #333;">
              <span class="bi bi-eye"></span>
            </span>
            <h5 class="card-title mt-1" style="font-weight: bold;">Monitoring and transparency</h5>
            <div style="color: #666;" class='d-none d-md-block'>Ensure complete transparency by designating observers to oversee the voting process</div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card border-light">
        <div class="card-body">
          <div class="card-text">
            <span style="font-size: 3rem; color: #333;">
            <i class="bi bi-hand-index"></i>
          </span>
            <h5 class="card-title mt-1" style="font-weight: bold;">Show-of-hands votes</h5>
            <div style="color: #666;" class='d-none d-md-block'>Organize non-anonymous votes to simulate show-of-hands votes when secret ballots are not needed</div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card border-light">
        <div class="card-body">
          <div class="card-text">
            <span style="font-size: 3rem; color: #333;">
              <span class="bi bi-people"></span>
            </span>
            <h5 class="card-title mt-1" style="font-weight: bold;">Proxy votes</h5>
            <div style="color: #666;" class='d-none d-md-block'>Proxy votes allow one person to vote on behalf of others</div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card border-light">
        <div class="card-body">
          <div class="card-text">
            <span style="font-size: 3rem; color: #333;">
              <span class="bi bi-speedometer2"></span>
            </span>
            <h5 class="card-title mt-1" style="font-weight: bold;">Weighted votes</h5>
            <div style="color: #666;" class='d-none d-md-block'>Weighted votes allow you to assign weights to ballots, in order to represent groups or even shares in a condominium</div>
          </div>
        </div>
      </div>
    </div>
</div>
<section style = "background:#E6EFED;">
<div class="container" >
<center><h1>Indisputable Results</h1></center><br><br>
  <div class="row2 custom-lg-flex">
    <div class="col-lg-4 lg-col-4 text-center">
                      <img src="ballot-safe.png" height=300px width=300px alt="Diverse group of people using digital devices for online elections">
    </div><br>
    <div class="col-lg-8 lg-col-8 text-center">
                <p> We're an independent third-party with no stakes in your election,<br> and we've built Student-voice-Hub so it can only operate like a <br>non-biaised and uninterested referee that you and your voters can trust.</p>
               <p> You and your voters can thus rest assured that  <br>no one in your election - not even yourself - can tamper <br>with or improperly influence your election's results.</p> 
    </div>
  </div>
</div>
</section>
<br>
<div class="comments">
 <!-- Testimonials -->
<div class="testimonials">
 <swiper-container class="mySwiper" pagination="true" effect="coverflow" grab-cursor="true" centered-slides="true"
    slides-per-view="auto" coverflow-effect-rotate="50" coverflow-effect-stretch="0" coverflow-effect-depth="100"
    coverflow-effect-modifier="1" coverflow-effect-slide-shadows="true" loop="true" loopAdditionalSlides="5" >
    <swiper-slide>
        
      <div class='d-flex justify-content-between'>
      <h2 style="font-family: cursive; margin-left: 3%; font-size:30px; margin-top:8px;">Harsha</h2>
      <img src="quotes.png" width="70" height="70">
      </div>
        <p><b>"Effortless and Secure Voting Experience"</b><br>
            Rating: ⭐⭐⭐⭐⭐<br>
            I recently used this online voting system, and I must say it exceeded my expectations. I highly recommend this platform for its simplicity and reliability.</p>  
        <h6 class="m-auto text-end">- O190585 </h6>  
        </swiper-slide>
    <swiper-slide>
    <div class='d-flex justify-content-between'>
      <h2 style="font-family: cursive; margin-left: 3%; font-size:30px; margin-top:8px;">Bhargavi</h2>
      <img src="quotes.png" width="70" height="70">
      </div>
        <p><b>"Smooth and Convenient Voting Process"</b><br>
            Rating: ⭐⭐⭐⭐ <br>
            The online voting system provided a smooth and convenient voting experience. I appreciated the accessibility features, making it inclusive for all users. </p>
    </swiper-slide>
    <swiper-slide>
    <div class='d-flex justify-content-between'>
      <h2 style="font-family: cursive; margin-left: 3%; font-size:30px; margin-top:8px;">Mubeena</h2>
      <img src="quotes.png" width="70" height="70">
      </div>
        <p><b>"User-Friendly"</b><br>
            Rating:⭐⭐⭐⭐ <br>
            The online voting system is user-friendly, and I appreciate the convenience it offers. However, there were a few glitches that affected the overall experience</p>
    </swiper-slide>
    <swiper-slide>
    <div class='d-flex justify-content-between'>
      <h2 style="font-family: cursive; margin-left: 3%; font-size:30px; margin-top:8px;">Sriharshitha</h2>
      <img src="quotes.png" width="70" height="70">
      </div>
        <p><b>"First-Time User, Pleasantly Surprised"</b><br>
            Rating: ⭐⭐⭐⭐ <br>
            I was pleasantly surprised by the simplicity and effectiveness of the platform. The step-by-step guide made it easy to understand, and the interface was user-friendly.</p>
    </swiper-slide>
    <swiper-slide>
    <div class='d-flex justify-content-between'>
      <h2 style="font-family: cursive; margin-left: 3%; font-size:30px; margin-top:8px;">Priyanka</h2>
      <img src="quotes.png" width="70" height="70">
      </div>
        <p><b>"Secured My Vote, Secured My Trust"</b><br>
            Rating: ⭐⭐⭐⭐⭐ <br>
            The security measures implemented by this online voting system were impressive. Knowing that my vote was secure and confidential instilled a high level of trust in the platform</p>
    </swiper-slide>
    <swiper-slide>
    <div class='d-flex justify-content-between'>
      <h2 style="font-family: cursive; margin-left: 3%; font-size:30px; margin-top:8px;">Poorna</h2>
      <img src="quotes.png" width="70" height="70">
      </div>
        <p><b>"Minor Hiccups, Major Convenience"</b><br>
            Rating: ⭐⭐⭐⭐<br>
            Despite encountering a few minor hiccups during my voting session, the overall convenience of this online voting system is commendable. </p>
        </swiper-slide>
    <swiper-slide>
    <div class='d-flex justify-content-between'>
      <h2 style="font-family: cursive; margin-left: 3%; font-size:30px; margin-top:8px;">Dinesh</h2>
      <img src="quotes.png" width="70" height="70">
      </div>
        <p><b>"Innovative and Time-Saving"</b><br>
            Rating: ⭐⭐⭐⭐⭐<br>
            Using this online voting system was a breeze! The innovative features streamlined the entire voting process, saving me valuable time. </p>
    </swiper-slide>
    <swiper-slide>
    <div class='d-flex justify-content-between'>
      <h2 style="font-family: cursive; margin-left: 3%; font-size:30px; margin-top:8px;">Sudha</h2>
      <img src="quotes.png" width="70" height="70">
      </div>
        <p><b>"A Democratic Evolution"</b><br>
            Rating: ⭐⭐⭐⭐⭐<br>
            This online voting system represents a significant leap forward in the evolution of our democratic process. It's refreshing to see technology being used to enhance civic engagement. Five stars without a doubt!</p>
        </swiper-slide>
    <swiper-slide>
    <div class='d-flex justify-content-between'>
      <h2 style="font-family: cursive; margin-left: 3%; font-size:30px; margin-top:8px;">Badram</h2>
      <img src="quotes.png" width="70" height="70">
      </div>
        <p><b> "Empowering Citizens, Seamless Process"</b><br>
            Rating: ⭐⭐⭐⭐⭐<br>
            This online voting system truly empowers citizens to participate in the democratic process with ease. This design made casting my vote a quick and straightforward experience. </p>
        </swiper-slide>
 </swiper-container>



  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>


</div>

 <!-- Review Box -->
<form action="main.php" class="text-center" method="post">
 <div class="review-box d-flex m-4">
  <input type="text" class="review-input w-100" name="message" placeholder="Write a review..." maxlength="250" oninput="updateCharacterCount(this)">
  <p style="" class="character-count">250</p>
 </div>
 <div class="d-flex justify-content-center text-center" >
  <div class="rating">
            <input type="radio" id="star5" name="rating" value="5" />
            <label for="star5"><span class="bi bi-star-fill"></span></label>
            <input type="radio" id="star4" name="rating" value="4" />
            <label for="star4"><span class="bi bi-star-fill"></span></label>
            <input type="radio" id="star3" name="rating" value="3" />
            <label for="star3"><span class="bi bi-star-fill"></span></label>
            <input type="radio" id="star2" name="rating" value="2" />
            <label for="star2"><span class="bi bi-star-fill"></span></label>
            <input type="radio" id="star1" name="rating" value="1" />
            <label for="star1"><span class="bi bi-star-fill"></span></label>
</div>
  </div><br>
  <button class="btn btn-primary" name="submit">Submit</button>
</form>
<script>
  function updateCharacterCount(input) {
    var currentCount = input.value.length;
    var maxLength = parseInt(input.getAttribute('maxlength'));
    var remaining = maxLength - currentCount;
    var characterCountElement = input.nextElementSibling; // Get the next sibling, which is the paragraph element

    characterCountElement.textContent = '' + remaining;
  }
</script>
</div>



<div class="footer">
    <div class="section">
    <div class="breadcrumb">
        <a href="main.php"><i class="fas fa-home"></i> Home</a>
        <i class="bi bi-chevron-right"></i>&nbsp;
        <a href="request.php"><i class="fas fa-edit"></i> Create</a>
        <i class="bi bi-chevron-right"></i>&nbsp;
        <a href="display.php"><i class="fas fa-user-plus"></i> Register</a>
        <i class="bi bi-chevron-right"></i>&nbsp;
        <a href="display2.php"><i class="fas fa-vote-yea"></i> Vote</a>
        <i class="bi bi-chevron-right"></i>&nbsp;
        <a href="completed_elections.php"><i class="fas fa-poll"></i> Results</a>
    </div>
    </div>
    <p>&copy; Student Voice Hub</p><br>
    <h2><b>Contact Us</b></h2>
    <p><b>Address:</b> RGUKT Ongole Campus-2</p>
    <p><b>Email:</b> studentvoice@gmail.com</p>
    <p><b>Phone:</b> 9963478920</p>
</div>

<div id="popup-box" class="modal">
		<div class="content">
			<h1 style="color: green;">
				Hello <?php echo $fname; ?> !
			</h1><hr>
            <table>
            <tr >
            <td ><label>Username : </label></td><td><?php echo $user; ?></td></tr>
            <tr><td><label>Id : </label></td><td> <?php echo $id[0]; ?> </td></tr>
             <tr><td><label>E-mail : </label></td><td> <?php echo $mail; ?></td></tr>
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
