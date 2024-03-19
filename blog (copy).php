<!doctype html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> </title>
    <link rel="shortcut icon" type="image/jpg" href="images/news2.png"/>
    <link rel="stylesheet" href="">
    </head>
    <body>
    <?php
    include("Navbar.php");
    include("link.php"); 
    ?>
        <div class="row">
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