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
if ($_SESSION['role'] == "admin") {
   include_once 'dashadmin.php';
} else {
    include_once 'dashop.php';
}

?>


<html>

<head>

    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/dashboard1.css">

<style>
        .btn-success{
        margin-bottom: 15px;
        margin-top: 15px;
        color: black;
    }
    .content-b{
        margin-left: 300px ;
        max-width: 1200px;
        width:1200px;
        display: inline-block;
    }
    .nav-header{
    background:#17a2b8;
}
</style>
</head>

<body>

    <nav class="nav-header">
        <div class="nav-user-menu">



            <div class="drop-down">
                <?php echo '<span class="username">' .  $_SESSION['username'] . '</span>'; ?>
                <a href="logout.php">Log Out</a>
            </div>
            </div>
        </div>
    </nav>


  
    <div class="content-b">

        <section class="container">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Product List</h3>
                    <a href="add_product.php" class="btn btn-success btn-sm pull-right">Add Product</a>
                </div>
                <div class="box-body">
                    <div style="overflow-x:auto;">
                        <table class="table table-striped" id="myProduct">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product</th>
                                    <th>Code</th>
                                    <th>Purchase Price</th>
                                    <th>Sell Price</th>
                                    <th>Option</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $sql = " SELECT * FROM product";
                                $result = mysqli_query($conn, $sql);



                                while ($row = mysqli_fetch_assoc($result)) {
                                    $tol = json_decode(json_encode($row), FALSE);
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $tol->pName; ?></td>
                                        <td><?php echo $tol->pCode; ?></td>
                                        <td>BDT <?php echo number_format($tol->purchasePrice); ?></td>
                                        <td>BDT <?php echo number_format($tol->sellPrice); ?></td>
                                        <td>
                                            <?php if ($_SESSION['role'] == "admin") { ?>


                                                <a href="delete_product.php?id=<?php echo $tol->pId; ?>" onclick="return confirm('Delete Product?')" class="btn btn-danger btn-sm" name="btn_delete">delete</a><?php
                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                    ?>
                                            <a href="view_product.php?id=<?php echo $tol->pId; ?>" class="btn btn-default btn-sm">details</a>
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
        </section>
        
    </div>
    




    <script src="js/jquery.js"></script>
    <script src="js/script.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>