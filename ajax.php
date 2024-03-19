<?php
session_start();
error_reporting(0);
?>

<?php
$head = $_POST["heading"];
$para = $_POST["para"];
$_SESSION["head"] = $_POST["heading"];
$_SESSION["para"] = $_POST["para"];
$con=mysqli_connect('localhost','root',"",'wt');
$sql= "insert into example values('$head','$para')";
if(mysqli_query($con,$sql)){
    echo "success";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="ajax.php" method="POST">
    <input type="text" name="heading" id="head" >
    <input type="text" name="para" id="para" >
    <button onclick="addelement();">Add Item</button>
    </form>
    <div id="demo"></div>
    <script>
    var head = document.getElementById("head").value;
    localStorage.setItem("name", head );
    var arr = new Array();
    function add()
    {
    var temp = localStorage.getItem("name");
    arr.push(temp);
    document.getElementById("demo").innerHTML = arr;
    }
    
    </script>
</body>
</html>