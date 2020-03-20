<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../model/database.php');
include_once($filepath . '/../helpers/format.php');
?>
<?php
class cart
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function add_to_cart($quantity, $id)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $sId = session_id();

        $query = "SELECT * FROM product WHERE ProductId = '$id'";
        $result = $this->db->select($query)->fetch_assoc();


        $images = $result['image'];
        $prices = $result['price'];
        $pricesale = $result['pricesale'];
        $productNames = $result['productName'];

        $check_cart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId = '$sId'";
        $check_carts = $this->db->select($check_cart);

        if ($check_carts) {
            $alert =  "<span class='alert alert-danger'>Sản phẩm đã có trong giỏ hàng<a href='cart.php'> click</a> để kiểm tra</span>";
            return $alert;
        } else {
            if ($pricesale < $prices && $pricesale > 0) {
                $query_insert = "INSERT INTO tbl_cart(productId,quantity,sId,image,price,productName) VALUES ('$id', '$quantity','$sId','$images','$pricesale','$productNames')";
            }else{
                $query_insert = "INSERT INTO tbl_cart(productId,quantity,sId,image,price,productName) VALUES ('$id', '$quantity','$sId','$images','$prices','$productNames')";
            }
            $result_cart = $this->db->insert($query_insert);
            if ($result_cart == true) {
                $alert =  "<span class='alert alert-success'>Đã thêm vào giỏ hàng, vui lòng kiểm tra giỏ hàng <a href='cart.php'>click</a></span>";
                return $alert;
            } else {
                $alert =  "<span class='alert alert-success'>Đã thêm vào giỏ hàng</span>";
                return $alert;
            }
         }
    }
    public function get_product_cart()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_quantity($quantity,$cartId){

        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        
        $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId'";
        $result = $this->db->update($query);

        if ($result) {
            $alert = '<p class="alert alert-success text-center">Update cart thành công</p>';
            return $alert;
        } else {
            $alert = '<p class="alert alert-danger text-center">update cart thất bại</p>';
            return $alert;
        }
    }
    public function delcart($cartId){
        $query = "DELETE FROM tbl_cart WHERE cartId = '$cartId' ";
        //thực thi lệnh lấy
        $result = $this->db->delete($query);
        if ($result == true) {
            $alert = '<p class="alert alert-success text-center">Xóa sản phẩm trong giỏ thành công</p>';
            return $alert;
        } else {
            $alert = '<p class="alert alert-danger text-center">Xóa sản phẩm trong giỏ hàng thất bại</p>';
            return $alert;
        }
    }
    public function del_all_data_cart(){
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_order_custumer($id)
    {
        $query = "SELECT * FROM tbl_order WHERE custumerId = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_product_order($id)
    {
        $query = "SELECT * FROM tbl_order WHERE custumerId = '$id' ORDER BY id DESC ";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_order_pending()
    {
        $query = "SELECT * FROM tbl_order";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_order_moving_cancel()
    {
        $query = "SELECT * FROM tbl_order ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function order_pending($id,$price,$date)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $date = mysqli_real_escape_string($this->db->link, $date);
        $query = "UPDATE  tbl_order SET statusId = 0 WHERE id = '$id' AND date = '$date' AND price = '$price'";
        $result = $this->db->update($query);
        return $result;
    }
    public function order_moving($id,$price,$date)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $date = mysqli_real_escape_string($this->db->link, $date);
        $query = "UPDATE  tbl_order SET statusId = 1 WHERE id = '$id' AND date = '$date' AND price = '$price'";
        $result = $this->db->update($query);
        return $result;
    }
    public function order_cancel($id,$price,$date)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $date = mysqli_real_escape_string($this->db->link, $date);
        $query = "UPDATE  tbl_order SET statusId = 2 WHERE id = '$id' AND date = '$date' AND price = '$price'";
        $result = $this->db->update($query);
        return $result;
    }
    public function order_complete($id,$price,$date)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $date = mysqli_real_escape_string($this->db->link, $date);
        $query = "UPDATE  tbl_order SET statusId = 3 WHERE id = '$id' AND date = '$date' AND price = '$price'";
        $result = $this->db->update($query);
        return $result;
    }
    public function order_del($id, $price, $date){
        $id = mysqli_real_escape_string($this->db->link, $id);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $date = mysqli_real_escape_string($this->db->link, $date);
        $query = "DELETE FROM tbl_order WHERE id = '$id' AND price = '$price' AND date = '$date'";
        $result = $this->db->delete($query);
        return $result;
    }
}
?>