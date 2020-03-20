<?php
include './includes/header.php';
include './controller/product.php';
include_once '../admin/helpers/format.php';
?>
<?php
$pd = new product();
$fm = new Format();
if (isset($_GET['delId'])) {
  $id = $_GET['delId'];
  $delproduct = $pd->del_product($id);
}
$check_guest = Session::get('adminLevel');
if ($check_guest == 1) {
  echo "<script>window.location='index.php'</script>";
}elseif ($check_guest == 4) {
  echo "<script>window.location='guest.php'</script>";
}
?>
<div class="container mt-5">
  <div class="row tm-content-row">
    <div class="col-md-12 tm-block-col">
      <div class="tm-bg-primary-dark tm-block tm-block-products">
        <div class="row">
          <a href="productadd.php" class="btn btn-primary btn-block text-uppercase mb-3">Add new product</a>
        </div>
        <div class="tm-product-table-container">

          <table class="table table-hover tm-table-small tm-product-table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">ProductName</th>
                <th scope="col">Price</th>
                <th scope="col">Price Sale</th>
                <th scope="col">Product Image</th>
                <th scope="col">Change image</th>
                <th scope="col">Category</th>
                <th scope="col">Decription</th>
                <th scope="col">Type</th>
                <th scope="col">Stock</th>
                <th scope="col text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php

              $pdlist = $pd->show_product();
              if ($pdlist) {
                $i = 0;
                while ($result = $pdlist->fetch_assoc()) {
                  $i++;
                  ?>
                  <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $result['productName'] ?></td>
                    <td><?php echo number_format($result['price']) ?></td>
                    <td><?php echo number_format($result['pricesale']) ?></td>
                    <td><img width="100px" style="border-radius:5px;" src="uploads/<?php echo $result['image'] ?>"></td>
                    <td><a href="changeimageproduct.php?productId=<?php echo $result['ProductId'] ?>" class="tm-product-delete-link">
                        <i class="far fas fa-pen-square tm-product-delete-icon"></i>
                      </a></td>
                    <td><?php echo $result['Name'] ?></td>
                    <td><?php echo $fm->textShorten($result['product_desc'], 20); ?></td>
                    <td><?php if ($result['type'] == 0) {
                              echo "Nổi Bật";
                            } else {
                              echo "Không nổi bật";
                            } ?></td>
                    <td><?php if ($result['stock'] == 0) {
                              echo "Hết Hàng";
                            } else {
                              echo "Còn Hàng";
                            } ?></td>
                    <td class="text-center">
                      <a href="productedit.php?productId=<?php echo $result['ProductId'] ?>" class="tm-product-delete-link">
                        <i class="far fas fa-pen-square tm-product-delete-icon"></i>
                      </a>
                      <a onclick="return confirm('Bạn có muốn xóa không??')" href="?delId=<?php echo $result['ProductId'] ?>" class="tm-product-delete-link">
                        <i class="far fa-trash-alt tm-product-delete-icon"></i>
                      </a>
                    </td>
                  </tr>
              <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Category Product -->
  </div>
</div <?php
      include './includes/footer.php';
      ?>