<?php 
session_start();
error_reporting(0);

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Registration</title>
    
    <!-- Bootstrap CSS and Font Awesome for Icons -->
    <?php include("link.php"); ?>
    <style>
        /* Custom background color for the form */
        *{
            margin: 0;
            padding: 0;
        }
        .registration-form {
            background-color: #f3f4f6;
            padding: 30px;
            border-radius: 10px;
        }
        a{
            text-decoration:none;
        }

    /* Mini profile */

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
    align-items: center;
    display: flex;
    justify-content: center;
    position: absolute;
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


<script src="//code.jquery.com/jquery.min.js"></script>
<script>
$(function(){
  $("#nav-placeholder").load("Navbar.html");
});
</script>

</head>
<body class="bg-light">
    <div id="nav-placeholder"></div>
    <br><br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="registration-form">
                   <h2 class="text-center mb-4">Candidate Registration</h2>
                    <form action="your-backend-processing-script.php" method="post" enctype="multipart/form-data">
                        <!-- Photo upload at the top center -->
                        <div class="text-center mb-4">
                            <label class="d-block">
                                <img src="placeholder-image-path.jpg" alt="Upload Photo" class="rounded-circle mb-2" width="100" id="photoPreview">
                                <input type="file" name="photo" style="display: none;" onchange="previewImage(event)">
                                <div><small></small></div>
                            </label>
                        </div>
                        <!-- Editable Name field -->
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Enter your name">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-edit"></i></span>
                            </div>
                        </div>
                        <!-- Email field -->
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Enter your email">
                        </div>
                        <!-- Dropdowns for Year, Branch, and Section -->
                        <div class="form-group">
                            <select class="form-control mb-3" name="year">
                                <option value="" disabled selected>Choose Year</option>
                                <option>1st Year</option>
                                <option>2nd Year</option>
                                <option>3rd Year</option>
                                <option>4th Year</option>
                            </select>
                            <select class="form-control mb-3" name="branch">
                                <option value="" disabled selected>Choose Branch</option>
                                <option>Computer Science and engineering</option>
                                <option>Electronics and Communication</option>
                                <option>Mechanical Engineering</option>
                                <option>electrical and electronical Engineering</option>
                                <option>civil Engineering</option>
                            </select>
                            <select class="form-control mb-3" name="section">
                                <option value="" disabled selected>Choose Section</option>
                                <option>section-1</option>
                                <option>section-2</option>
                                <option>section-3</option>
                                 <option>section-4</option>
                            </select>
                        </div>
                        <!-- Description text area -->
                        <div class="form-group">
                            <textarea class="form-control" name="description" rows="4" placeholder="Description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript for Image Preview -->
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('photoPreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <!-- Mini profile -->
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



