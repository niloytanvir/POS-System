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
if($_SESSION['role']=="admin"){
    include_once'dashadmin.php';
}else{
    header('location:index.php');
}

if(isset($_POST['btn_edit'])){
    $category_name = $_POST['category'];

    $sql="SELECT cat_name FROM category WHERE cat_name='$category_name' ";
    $result = mysqli_query($conn, $sql);
    $rowCount=mysqli_num_rows($result);

    if($rowCount>0){
       echo '<script type="text/javascript">';
       echo ' alert("This Item already exists")';
       echo '</script>';

       }
   else{

    $sql="UPDATE category SET cat_name= '$category_name' WHERE cat_id='".$_GET['id']."' ";

    
    if($conn->query($sql)== TRUE){
        echo '<script type="text/javascript">';
        echo ' alert("Category Updated Successfully")';  
        echo '</script>';
    }
        else {
            echo '<script type="text/javascript">';
            echo ' alert("Error: '. $conn->error.'" )';
            echo '</script>';
        }
       }




}

if($id=$_GET['id']){
  
  $sql="SELECT * FROM category WHERE cat_id='".$_GET['id']."' "; 
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $tol=json_decode(json_encode($row),FALSE);
          
  $cat_name = $tol->cat_name;



}else{
  header('location:category.php');
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

<style>

.content-wrap {
   
    margin-left: 300px;
    padding:5px;
}

</style>


</head>
    <body>
   
   <!--Navbar  -->
<nav class="nav-header">
<div class="nav-user-menu">
<div class="drop-down">
<?php echo '<span class="username">' .  $_SESSION['username'] . '</span>'; ?>
<a href="logout.php">Log Out</a>
</div>
</div>
</nav>



<div class="content-wrap">

    <section class="content-header">
      <h1>
        Product Category
      </h1>
      <hr>
    </section>

    <section class="content container-fluid">
    
      <div class="col-md-4">
            <div class="box box-warning">

                <form action="" method="POST">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="category">Category Name</label>
                      <input type="text" class="form-control" name="category" placeholder="Enter Category"
                      value="<?php echo $cat_name; ?>" required>
                    </div>
                  </div>
                  <div class="box-footer">
                      <button type="submit" class="btn btn-primary" name="btn_edit">Update</button>
                      <a href="category.php" class="btn btn-warning">Back</a>
                  </div>
                </form>
            </div>
      </div>

      <div class="col-md-8">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Category List</h3>
          </div>
  
          <div class="box-body">
          <table class="table table-striped">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Category Name</th>
                  </tr>
              </thead>
              <tbody>
              <?php
                $sql="SELECT * FROM category";
                $result = mysqli_query($conn, $sql);


              while($row = mysqli_fetch_assoc($result) ){ 
                $tol=json_decode(json_encode($row),FALSE);
                  ?>
                <tr>
                  <td><?php echo $tol->cat_id; ?></td>
                  <td><?php echo $tol->cat_name; ?></td>
                </tr>
              <?php
              }
              ?>

              </tbody>
          </table>
          </div>
        
        </div>
        
      </div>

    </section>
   
  </div>




  <script src="js/jquery.js" ></script>
  <script src="js/script.js" ></script>
  <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
  <script src="js/bootstrap.min.js" ></script> 
    </body>
</html>