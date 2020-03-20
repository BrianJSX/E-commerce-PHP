<?php
//XÁC NHẬN MAIL
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
//INCLUDE FILE
$filepath = realpath(dirname(__FILE__));
include ($filepath.'/../model/session.php');
Session::checkLogin();
include_once ($filepath.'/../model/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php
class adminregister
{
    private $db;
    private $fm;
    
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    
    }
    public function register_admin($adminName,$adminUser,$adminEmail,$adminPass, $adminRepass)
    {
        
        //Kiem tra form da nhap
        $adminName = $this->fm->validation($adminName);
        $adminUser = $this->fm->validation($adminUser);
        $adminEmail = $this->fm->validation($adminEmail);
        $adminPass = $this->fm->validation($adminPass);
        $adminRepass = $this->fm->validation($adminRepass);

        //kết nối với csdl
        $adminName = mysqli_real_escape_string($this->db->link, $adminUser);
        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
        $adminEmail = mysqli_real_escape_string($this->db->link, $adminEmail);
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);
        $adminRepass = mysqli_real_escape_string($this->db->link, $adminRepass);
       
        
        
        //Ham register
        if ( empty($adminName) || empty($adminUser) || empty($adminEmail) || empty($adminPass) || empty($adminRepass)) {
            $alert = '<p class="alert alert-danger">Vui lòng nhập đầy đủ thông tin!!</p>';
            return $alert;
        }
        if($adminPass != $adminRepass)
                {
                    $alert = '<p class="alert alert-danger">Mật khẩu không Khớp!!!</p>';
                    return $alert;
                }
        else
        {
            $register = new adminregister;
            $mail = $register->getmailinfo($adminEmail);
           

            $Usertest = new adminregister;
            $User = $Usertest->getUserinfo($adminUser);
            
            
            if ($mail)
                {
                $alert = '<p class="alert alert-danger">Mail đã tồn tại!!</p>';
                return $alert;
                }
            else if(!$mail && $User) 
                {
                    $alerts = '<p class="alert alert-danger">Tên User đã tồn tại!!</p>';
                    return $alerts;
                }
            else 
                {
                    $alert = '<p class="alert alert-success">Đăng kí thành công!!</p>';
                    //lấy từ csdl kiểm tra điều kiện
                    $query = "INSERT INTO tbl_admin (adminName, adminUser, adminEmail, adminPass)
                    VALUES ('$adminName', '$adminUser', '$adminEmail', '$adminPass')";
                    //thực thi lệnh lấy
                    $result = $this->db->insert($query);
                    return $alert;
                }
        }
    }
    public function getmailinfo($adminEmail){
        $query = "SELECT adminId FROM tbl_admin WHERE adminEmail = '$adminEmail' LIMIT 1";
        return $this->db->select($query);
    }
    public function getUserinfo($adminUser){
        $query = "SELECT adminUser FROM tbl_admin WHERE adminUser = '$adminUser' LIMIT 1";
        return $this->db->selectsingle($query);
    }
}

?>