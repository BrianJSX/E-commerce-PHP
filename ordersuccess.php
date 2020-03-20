<?php
include './includes/header.php';
?>
<?php 
$check_login = Session::get('custumer_longin');
if ($check_login == false) {
    echo "<script>window.location='login.php'</script>";
}else {
    $id = Session::get("custumer_id");
    $check_order = $ct->get_order_custumer($id);
}
if ($check_order == false) {
    echo "<script>window.location='cart.php'</script>";
}
?>
<div class="container">
    <div class="row">
        <br>
        <div class="jumbotron text-center">
            <a class="display-3 alert alert-success"> SUCCESS ORDER!!!!
            </a>
            <p class="lead"> <br><strong>Thanks <?php echo $custumerName?>!! You buy product in my website</strong>. Please check Order click button in this!</p>
            <hr>
            <p class="lead">
                <a class="btn btn-primary btn-sm" href="orderdetail.php" role="button">Checking My Order</a>
            </p>
        </div>
    </div>
</div>
<?php
include './includes/footer.php';
?>