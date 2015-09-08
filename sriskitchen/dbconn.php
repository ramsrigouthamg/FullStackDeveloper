<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "sriskitchen";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$GLOBALS['con'] =$conn ;
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 
 
?> 