<?php
include 'includes/header.php';
?>
<?php
$check_login = Session::get('custumer_longin');
if ($check_login == false) {
    echo "<script>window.location='login.php'</script>";
}
if (isset($_GET['completeid']) && isset($_GET['price']) && isset($_GET['date']) && isset($_GET['complete'])) {
    $id = $_GET['completeid'];
    $price = $_GET['price'];
    $date = $_GET['date'];
    $custumerId = Session::get("custumer_id");
    $order_cancel = $cs->order_complete_index($id, $price, $date,$custumerId);
}
if (isset($_GET['delid']) && isset($_GET['price']) && isset($_GET['date']) && isset($_GET['del'])) {
    $id = $_GET['delid'];
    $price = $_GET['price'];
    $date = $_GET['date'];
    $custumerId = Session::get("custumer_id");
    $order_del = $cs->order_del_index($id, $price, $date,$custumerId);
}
?>
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <li><a href="index.php">Trang chủ</a></li>
                    <li><a href="orderdetail.php">Đơn Hàng Đã Đặt</a></li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">

                <tr>
                    <th>Product Name</th>
                    <th>image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Recevice</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $get_product_order = $ct->get_product_order($custumerId);
                if ($get_product_order) {
                    $subtotalpending = 0;
                    $subtotalmoving = 0;
                    $subtotalcancel = 0;
                    while ($result = $get_product_order->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $result['productName'] ?></td>
                            <td><img height="50px;" style="border-radius:50%;" src="./admin/uploads/<?php echo $result['image'] ?>"></td>
                            <td><?php echo $result['quantity'] ?></td>
                            <td><?php echo number_format($result['price']) ?></td>
                            <td>
                                <?php
                                        if ($result['statusId'] == 0) {
                                            ?>
                                    <div class='tm-status-circle pending'></div><span style='color:#efc54b;'><b>Pending</b></span>
                                <?php
                                        } elseif ($result['statusId'] == 1) {
                                            ?>
                                    <div class='tm-status-circle moving'></div><span style='color:green;'><b>Moving</b></span>
                                <?php
                                        } elseif ($result['statusId'] == 2) {
                                            ?>
                                    <div class='tm-status-circle cancelled'></div><span style='color:#da534f;'><b>Cancelled</b></span>
                                <?php
                                        } elseif ($result['statusId'] == 3) {
                                            ?>
                                    <span style='color:#56f16f;'><b>Complete</b></span>
                                <?php
                                        }
                                        ?>

                            </td>
                            <td><?php echo $result['date'] ?></td>
                            <td>
                                <?php
                                 if ($result['statusId']==1) {
                                ?>
                                    <a onclick ="return confirm('Bạn đã nhận được hàng phải không??')" class="btn btn-primary" href='?completeid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&date=<?php echo $result['date']?>&complete=complete'>Recevice</a>
                                <?php   
                                }else{
                                    echo "N/a";
                                }
                                ?>
                            </td>
                            <td>
                            <?php
                                 if ($result['statusId']==0 || $result['statusId']==2 || $result['statusId']==3 ) {
                                ?>
                                        <a onclick ="return confirm('Bạn có muốn xóa không??')" class="btn btn-danger" href='?delid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&date=<?php echo $result['date'] ?>&del=del'>Xóa</a>
                                <?php   
                                }else{
                                    echo "N/a";
                                }
                                ?>
                            </td>
                        </tr>
                <?php
                        if ($result['statusId'] == 1) {
                            $subtotalmoving += $result['price'];
                        }elseif ($result['statusId'] == 0){
                            $subtotalpending += $result['price'];
                        }elseif ($result['statusId'] == 2){
                            $subtotalcancel += $result['price'];
                        }
                    }
                }
                ?>
            </tbody>
        </table>
        <div class="row">
            <?php
            $check_cart = $ct->get_product_order($custumerId);
            if ($check_cart) {
                ?>
                <table style="float:right;text-align:left;" width="40%">
                    <tr>
                        <th>Sub Total Product Pending : </th>
                        <td>
                            <?php
                                echo number_format($subtotalpending);
                            ?> VNĐ
                        </td>
                    </tr>
                    <tr>
                        <th>Sub Total Product Moving: </th>
                        <td>
                            <?php
                                echo number_format($subtotalmoving);
                            ?> VNĐ
                        </td>
                    </tr>
                    <tr>
                        <th>Sub Total Product Cancelled : </th>
                        <td>
                            <?php
                                echo number_format($subtotalcancel);
                            ?> VNĐ
                        </td>
                    </tr>
                </table>
            <?php } else { ?>
                <?php echo "Chưa có sản phẩm nào được thêm vào giỏ hàng" ?>
            <?php } ?>

        </div>


    </div>
    <!-- /container -->
</div>

<?php
include 'includes/footer.php';
?>