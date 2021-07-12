<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "supershop";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
    if($_SESSION['role']=="admin"){
        include_once'dashadmin.php';
    }else{
        header('location:index.php');
    }

 if(isset($_POST['submit'])){
     $category= $_POST['category'];

     $sql="SELECT cat_name FROM category WHERE cat_name='$category' ";
     $result = mysqli_query($conn, $sql);
     $rowCount=mysqli_num_rows($result);

     if($rowCount>0){
        echo '<script type="text/javascript">';
        echo ' alert("Category already exists")';
        echo '</script>';

        }
    else{
        $sql="INSERT INTO category (cat_name) VALUES ('$category')";
        if($conn->query($sql)== TRUE){
            echo '<script type="text/javascript">';
            echo ' alert("Category added Successfully")';  
            echo '</script>';
        }
            else {
                echo '<script type="text/javascript">';
                echo ' alert("Error: '. $conn->error.'" )';
                echo '</script>';
            }
        }


 }   
    

?>


<html>
    <head>

<title>Dashboard</title>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/fontawesome.min.css">
<link rel="stylesheet" href="css/all.min.css">
<link rel="stylesheet" href="css/category.css">
<link rel="stylesheet" href="css/dashboard.css">




</head>
    <body>
   
<nav class="nav-header">
<div class="nav-user-menu">
<div class="drop-down">
<?php echo '<span class="username">' .  $_SESSION['username'] . '</span>'; ?>
<a href="logout.php">Logout</a>
</div>
</div>
</nav>



<div class="row">

     <div class="col-md-4">
     <form action="" method="POST">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="category">Category Name</label>
                      <input type="text" class="form-control" name="category" placeholder="Enter Category">
                    </div>
                  </div>
                  <div class="box-footer">
                      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                  </div>
                </form>
</div>
    
     <div class="col-md-8">

     <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Category List</h3>
          </div>
          <div class="box-body" style="overflow-x:auto;">
            <table class="table table-striped" id="myCategory">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>

                </thead>
                <tbody>
                <?php


                $sql="SELECT * FROM category";
                $result = mysqli_query($conn, $sql);
                

                while($row = mysqli_fetch_assoc($result)){ 
                    $tol=json_decode(json_encode($row),FALSE); 
                    ?>
                  <tr>
                  
                    <td><?php echo $tol->cat_id; ?></td>
                    <td><?php echo $tol->cat_name; ?></td>
                    <td>
                        <a href="edit_category.php?id=<?php echo $tol->cat_id; ?>"
                        class="btn btn-info btn-sm" name="btn_edit">edit</a>
                        <a href="delete_category.php?id=<?php echo $tol->cat_id; ?>"
                        onclick="return confirm('Delete Category?')"
                        class="btn btn-danger btn-sm" name="btn_delete">delete</a>
                    </td>
                  </tr>
                <?php
                }
                ?>

                </tbody>
            </table>
          </div>
        </div>
     </div>
 
</div>


  <script src="js/jquery.js" ></script>
  <script src="js/script.js" ></script>
  <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
  <script src="js/bootstrap.min.js" ></script> 
    </body>
</html>



