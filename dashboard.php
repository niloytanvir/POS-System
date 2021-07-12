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
        include_once'dashop.php';
    }

?>


<html>
    <head>

<title>Dashboard</title>
<link rel="stylesheet" href="css/dashboard.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/fontawesome.min.css">
<link rel="stylesheet" href="css/dashboard.css">




</head>
    <body>

<nav class="nav-header">
<div class="nav-user-menu">
<div class="logout">
<?php echo '<span class="username">' .  $_SESSION['username'] . '</span>'; ?>

<a href="logout.php">Logout</a>
  
</div>
</div>
</nav>


<div class="row">
  <div class="column">
    <div class="card">
      
    <span class="icon"></span><h4>Low Stock</h4>

      <div class="stock-info">
      <?php
          $sql= "SELECT count(pCode) as total FROM product Where pStock <= minStock";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
        
          $tol=json_decode(json_encode($row),FALSE);
          $total1 = $tol->total;
        ?>

        <?php if($total1==true){ ?>
              <span class="stock-info-number"><strong><?php echo $tol->total;?></small></span>
              <?php }else{?>
              <span class="stock-info-text"><strong>0</strong></span>
              <?php }?>
      </div>
      
    </div>
  </div>




  <div class="column">
    <div class="card">
    <span class="icon"></span> <h4>Total Product</h4>
    <div class="product-info">
      <?php
          $sql= "SELECT count(pCode) as t FROM product";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
        
          $tol=json_decode(json_encode($row),FALSE);
          $total = $tol->t;
          print_r($total);
        ?>

     
      </div>
    </div>
  </div>
  

  <div class="column">
    <div class="card">
    <span class="icon"></span><h4>Today's Transction</h4>
        <div class="transction-info">
        <?php
          $sql= "SELECT count(invoice_id) as i FROM invoice WHERE order_date=CURDATE() ";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
        
          $tol=json_decode(json_encode($row),FALSE);
          $total = $tol->i;
          print_r($total);
        ?>
        </div>
    </div>
  </div>
  

  <div class="column">
    <div class="card">
    <span class="icon"></span> <h4>Today's Income</h4>
    <div class="income-info">
        <?php
          $sql= "SELECT sum(total) as total FROM invoice WHERE order_date=CURDATE() ";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
        
          $tol=json_decode(json_encode($row),FALSE);
          $total = $tol->total;
          ?>
        <span class="income-info-number"><b>BDT. <?php echo number_format($total,0); ?></small></span>

        </div>

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



