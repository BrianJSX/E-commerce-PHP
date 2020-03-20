<?php
include './includes/header.php';
include './controller/adminAccount.php';
?>
<?php
$check_guest = Session::get('adminLevel');
if ($check_guest == 1 || $check_guest == 2) {
    echo "<script>window.location='index.php'</script>";
}elseif ($check_guest == 4) {
  echo "<script>window.location='guest.php'</script>";
}
$class = new adminAccount();
if (!isset($_GET['ProfileId']) || $_GET['ProfileId'] == NULL) {
    echo "<script>window.location='accountsedit.php'</script>";
} else {
    $id = $_GET['ProfileId'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adminName = $_POST['adminName'];
    $level = $_POST['level'];
    $adminEmail = $_POST['adminEmail'];
    $update_account = $class->updateaccount($adminName,$adminEmail,$level, $id);
}

?>
<div class="col-md-5 mt-5 mx-auto ">
    <div class="tm-bg-primary-dark tm-block tm-block-settings">
        <div class="row">
            <h2 class="tm-block-title">Add New Admin</h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php if (isset($update_account)) {
                    echo $update_account;
                }
                unset($update_account);
                ?>
                <?php
                $get_account_name = $class->getaccountbyId($id);
                if ($get_account_name) {
                    while ($result = $get_account_name->fetch_assoc()) {
                        ?>
                        <form action="" method="post" class="tm-edit-product-form">

                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input value="<?php echo $result['adminName'] ?>" name="adminName" type="text" class="form-control validate" />
                            </div>
                            <div class="form-group mb-3">
                            <label for="">email</label>
                                <input value="<?php echo $result['adminEmail'] ?>" name="adminEmail" type="email" class="form-control validate" />
                            </div>
                           
                            <div class="form-group mb-3">
                                <label for="">Level</label>
                                <select class="form-control p-1" name="level">
                                    <option value="">select....</option>
                                    <?php if ($result['level'] == 0){?>
                                        <option value="0" selected >Admin</option>
                                        <option value="1">Censor Order</option>
                                        <option value="2">Censor Product</option>
                                        <option value="4">Guest</option>
                                    <?php }elseif ($result['level'] == 1){?>
                                        <option value="0">Admin</option>
                                        <option value="1" selected>Censor Order</option>
                                        <option value="2">Censor Product</option>
                                        <option value="4">Guest</option>
                                    <?php }elseif ($result['level'] == 2){?>
                                        <option value="0">Admin</option>
                                        <option value="1">Censor Order</option>
                                        <option value="2" selected>Censor Product</option>
                                        <option value="4">Guest</option>
                                    <?php }elseif ($result['level'] == 4){?>
                                        <option value="0">Admin</option>
                                        <option value="1">Censor Order</option>
                                        <option value="2">Censor Product</option>
                                        <option value="4" selected>Guest</option>
                                    <?php }?>
                                </select>
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