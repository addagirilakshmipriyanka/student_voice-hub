<?php
// update.php
$name = $_POST["name"]; // Get the count value from the AJAX request
$sub = $_POST["sub"];
$label = "$name ,$sub"; // Create a label with the count value
$file = "display.php"; // The name of the other HTML page
$html = file_get_contents($file); // Get the contents of the other page
$dom = new DOMDocument(); // Create a DOM object
$dom->loadHTML($html); // Load the HTML into the DOM
$div = $dom->getElementById("thelist"); // Get the div element with id "label" from the other page
$div->nodeValue = ""; // Clear the previous label
$div->appendChild($dom->createTextNode($label)); // Append the new label
file_put_contents($file, $dom->saveHTML()); // Save the updated HTML to the other page
echo "The label on the other page has been updated."; // Send a response back to the AJAX request
?>
