<?php
include './includes/header.php';
include './controller/category.php';
?>
<?php
$check_guest = Session::get('adminLevel');
if ($check_guest == 1) {
    echo "<script>window.location='index.php'</script>";
} elseif ($check_guest == 4) {
    echo "<script>window.location='guest.php'</script>";
}
$cat = new category();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catName = $_POST['catName'];
    $insertCat = $cat->insert_category($catName);
}

if (isset($_GET['delId'])) {
    $id = $_GET['delId'];
    $delcat = $cat->del_category($id);
}

?>
<div class="row">
    <div>
        <?php if (isset($delCat)) {
            echo $delCat;
        }
        unset($delCat);
        ?>
    </div>
    <div class="col-md-9">
        <div class="tm-bg-primary-dark tm-block tm-block-product-categories">
            <h2 class="tm-block-title">Product Categories</h2>
            <div class="tm-product-table-container">
                <table class="table tm-table-small tm-product-table">
                    <tbody>
                        <tr style="color:black;">
                            <th>ID .No</th>
                            <th>Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                        <?php
                        $show_cate = $cat->show_category();

                        if ($show_cate == true) {
                            $i = 0;
                            while ($result = $show_cate->fetch_assoc()) {
                                $i++;
                                ?>
                                <tr>
                                    <td class="tm-product-name"><?php echo $i ?></td>
                                    <td class="tm-product-name"><?php echo $result['Name'] ?></td>
                                    <td class="text-center">
                                        <a href="categoryedit.php?catId=<?php echo $result['Id'] ?>" class="tm-product-delete-link">
                                            <i class="far fas fa-pen-square tm-product-delete-icon"></i>
                                        </a>
                                        <a onclick="return confirm('Bạn có muốn xóa không??')" href="?delId=<?php echo $result['Id'] ?>" class="tm-product-delete-link">
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
    <!-- ADD NEW CATEGORY -->
    <div class="col-md-3">
        <div class="">
            <div class="m-0">
                <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                    <div class="row tm-edit-product-row">
                        <div class="col-md-12">
                            <form action="categoryList.php" method="post" class="tm-edit-product-form">
                                <div class="form-group mb-3">
                                    <label for="name">
                                        Add New Category
                                    </label>
                                </div>
                                <div>
                                    <?php if (isset($insertCat)) {
                                        echo $insertCat;
                                    }
                                    unset($insertCat);
                                    ?>
                                </div>
                                <div class="form-group mb-3">
                                    <input id="name" name="catName" type="text" class="form-control validate" />
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

</div>

<?php include './includes/footer.php'; ?>