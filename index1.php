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


if(isset($_POST['btn_login'])){

  $username = $_POST['username']; 
  $password = $_POST['password'];

  $sql= "SELECT * FROM user WHERE username ='$username'  AND password ='$password' " ;

  $result = mysqli_query($conn, $sql);
  
  $row = mysqli_fetch_assoc($result);


if($row['username']==$username AND $row['password']==$password AND $row['role']=="admin"){
  
  $_SESSION['id']=$row['id'];
  $_SESSION['username']=$row['username'];
  $_SESSION['fullname']=$row['fullname'];
  $_SESSION['role']=$row['role'];

  echo '<script type="text/javascript">';
  echo ' alert("Login Succeed")';  
  echo '</script>';
  header('Location:dashboard.php');


} 


else if($row['username']==$username AND $row['password']==$password AND $row['role']=="operator"){
  
  $_SESSION['username']=$row['username'];
  $_SESSION['fullname']=$row['fullname'];
  $_SESSION['role']=$row['role'];
  
  echo '<script type="text/javascript">';
  echo ' alert("Login Succeed")';  
  echo '</script>';
  header('Location:dashboard.php');
  
}

else {
  echo "error";
}

}
?>




<!DOCTYPE html>
<html>
<head>
	<title>Supershop Log in</title>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/fontawesome.min.css">
<link rel="stylesheet" href="css/style.css">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</head>

<body>

 <div id="login">
        <h3 class="text-center text-white pt-5"> <b>SuperShop Management System</h3>
        <hr>
        <div class="container">
           
                <div class="box">
                   
                        <form id="login-form" class="form" action="" method="POST">
                            <h3 class="text-center text-info">Login Here</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" required class="form-control">
                            </div>
                            <div class="form-group">
                               
                                <input type="submit" name="btn_login" class="btn btn-info btn-md" value="Login">
                            </div>
                            </form>
                </div>        
        </div>
    </div>
   
</body>
</html>