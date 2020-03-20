<?php
include './includes/header.php';
include './controller/product.php';

?>

<?php
$check_guest = Session::get('adminLevel');
if ($check_guest == 1) {
  echo "<script>window.location='index.php'</script>";
} elseif ($check_guest == 4) {
  echo "<script>window.location='guest.php'</script>";
}

$pd = new product();
if (!isset($_GET['productId']) || $_GET['productId'] == NULL) {
  echo "<script>window.location='products.php'</script>";
} else {
  $id = $_GET['productId'];
}

if (isset($_GET['delId'])) {
  $id = $_GET['delId'];
  $delcat = $cat->del_product($id);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['productId'])) {
  $updateproduct = $pd->update_product($_POST, $_FILES, $id);
}


?>

<div class="col-md-7 mx-auto">
  <div class="">
    <div class="m-0">
      <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
        <div class="row tm-edit-product-row">
          <div class="col-md-12">
            <label for="name">
              Update product
            </label>
            <?php if (isset($updateproduct)) {
              echo $updateproduct;
            }
            ?>
            <?php
            $get_product_id = $pd->getproductbyId($id);
            if ($get_product_id) {
              while ($result_product = $get_product_id->fetch_assoc()) {
                ?>
                <form action="" method="POST" class="tm-edit-product-form" enctype="multipart/form-data">
                  <div class="form-group mb-3">
                    <label for="">Name Product</label>
                    <input value="<?php echo $result_product['productName'] ?>" id="name" name="productName" type="text" class="form-control validate" required />
                  </div>
                  <div class="form-group mb-3">
                    <label for="">category</label>
                    <select class="custom-select tm-select-accounts" name="category">

                      <?php
                          $cat = new category();
                          $catlist  = $cat->show_category();

                          if ($catlist) {
                            while ($result = $catlist->fetch_assoc()) {
                              ?>
                          <option <?php if ($result['Id'] == $result_product['categoryId']) {
                                            echo 'selected';
                                  }
                            ?> value="<?php echo $result['Id'] ?>"><?php echo $result['Name'] ?></option>
                      <?php
                            }
                          }
                          ?>
                    </select>
                  </div>
                  <div class="form-group mb-3">
                    <label for="">Description</label>
                    <textarea name="product_desc" id="editor1" rows="20" cols="80"><?php echo $result_product['product_desc'] ?></textarea>
                  </div>
                  <div class="form-group mb-3">
                    <label for="">Price</label>
                    <input min="1000" id="price" name="price" type="number" class="form-control validate" value="<?php echo ($result_product['price']) ?>" />
                  </div>
                  <div class="form-group mb-3">
                    <label for="">Price Sale</label>
                    <input name="pricesale" type="text" class="form-control validate" value="<?php echo ($result_product['pricesale']) ?>" />
                  </div>
                  <div class="form-group mb-3">
                    <label for="">Product Type</label>
                    <select class="custom-select tm-select-accounts" name="type">
                      <option selected>Select type</option>
                      <?php if ($result_product['type'] == 0) { ?>
                        <option selected value="0">Nổi bật</option>
                        <option value="1">Không nổi bật</option>
                      <?php
                          } else { ?>
                        <option value="0">Nổi bật</option>
                        <option selected value="1">Không nổi bật</option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group mb-3">
                    <label for="">Stock</label>
                    <select class="custom-select tm-select-accounts" name="stock">
                      <option selected>Select Stock</option>
                      <?php if ($result_product['stock'] == 0) { ?>
                        <option selected value="0">Hết Hàng</option>
                        <option value="1">Còn Hàng</option>
                      <?php
                          } else { ?>
                        <option value="0">Hết Hàng</option>
                        <option selected value="1">Còn hàng</option>
                      <?php } ?>
                    </select>
                  </div>

          </div>
          <div>
            <input type="submit" name="submit" class="btn btn-primary btn-block text-uppercase" value="Update Now">
          </div>
          </form>
      <?php
        }
      }
      ?>
        </div>


      </div>
    </div>
  </div>
</div>
</div>

<?php
include './includes/footer.php';
?>