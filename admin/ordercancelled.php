<?php
include './includes/header.php';
include_once './controller/cart.php';

?>
<?php
if (isset($_GET['custumerid'])) {
    $id = $_GET['custumerid'];
}
//Moving
if (isset($_GET['pendingid']) && isset($_GET['price']) && isset($_GET['date']) && isset($_GET['pending'])) {
    $id = $_GET['pendingid'];
    $price = $_GET['price'];
    $date = $_GET['date'];
    $ct = new cart();
    $order_moving = $ct->order_pending($id, $price, $date);
}
//Cancel
if (isset($_GET['cancelid']) && isset($_GET['price']) && isset($_GET['date']) && isset($_GET['cancel'])) {
    $id = $_GET['cancelid'];
    $price = $_GET['price'];
    $date = $_GET['date'];
    $ct = new cart();
    $order_cancel = $ct->order_cancel($id, $price, $date);
}
//Delete
if (isset($_GET['delid']) && isset($_GET['price']) && isset($_GET['date']) && isset($_GET['del'])) {
    $id = $_GET['delid'];
    $price = $_GET['price'];
    $date = $_GET['date'];
    $ct = new cart();
    $order_del = $ct->order_del($id, $price, $date);
}
$check_guest = Session::get('adminLevel');
if ($check_guest == 2) {
    echo "<script>window.location='products.php'</script>";
}elseif ($check_guest == 4) {
    echo "<script>window.location='guest.php'</script>";
  }
?>
<div class="container">
    <!-- row -->
    <div class="col-12 tm-block-col mt-5">
        <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
            <div class="row">
                <span class="tm-block-title col-md-5"></span>
                <span class="tm-block-title col-md-4">ORDER LIST CANCELLED</span>
                <span class="tm-block-title col-md-3"></span>
            </div>
            <div class="row">
                <h2 class="tm-block-title col-md-3"><a class="btn btn-primary" href="index.php">1. Orders List
                        Pending</a></h2>
                <h2 class="tm-block-title col-md-3"><a class="btn btn-primary" href="ordermoving.php">2. Orders List
                        Moving</a></h2>
                <h2 class="tm-block-title col-md-3"><a class="btn btn-primary" href="ordercancelled.php" style="background-color: #23cef5;border: 2px solid #23cef5;">3. Orders List
                        Cancelled</a></h2>
                <h2 class="tm-block-title col-md-3"><a class="btn btn-primary" href="ordercomplete.php">4. Orders List
                        Complete</a></h2>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ORDER ID.</th>
                        <th scope="col">STATUS ORDER</th>
                        <th scope="col">PRODUCT NAME</th>
                        <th scope="col">QUANTITY</th>
                        <th scope="col">TOTALMONEY</th>
                        <th scope="col">DATE</th>
                        <th scope="col">Account</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ct = new cart();
                    $get_order_admin = $ct->get_order_pending();
                    if ($get_order_admin) {
                        while ($result = $get_order_admin->fetch_assoc()) {
                            if ($result['statusId'] == 2) {
                                ?>
                                <tr>
                                    <th scope="row"><b><?php echo $result['id'] ?></b></th>
                                    <td>
                                        <?php
                                        if ($result['statusId'] == 2) {
                                        ?>
                                            <a onclick ="return confirm('Bạn Có Muốn PENDING Đơn Hàng Này Ngay Bây Giờ??')" href='?pendingid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&date=<?php echo $result['date'] ?> &&pending=pending' style='color:#f10700;'>Cancelled</a>
                                        <?php } ?>
                                    </td>
                                    <td><b><?php echo $result['productName'] ?></b></td>
                                    <td><b><?php echo $result['quantity'] ?></b></td>
                                    <td><b><?php echo number_format($result['price']) ?></b></td>
                                    <td><?php echo $result['date'] ?></td>
                                    <td><b><a href="custumerView.php?custumerid=<?php echo $result['custumerId'] ?>">View
                                                Account</a></b></td>
                                    <td>
                                        <a onclick ="return confirm('Bạn có muốn xóa không??')" class="btn btn-primary" href='?delid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&date=<?php echo $result['date'] ?>&del=del'>Xóa</a>
                                    </td>
                                </tr>
                    <?php
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<footer class="tm-footer row tm-mt-small">
    <div class="col-12 font-weight-light">
        <p class="text-center text-white mb-0 px-4 small">
            Copyright &copy; <b>2018</b> All rights reserved.

            Design: <a rel="nofollow noopener" href="https://templatemo.com" class="tm-footer-link">Template Mo</a>
        </p>
    </div>
</footer>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<!-- https://jquery.com/download/ -->
<script src="js/moment.min.js"></script>
<!-- https://momentjs.com/ -->
<script src="js/Chart.min.js"></script>
<!-- http://www.chartjs.org/docs/latest/ -->
<script src="js/bootstrap.min.js"></script>
<!-- https://getbootstrap.com/ -->
<script src="js/tooplate-scripts.js"></script>
<script>
    Chart.defaults.global.defaultFontColor = 'white';
    let ctxLine,
        ctxBar,
        ctxPie,
        optionsLine,
        optionsBar,
        optionsPie,
        configLine,
        configBar,
        configPie,
        lineChart;
    barChart, pieChart;
    // DOM is ready
    $(function() {
        drawLineChart(); // Line Chart
        drawBarChart(); // Bar Chart
        drawPieChart(); // Pie Chart

        $(window).resize(function() {
            updateLineChart();
            updateBarChart();
        });
    })
</script>
</body>

</html>