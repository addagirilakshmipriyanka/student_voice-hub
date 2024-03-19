<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create a database connection
    $conn=mysqli_connect('localhost','root',"",'wt');
    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    // File upload handling
    $imageName = $_FILES["image"]["name"];
    $imageData = file_get_contents($_FILES["image"]["tmp_name"]);

    // // Prepare and execute the SQL query
    // $stmt = $conn->prepare("INSERT INTO images (name, data) VALUES (?, ?)");
    // $stmt->bind_param("ss", $imageName, $imageData);
    // $stmt->execute();

    // // Close the statement and database connection
    // $stmt->close();
    

    echo "Image uploaded successfully.";
}

$sql = "SELECT id, name FROM images";
$result = $conn->query($sql);

// Display images
while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $name = $row['name'];

    // Output image to the webpage
    echo "<img src='image.php?id=$id' alt='$name'>";
}

$stmt = $conn->prepare("SELECT name, data FROM images WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($name, $data);
$stmt->fetch();

// Output the image
header("Content-type: image/png");
echo $data;

?>

<html>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="image" id="image">
        <input type="submit" value="Upload Image" name="submit">
    </form>
</body>
</html>
