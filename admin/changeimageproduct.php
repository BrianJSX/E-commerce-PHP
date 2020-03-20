<?php
include './includes/header.php';
include './controller/product.php';

?>

<?php
$check_guest = Session::get('adminLevel');
if ($check_guest == 1) {
    echo "<script>window.location='index.php'</script>";
}elseif ($check_guest == 4) {
  echo "<script>window.location='guest.php'</script>";
}
$pd = new product();
if (!isset($_GET['productId']) || $_GET['productId'] == NULL) {
    echo "<script>window.location='products.php'</script>";
} else {
    $id = $_GET['productId'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['productId'])) {
  $updateimage = $pd->changeimage_product($_FILES, $id);
}

?>

<div class="col-md-7 mx-auto">
  <div class="">
    <div class="m-0">
      <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
        <div class="row tm-edit-product-row">
          <div class="col-md-12">
            <label for="name">
              Update image
            </label>
            <div>
                <?php if(isset($updateimage)){
                    echo $updateimage;
                }?>
            </div>
            <form action="" method="POST" class="tm-edit-product-form" enctype="multipart/form-data">
              <div class="form-group mb-3">
                <div class="mt-4">
                    <input name="image" type="file">
                </div>
              </div>
              <div>
                <input type="submit" name="submit" class="btn btn-primary btn-block text-uppercase" value="Update Now">
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