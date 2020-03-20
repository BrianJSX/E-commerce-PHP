<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../model/session.php');
Session::checkLogin();
include_once($filepath . '/../model/database.php');
include_once($filepath . '/../helpers/format.php');


?>
<?php
class adminlogin
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function login_admin($adminUser, $adminPass)
    {
        $adminUser = $this->fm->validation($adminUser);
        $adminPass = $this->fm->validation($adminPass);

        //kết nối với csdl
        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

        if (empty($adminUser) || empty($adminPass)) {
            $alert = 'Vui lòng nhập tài khoản và mật khẩu';
            return $alert;
        } else {
            //lấy từ csdl kiểm tra điều kiện
            $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' LIMIT 1";
            //thực thi lệnh lấy
            $result = $this->db->select($query);

            if ($result != false) {

                $value = $result->fetch_assoc();

                Session::set('adminlogin', true);
                Session::set('adminId', $value['adminId']);
                Session::set('adminUser', $value['adminUser']);
                Session::set('adminName', $value['adminName']);
                $check_level = Session::set('adminLevel', $value['level']);
                if ($check_level == 0 || $check_level == 1){
                    header('Location:index.php');
                }else{
                    header('Location:products.php');
                }
                  
            } else {
                $alert = 'sai tài khoản mật khẩu';
                return $alert;
            }
        }
    }
}

?>