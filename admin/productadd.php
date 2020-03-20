<?php
include './includes/header.php';
include './controller/product.php';

?>

<?php
$pd = new product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  $insertproduct = $pd->insert_product($_POST, $_FILES);
}
$check_guest = Session::get('adminLevel');
if ($check_guest == 1) {
    echo "<script>window.location='index.php'</script>";
}elseif ($check_guest == 4) {
  echo "<script>window.location='guest.php'</script>";
}
?>

<div class="col-md-7 mx-auto">
  <div class="">
    <div class="m-0">
      <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
        <div class="row tm-edit-product-row">
          <div class="col-md-12">
            <label for="name">
              Add New product
            </label>
            <form action="productadd.php" method="POST" class="tm-edit-product-form" enctype="multipart/form-data">
              <?php if (isset($insertproduct)) {
                echo $insertproduct;
              }
              ?>
              <div class="form-group mb-3">
                <label for="">Name Product</label>
                <input id="name" name="productName" type="text" class="form-control validate" required />
              </div>
              <div class="form-group mb-3">
                <label for="">category</label>
                <select class="custom-select tm-select-accounts" name="category">
                  <option selected>Select category</option>
                  <?php
                  $cat = new category();
                  $catlist  = $cat->show_category();

                  if ($catlist) {
                    while ($result = $catlist->fetch_assoc()) {
                      ?>
                      <option value="<?php echo $result['Id'] ?>"><?php echo $result['Name'] ?></option>
                  <?php
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="form-group mb-3">
                <label for="">Description</label>
                <textarea name="product_desc" id="editor1" rows="20" cols="80" required>Chi tiết sản phẩm </textarea>
              </div>
              <div class="form-group mb-3">
                <label for="">Price</label>
                <input min="1000"  step="1000"id="price" name="price" type="number" class="form-control validate" required />
              </div>
              <div class="form-group mb-3">
                <label for="">Price Sale</label>
                <input id="price" name="pricesale" type="text" class="form-control validate"  />
              </div>
              <div class="form-group mb-3">
                <label for="">Product Type</label>
                <select class="custom-select tm-select-accounts" name="type">
                  <option selected>Select type</option>
                  <option value="0">Nổi bật</option>
                  <option value="1">Không nổi bật</option>
                </select>
              </div>
              <div class="form-group mb-3">
                <label for="">Product Type</label>
                <select class="custom-select tm-select-accounts" name="stock">
                  <option selected>Select type</option>
                  <option value="0">Hết Hàng</option>
                  <option value="1">Còn Hàng</option>
                </select>
              </div>
              <div class="form-group mb-3">
                <input name="image" type="file">
              </div>
              <div>
                <input type="submit" name="submit" class="btn btn-primary btn-block text-uppercase" value="submit">
              </div>
            </form>
          </div>


        </div>
      </div>
    </div>
  </div>
</div>

<?php
include './includes/footer.php';
?>