<?php
include 'includes/header.php';
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $cartId = $_POST['cartId'];
    $quantity = $_POST['quantity'];
    $update_quantity = $ct->update_quantity($quantity, $cartId);
}
if (isset($_GET['cartId'])) {
    $cartId = $_GET['cartId'];
    $delcart = $ct->delcart($cartId);
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
                    <li><a href="cart.php">Giỏ Hàng</a></li>
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
        <div class="row">
            <?php
            if (isset($update_quantity)) {
                echo $update_quantity;
            }
            unset($update_quantity);
            ?>
        </div>
        <?php
        if (isset($delcart)) {
            echo "<div class='row'>" . $delcart . "</div>";
        }
        unset($delcart);
        ?>
        <!-- row -->
        <div class="row">
            <table class="table table-striped table-inverse table-responsive table-hover">
                <thead class="thead-inverse">
                    <tr>
                        <th><i class="fa fa-id-badge" aria-hidden="true"></i></th>
                        <th>Product Name</th>
                        <th>Image <i class="fa fa-picture-o" aria-hidden="true"></i></th>
                        <th>Price <i class="fa fa-money" aria-hidden="true"></i></th>
                        <th>Quantity</th>
                        <th>Total Price <i class="fa fa-usd" aria-hidden="true"></i></th>
                        <th>Action <i class="fa fa-magic" aria-hidden="true"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $get_product_cart = $ct->get_product_cart();

                    if ($get_product_cart) {
                        $subtotal = 0;
                        $count = 0;
                        while ($result = $get_product_cart->fetch_assoc()) {
                            $count++;
                            ?>
                            <tr>
                                <td scope="row"><?php echo $count ?></td>
                                <td><?php echo $result['productName'] ?></td>
                                <td>
                                    <img height="50px;" style="border-radius:50%;" src="./admin/uploads/<?php echo $result['image'] ?>">
                                </td>
                                <td><?php echo number_format($result['price']) ?></td>
                                <td>
                                    <form action="" method="POST">
                                        <input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>">
                                        <input min="1" type="number" name="quantity" value="<?php echo $result['quantity'] ?>">
                                        <input type="submit" name="submit" value="update">
                                    </form>
                                </td>
                                <td>
                                    <?php
                                            $totalprice = $result['price'] * $result['quantity'];
                                            echo number_format($totalprice);
                                            ?>
                                </td>
                                <td>
                                    <a href="?cartId=<?php echo $result['cartId'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                    <?php
                            if (isset($totalprice)) {
                                $subtotal = $subtotal + $totalprice;
                            } else {
                                $subtotal = 0;
                            }
                        }
                    }

                    ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <?php
            $check_cart = $ct->get_product_cart();
            if ($check_cart) {
                ?>
                <table style="float:right;text-align:left;" width="40%">
                    <tr>
                        <th>Sub Total : </th>
                        <td>
                            <?php
                                echo number_format($subtotal);
                                ?> VNĐ</td>
                    </tr>
                </table>
                <table style="margin-top: 50px;">
                    <tr class="row">
                        <td class="col-md-4">
                            <a class="btn btn-primary" href="index.php">Trở lại trang mua hàng</a>
                        </td>
                        <td class="col-md-7">

                        </td>
                        <td class="col-md-4">
                            <a class="btn btn-primary" href="checkout.php">Tiếp tục thanh toán</a>
                        </td>
                    </tr>
                </table>

            <?php } else { ?>
                <?php echo "Chưa có sản phẩm nào được thêm vào giỏ hàng" ?>
            <?php } ?>

        </div>

        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->

<!-- /SECTION -->
<?php
include 'includes/footer.php';
?>