<?php
include './includes/header.php';
include './controller/category.php';
?>
<?php
$check_guest = Session::get('adminLevel');
if ($check_guest == 1) {
    echo "<script>window.location='index.php'</script>";
}elseif ($check_guest == 4) {
  echo "<script>window.location='guest.php'</script>";
}
$cat = new category();
if (!isset($_GET['catId']) || $_GET['catId'] == NULL) {
    echo "<script>window.location='categoryList.php'</script>";
} else {
    $id = $_GET['catId'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $catName = $_POST['catName'];
    $updateCat = $cat->update_category($catName, $id);
}

?>
<?php ?>
<div class="col-md-3 mx-auto">
    <div class="">
        <div class="m-0">
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                <div class="row tm-edit-product-row">
                    <div class="col-md-12">
                        <?php if (isset($updateCat)) {
                            echo $updateCat;
                        }
                        unset($upateCat);
                        ?>
                        <?php
                        $get_cate_name = $cat->getcatbyId($id);
                        if ($get_cate_name) {
                            while ($result = $get_cate_name->fetch_assoc()) {
                                ?>
                                <form action="" method="post" class="tm-edit-product-form">
                                    <div class="form-group mb-3">
                                        <input value="<?php echo $result['Name'] ?>" name="catName" type="text" class="form-control validate" />
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-block text-uppercase">Update Now</button>
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
<?php include './includes/footer.php' ?>