<?php
session_start();
error_reporting(0);
// include("display.php");
?>

<script>
var counter=0;

function addelement() {
var completelist= document.getElementById("thelist");
completelist.innerHTML += " <a href='#' class='list-group-item '><h4 class='list-group-item-heading'>List group item heading</h4><p class='list-group-item-text'>...</p></a>";
counter++;
}
</script>