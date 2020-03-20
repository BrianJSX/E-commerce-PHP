<?php
include './model/session.php';
Session::checkSession();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Accounts - Product Admin Template</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700" />
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
    -->
</head>

<body id="reportsPage">

    <div class="" id="home">
        <nav class="navbar navbar-expand-xl">
            <div class="container h-100">
                <a class="navbar-brand" href="index.php">
                    <h1 class="tm-site-title mb-0">Product Admin</h1>
                </a>
                <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars tm-nav-icon"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto h-100">
                        <?php
                        $checkadmin = Session::get('adminLevel');
                        if ($checkadmin == 1 || $checkadmin == 0) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">
                                    <i class="fas fa-tachometer-alt"></i> Order
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php
                        $checkadmin = Session::get('adminLevel');
                        if ($checkadmin == 2 || $checkadmin == 0) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="products.php">
                                    <i class="fas fa-shopping-cart"></i> Products
                                </a>
                            </li>
                        <?php } ?>
                        <?php
                        $checkadmin = Session::get('adminLevel');
                        if ($checkadmin == 2 || $checkadmin == 0) {
                            ?>
                        <li class="nav-item">
                            <a class="nav-link" href="categoryList.php">
                                <i class="fas fa-shopping-cart"></i> categoryList
                            </a>
                        </li>
                        <?php } ?>
                        <?php
                        $checkadmin = Session::get('adminLevel');
                        if ($checkadmin == 0) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="accountsList.php">
                                    <i class="far fa-user"></i> Accounts
                                </a>
                            </li>
                        <?php
                        }
                        ?>

                    </ul>
                    <ul class="navbar-nav">
                        <div class="row w-100">
                            <li class="col-md-9">
                                <a class="" style="color:white;">
                                    <b>
                                        Hello, <?php echo Session::get('adminName') . '!!'; ?>
                                    </b>
                                </a>
                            </li>
                            <?php if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                                Session::destroy();
                            } ?>
                            <li class="col-md-3">
                                <a style="color:white" href="?action=logout">
                                    <b>LOGOUT<b>
                                </a>
                            </li>

                        </div>

                    </ul>
                </div>
            </div>
        </nav>