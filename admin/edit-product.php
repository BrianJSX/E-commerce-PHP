<?php
include './includes/header.php';
$check_guest = Session::get('adminLevel');
if ($check_guest == 1) {
    echo "<script>window.location='index.php'</script>";
}elseif ($check_guest == 4) {
  echo "<script>window.location='guest.php'</script>";
}
?>
<div class="container tm-mt-big tm-mb-big">
  <div class="row">
    <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
      <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
        <div class="row">
          <div class="col-12">
            <h2 class="tm-block-title d-inline-block">Edit Product</h2>
          </div>
        </div>
        <div class="row mx-auto mb-5">
              <div class="tm-product-img-dummy col-md-6">
                <i class=" fas fa-cloud-upload-alt tm-upload-icon" onclick="document.getElementById('fileInput').click();"></i>
              </div>
              <div class="row col-md-6">
                <div class=" ml-2 mb-2 col-md-4" style="background:gray;">
                  <i class="fas fa-cloud-upload-alt tm-upload-icon mt-4 ml-3" onclick="document.getElementById('fileInput').click();"></i>
                </div>
                <div class="ml-2 mb-2 col-md-4" style="background:gray;">
                  <i class="fas fa-cloud-upload-alt tm-upload-icon mt-4 ml-3" onclick="document.getElementById('fileInput').click();"></i>
                </div>
                <div class="ml-2 col-md-4" style="background:gray;">
                  <i class="fas fa-cloud-upload-alt tm-upload-icon mt-4 ml-3 " onclick="document.getElementById('fileInput').click();"></i>
                </div>
                <div class="ml-2 col-md-4 " style="background:gray;">
                  <i class="fas fa-cloud-upload-alt tm-upload-icon mt-4 ml-3" onclick="document.getElementById('fileInput').click();"></i>
                </div>
              </div>
              <div>
                <input id="fileInput" type="file" style="display:none;">
              </div>
            </div>
        <div class="row tm-edit-product-row">
          <div class="col-md-12">
            <form action="" method="post" class="tm-edit-product-form">
              <div class="form-group mb-3">
                <label for="name">Product Name
                </label>
                <input id="name" name="name" type="text" value="Lorem Ipsum Product" class="form-control validate" />
              </div>
              <div class="form-group mb-3 row">
                  <label for="description">Description</label>
                  <textarea name="description" id="editor1" rows="20" cols="80">Chi tiết sản phẩm</textarea>
                </div>
              <div class="form-group mb-3">
                <label for="category">Category</label>
                <select class="custom-select tm-select-accounts" id="category">
                  <option>Select category</option>
                  <option value="1" selected>New Arrival</option>
                  <option value="2">Most Popular</option>
                  <option value="3">Trending</option>
                </select>
              </div>
              <div class="row">
                <div class="form-group mb-3 col-xs-12 col-sm-6">
                  <label for="expire_date">Expire Date
                  </label>
                  <input id="expire_date" name="expire_date" type="text" value="22 Oct, 2020" class="form-control validate" data-large-mode="true" />
                </div>
                <div class="form-group mb-3 col-xs-12 col-sm-6">
                  <label for="stock">Units In Stock
                  </label>
                  <input id="stock" name="stock" type="text" value="19,765" class="form-control validate" />
                </div>
              </div>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block text-uppercase">Update Now</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include './includes/footer.php';
?>