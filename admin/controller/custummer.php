<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../model/database.php');
include_once($filepath . '/../helpers/format.php');
?>
<?php
class custumer
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_custumers($data)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if ($name == "" || $city == "" || $zipcode == "" || $email == ""  || $address == "" || $country == "" || $phone == "" || $password == NULL ) {
            $alert = '<p class="alert alert-danger text-center">Vui lòng không được để rổng</p>';
            return $alert;
        }else{
            $checkmail = "SELECT * FROM tbl_custumer WHERE email = '$email' LIMIT 1";
            $result_check = $this->db->select($checkmail);
            if($result_check){
                $alert = '<p class="alert alert-danger text-center">Email đã tồn tại</p>';
                return $alert;
            }else{
                $query = "INSERT INTO tbl_custumer(name,city,zipcode,email,address,country,phone,password) VALUES ('$name', '$city','$zipcode',
                '$email','$address','$country','$phone','$password')";
                //thực thi lệnh lấy
                $result = $this->db->insert($query);
                if ($result == true) {
                    $alert = '<p class="alert alert-success text-center">Đăng kí thành công</p>';
                    return $alert;
                } else {
                    $alert = '<p class="alert alert-danger text-center">Đăng kí thất bại</p>';
                    return $alert;
                }
            }
        }
    }
    public function login_custumers($data){

        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if ($email == "" || $password == "" ) {
            $alert = '<p class="alert alert-danger text-center">Vui lòng không được để rổng</p>';
            return $alert;
        }else{
            $checklogin = "SELECT * FROM tbl_custumer WHERE email = '$email' AND password = '$password' LIMIT 1";
            $result_check = $this->db->select($checklogin);
            if($result_check){
                $value = $result_check->fetch_assoc();
               Session::set('custumer_longin',true);
               Session::set('custumer_id',$value['id']);
               Session::set('custumer_name',$value['name']);

                echo "<script>window.location='checkout.php'</script>";

            }else{
                $alert = '<p class="alert alert-danger text-center">Tài khoản hoặc mật khẩu không chính xác </p>';
                return $alert;
            }
        }
    }
    public function show_custumers($id){
        $query = "SELECT * FROM tbl_custumer WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_custumer($data,$id)
    {
        //kiểm tra Form vừa nhập
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);

       
        if ($name == "" || $city == "" || $zipcode == "" || $email == ""  || $address == "" || $phone == "" ) {
            $alert = '<p class="alert alert-danger text-center">Vui lòng không được để rổng</p>';
            return $alert;
        } else {
            $query = "UPDATE tbl_custumer SET
            name = '$name',
            city = '$city',
            zipcode = '$zipcode',
            email = '$email',
            address = '$address',
            phone = '$phone'
            WHERE id = '$id'";
            //thực thi lệnh lấy
            $result = $this->db->update($query);
            

            if ($result == true) {
                Session::set('custumer_name',$name);
                $alert = '<p class="alert alert-success text-center">Update Profile thành công</p>';
                return $alert;
            } else {
                $alert = '<p class="alert alert-danger text-center">Update profile thất bại</p>';
                return $alert;
            }
        }
    }
    public function insert_order($id){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $get_product_cart = $this->db->select($query);
            if ($get_product_cart) {
                $totalprice = 0;
                while ($result = $get_product_cart->fetch_assoc()) {
                    $productId = $result['productId'];
                    $productName = $result['productName'];
                    $quantity = $result['quantity'];
                    $image = $result['image'];
                    $price = $result['price'];
                    $totalprice += $result['price'];
                    $query_order = "INSERT INTO tbl_order(productId, productName, custumerId, quantity, price, image) VALUES 
                    ('$productId','$productName','$id','$quantity','$price','$image')";
                    $result_order = $this->db->insert($query_order);
                }
             }
    }
    public function order_complete_index($id, $price, $date,$custumerId){
        $sId = session_id();
        $id = mysqli_real_escape_string($this->db->link, $id);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $date = mysqli_real_escape_string($this->db->link, $date);
        $query = "UPDATE  tbl_order SET statusId = 3 WHERE id = '$id' AND date = '$date' AND price = '$price' AND custumerId = '$custumerId'";
        $result = $this->db->update($query);
        return $result;
    }
    public function order_del_index($id, $price, $date,$custumerId){
        $id = mysqli_real_escape_string($this->db->link, $id);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $date = mysqli_real_escape_string($this->db->link, $date);
        $query = "DELETE FROM tbl_order WHERE id = '$id' AND price = '$price' AND date = '$date' AND custumerId = '$custumerId'";
        $result = $this->db->delete($query);
        return $result;
    }
}