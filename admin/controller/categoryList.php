<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../model/database.php');
include_once ($filepath.'/../helpers/format.php');

?>
<?php
class category
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_category($catName)
    {
        //kiểm tra Form vừa nhập
        $catName = $this->fm->validation($catName);

        //kết nối với csdl
        $catName = mysqli_real_escape_string($this->db->link, $catName);


        if (empty($catName)) {
            $alert = '<p class="alert alert-danger text-center">Vui lòng điền Danh Mục bạn muốn thêm!!!</p>';
            return $alert;
        } else {
            $query = "INSERT INTO category(Name) VALUES ('$catName')";
            //thực thi lệnh lấy
            $result = $this->db->insert($query);

            if ($result == true) {
                $alert = '<p class="alert alert-success text-center">Thêm danh mục thành công</p>';
                return $alert;
            } else {
                $alert = '<p class="alert alert-danger text-center">Thêm danh mục thất bại</p>';
                return $alert;
            }
        }
    }
    public function show_category()
    {
        $query = "SELECT * FROM category";
        //thực thi lệnh lấy
        $result = $this->db->select($query);
        return $result;
    }
    public function getcatbyId($id)
    {
        $query = "SELECT * FROM category where Id = '$id' ";
        //thực thi lệnh lấy
        $result = $this->db->select($query);
        return $result;
    }
    public function update_category($catName,$id){
        //kiểm tra Form vừa nhập
        $catName = $this->fm->validation($catName);
        $id = $this->fm->validation($id);


        //kết nối với csdl
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $id = mysqli_real_escape_string($this->db->link, $id);


        if (empty($catName)) {
            $alert = '<p class="alert alert-danger text-center">Vui lòng điền Danh Mục bạn muốn thêm!!!</p>';
            return $alert;
        } else {
            $query = "UPDATE category SET Name = '$catName' WHERE Id = '$id' ";
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
    public function del_category($id){
        $query = "DELETE FROM category WHERE Id = '$id' ";
        //thực thi lệnh lấy
        $result = $this->db->delete($query);
        if ($result == true) {
            $alert = '<p class="alert alert-success text-center">Xóa danh mục thành công</p>';
            return $alert;
        } else {
            $alert = '<p class="alert alert-danger text-center">Xóa danh mục thất bại</p>';
            return $alert;
        }

    }
}


?>