<?php
 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "supershop";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
    
    session_start();
 if($_SESSION['role']!=="Admin"){
   header('location:index.php');
 }

$sql="DELETE FROM category WHERE cat_id='".$_GET['id']." '  ";

if($conn->query($sql)== TRUE){
    header('location:category.php');
}

?>