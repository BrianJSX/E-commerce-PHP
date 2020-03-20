<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../model/database.php');
include_once($filepath . '/../helpers/format.php');

?>
<?php
class adminAccount
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function addnewprof($adminName, $adminUser, $adminEmail, $adminPass, $adminRepass)
    {

        $adminName = $this->fm->validation($adminName);
        $adminUser = $this->fm->validation($adminUser);
        $adminEmail = $this->fm->validation($adminEmail);
        $adminPass = $this->fm->validation($adminPass);
        $adminRepass = $this->fm->validation($adminRepass);

        $adminName = mysqli_real_escape_string($this->db->link, $adminName);
        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
        $adminEmail = mysqli_real_escape_string($this->db->link, $adminEmail);
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);
        $adminRepass = mysqli_real_escape_string($this->db->link, $adminRepass);

        if (empty($adminName) || empty($adminUser) ||  empty($adminEmail) || empty($adminPass) || empty($adminRepass)) {
            $alert = '<p class="alert alert-danger text-center">Vui lòng điền Danh Mục bạn muốn thêm!!!</p>';
            return $alert;
        } else if ($adminPass != $adminRepass) {
            $alert = '<p class="alert alert-danger text-center">Mật khẩu không khớp vui lòng nhập lại</p>';
            return $alert;
        } else {
            $register = new adminAccount;
            $mail = $register->getmailinfo($adminEmail);


            $Usertest = new adminAccount;
            $User = $Usertest->getUserinfo($adminUser);

            if ($mail) {
                $alert = '<p class="alert alert-danger text-center">Mail đã tồn tại</p>';
                return $alert;
            } else if (!$mail && $User) {
                $alert = '<p class="alert alert-danger text-center">Tên User đã tồn tại</p>';
                return $alert;
            } else {
                $query = "INSERT INTO tbl_admin(adminName,adminUser,adminEmail, adminPass) VALUES ('$adminName','$adminUser','$adminEmail   ','$adminPass')";
                //thực thi lệnh lấy
                $result = $this->db->insert($query);

                if ($result == true) {
                    $alert = '<p class="alert alert-success text-center">Thêm Account admin thành công</p>';
                    return $alert;
                } else {
                    $alert = '<p class="alert alert-danger text-center">Thêm Account admin thành công</p>';
                    return $alert;
                }
            }
        }
    }
    public function addnewprouser($name, $address, $city, $country, $zipcode,$phone,$email,$password)
    {
        $name = $this->fm->validation($name);
        $address =$this->fm->validation($address);
        $city = $this->fm->validation($city);
        $country = $this->fm->validation($country);
        $zipcode = $this->fm->validation($zipcode);
        $phone = $this->fm->validation($phone);
        $email = $this->fm->validation($email);

        $name = mysqli_real_escape_string($this->db->link, $name);
        $city = mysqli_real_escape_string($this->db->link, $city);
        $zipcode = mysqli_real_escape_string($this->db->link, $zipcode);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $country = mysqli_real_escape_string($this->db->link, $country);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $password = mysqli_real_escape_string($this->db->link, md5($password));

        if ($name == "" || $city == "" || $zipcode == "" || $email == ""  || $address == "" || $country == "" || $phone == "" || $password == "" ) {
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
    

    public function showaccount()
    {
        $query = "SELECT * FROM tbl_admin";
        //thực thi lệnh lấy
        $result = $this->db->select($query);
        return $result;
    }
    public function showaccountuser()
    {
        $query = "SELECT * FROM tbl_custumer";
        //thực thi lệnh lấy
        $result = $this->db->select($query);
        return $result;
    }
    public function showaccountuserid($id)
    {
        $query = "SELECT * FROM tbl_custumer WHERE id = '$id'";
        //thực thi lệnh lấy
        $result = $this->db->select($query);
        return $result;
    }
    public function getaccountbyId($id)
    {
        $query = "SELECT * FROM tbl_admin where adminId = '$id' ";
        //thực thi lệnh lấy
        $result = $this->db->select($query);
        return $result;
    }
    public function getaccountuserbyId($id)
    {
        $query = "SELECT * FROM tbl_custumer where id = '$id' ";
        //thực thi lệnh lấy
        $result = $this->db->select($query);
        return $result;
    }
    public function update_custumers($name, $address, $city, $country, $zipcode,$phone,$email,$id)
    {
        //kiểm tra Form vừa nhập
        $name = mysqli_real_escape_string($this->db->link, $name);
        $city = mysqli_real_escape_string($this->db->link, $city);
        $zipcode = mysqli_real_escape_string($this->db->link, $zipcode);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $country = mysqli_real_escape_string($this->db->link, $country);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $id = mysqli_real_escape_string($this->db->link, $id);
       
        if ($name == "" || $city == "" || $zipcode == "" || $email == ""  || $address == "" || $phone == "" ) {
            $alert = '<p class="alert alert-danger text-center">Vui lòng không được để rổng</p>';
            return $alert;
        } else {
            $checkmail = "SELECT * FROM tbl_custumer WHERE email = '$email' LIMIT 1";
            $result_check = $this->db->select($checkmail);
            if($result_check){
                $alert = '<p class="alert alert-danger text-center">Email đã tồn tại</p>';
                return $alert;
            }else{
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
            }
            if ($result == true) {
                Session::set('custumer_name',$name);
                $alert = '<p class="alert alert-success text-center">Update thành công</p>';
                return $alert;
            } else {
                $alert = '<p class="alert alert-danger text-center">Update thất bại</p>';
                return $alert;
            }
        }
    }
    public function updateaccount($adminName,$adminEmail,$level, $id)
    {
        //kiểm tra Form vừa nhập
        $adminName = $this->fm->validation($adminName);
        $adminEmail = $this->fm->validation($adminEmail);
        $id = $this->fm->validation($id);


        //kết nối với csdl
        $adminName = mysqli_real_escape_string($this->db->link, $adminName);
        $adminEmail = mysqli_real_escape_string($this->db->link, $adminEmail);
        $level = mysqli_real_escape_string($this->db->link, $level);
        $id = mysqli_real_escape_string($this->db->link, $id);



        if (empty($adminName) || empty($adminEmail) || empty($level)) {
            $alert = '<p class="alert alert-danger text-center">Vui lòng điền Danh Mục bạn muốn thêm!!!</p>';
            return $alert;
        } else {

                $query = "UPDATE tbl_admin SET adminName = '$adminName' , adminEmail = '$adminEmail' , level = '$level' WHERE adminId = '$id' ";
                $result = $this->db->update($query);

                if ($result == true) {
                    $alert = '<p class="alert alert-success text-center">Sửa thành công</p>';
                    return $alert;
                } else {
                    $alert = '<p class="alert alert-danger text-center">Sửa thất bại</p>';
                    return $alert;
                }
            }
    }
    public function del_account($id)
    {
        $query = "DELETE FROM tbl_admin WHERE adminId = '$id' ";
        //thực thi lệnh lấy
        $result = $this->db->delete($query);
        if ($result == true) {
            $alert = '<p class="alert alert-success text-center">Xóa Account thành công</p>';
            return $alert;
        } else {
            $alert = '<p class="alert alert-danger text-center">Xóa Account thất bại</p>';
            return $alert;
        }
    }
    public function del_account_user($id)
    {
        $query = "DELETE FROM tbl_custumer WHERE id = '$id' ";
        //thực thi lệnh lấy
        $result = $this->db->delete($query);
        if ($result == true) {
            $alert = '<p class="alert alert-success text-center">Xóa Account thành công</p>';
            return $alert;
        } else {
            $alert = '<p class="alert alert-danger text-center">Xóa Account thất bại</p>';
            return $alert;
        }
    }
    public function getmailinfo($adminEmail)
    {
        $query = "SELECT adminId FROM tbl_admin WHERE adminEmail = '$adminEmail' LIMIT 1";
        return $this->db->select($query);
    }
    public function getUserinfo($adminUser)
    {
        $query = "SELECT adminUser FROM tbl_admin WHERE adminUser = '$adminUser' LIMIT 1";
        return $this->db->selectsingle($query);
    }
}
?>