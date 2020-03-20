<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../model/database.php');
include_once ($filepath.'/../helpers/format.php');


?>
<?php
class product
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_product($data, $files)
    {

        //kết nối với csdl
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $pricesale = mysqli_real_escape_string($this->db->link, $data['pricesale']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);
        $stock = mysqli_real_escape_string($this->db->link, $data['stock']);

        // kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
        $file_image = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']["tmp_name"];
        $uploaded_image = "uploads/";

        if ($productName == "" || $category == "" || $product_desc == "" || $type == "" || $file_image == "" || $stock == "") {
            $alert = '<p class="alert alert-danger text-center">Vui lòng không được để rổng</p>';
            return $alert;
        } else {
            move_uploaded_file($file_tmp, $uploaded_image . '/' . $file_image);
            $query = "INSERT INTO product(productName,categoryId,product_desc,price,pricesale,type,stock,image) VALUES ('$productName', '$category','$product_desc',
            '$price','$pricesale','$type','$stock','$file_image')";
            //thực thi lệnh lấy
            $result = $this->db->insert($query);

            if ($result == true) {
                $alert = '<p class="alert alert-success text-center">Thêm Product thành công</p>';
                return $alert;
            } else {
                $alert = '<p class="alert alert-danger text-center">Thêm product thất bại</p>';
                return $alert;
            }
        }
    }
    public function show_product()
    {
        $query = "SELECT product.*,category.Name FROM product INNER JOIN category ON categoryId = Id  ORDER BY ProductId DESC ";
        //thực thi lệnh lấy
        $result = $this->db->select($query);
        return $result;
    }
    public function getproductbyId($id)
    {
        $query = "SELECT * FROM product where ProductId = '$id' ";
        //thực thi lệnh lấy
        $result = $this->db->select($query);
        return $result;
    }
    public function update_product($data,$files,$id)
    {
        //kiểm tra Form vừa nhập
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $pricesale = mysqli_real_escape_string($this->db->link, $data['pricesale']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);
        $stock = mysqli_real_escape_string($this->db->link, $data['stock']);

       
        if ($productName == "" || $category == "" || $product_desc == "" || $price == ""  || $type == "" || $stock == "" ) {
            $alert = '<p class="alert alert-danger text-center">Vui lòng không được để rổng</p>';
            return $alert;
        } else {
           
            $query = "UPDATE product SET
            productName = '$productName',
            categoryId = '$category',
            product_desc = '$product_desc',
            price = '$price',
            pricesale = '$pricesale',
            type = '$type',
            stock = '$stock'
            WHERE productId = '$id'";
            //thực thi lệnh lấy
            $result = $this->db->update($query);

            if ($result == true) {
                $alert = '<p class="alert alert-success text-center">Update Product thành công</p>';
                return $alert;
            } else {
                $alert = '<p class="alert alert-danger text-center">Update product thất bại</p>';
                return $alert;
            }
        }
    }
    public function del_product($id)
    {
        $query = "DELETE FROM product WHERE ProductId = '$id' ";
        //thực thi lệnh lấy
        $result = $this->db->delete($query);
        if ($result == true) {
            $alert = '<p class="alert alert-success text-center">Xóa Product thành công</p>';
            return $alert;
        } else {
            $alert = '<p class="alert alert-danger text-center">Xóa Product thất bại</p>';
            return $alert;
        }
    }
    public function changeimage_product ($files,$id){
        $file_image = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']["tmp_name"];
        $uploaded_image = "uploads/";

        if ($file_image == "") {
            $alert = '<p class="alert alert-danger text-center">Vui lòng không được để rổng</p>';
            return $alert;
        } else {
            move_uploaded_file($file_tmp, $uploaded_image . '/' . $file_image);
            $query = "UPDATE product SET image = '$file_image' WHERE productId = '$id'";
            //thực thi lệnh lấy
            $result = $this->db->insert($query);
            if ($result == true) {
                $alert = '<p class="alert alert-success text-center">Update image thành công</p>';
                return $alert;
            } else {
                $alert = '<p class="alert alert-danger text-center">Change image thất bại</p>';
                return $alert;
            }

        }
    }
    //----------------------------------------------Hàm front-end product--------------------------------------------//
    public function getproduct_feathered()
    {
        $query = "SELECT * FROM product INNER JOIN category ON categoryId = Id WHERE type = '0' ORDER BY ProductId DESC LIMIT 10";
        $result = $this->db->select ($query);
        return $result;
    }
    public function getproduct_feathered_new()
    {
        $query = "SELECT * FROM product INNER JOIN category ON categoryId = Id  ORDER BY ProductId DESC LIMIT 6";
        $result = $this->db->select ($query);
        return $result;
    }
    public function product_category_new($id)
    {
        $query = "SELECT * FROM product INNER JOIN category ON categoryId = Id WHERE categoryId = '$id' ORDER BY ProductId DESC LIMIT 5";
        $result = $this->db->select ($query);
        return $result;
    }
    public function getproduct_feathered_sale()
    {
        $query = "SELECT * FROM product INNER JOIN category ON categoryId = Id WHERE type = '0' ORDER BY ProductId DESC LIMIT 6";
        $result = $this->db->select ($query);
        return $result;
    }
    public function getproductdetail($id){
        $query = "SELECT * FROM product INNER JOIN category ON categoryId = Id WHERE ProductId = '$id'";
        $result = $this->db->select ($query);
        return $result;
    }
    public function getproductRelate($id){
        $query = "SELECT * FROM product INNER JOIN category ON categoryId = Id WHERE categoryId = '$id' ORDER BY ProductId DESC LIMIT 4";
        $result = $this->db->select ($query);
        return $result;
    }
    public function getcategoryidproduct($id){
        $query = "SELECT categoryId FROM product WHERE ProductId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
   
}

    //-----------------------------------------------Class Category--------------------------------------------------//
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
    public function update_category($catName, $id)
    {
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
                $alert = '<p class="alert alert-success text-center">Thêm danh mục thành công</p>';
                return $alert;
            } else {
                $alert = '<p class="alert alert-danger text-center">Thêm danh mục thất bại</p>';
                return $alert;
            }
        }
    }
    public function del_category($id)
    {
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
    public function get_category_index()
    {
        $query = "SELECT * FROM category LIMIT 7";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_category_Name($id)
    {
        $query = "SELECT * FROM category WHERE Id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_product_cat($id , $page){
        $limit  = 10;
        $count_product_cat = "SELECT count(productid) AS total FROM product WHERE categoryId = '$id'";
        $count = $this->db->select($count_product_cat);
        $result_count = $count->fetch_assoc();
        // echo $result_count['total'];
        $total_page = ceil($result_count['total'] / $limit);
        // echo $total_page;

        if ($page > $total_page){
            $page = $total_page;
        }elseif ($page < 1){
            $page = 1;
        }
       
        $start = ($page - 1) * $limit ;
        $query = "SELECT * FROM product INNER JOIN category ON categoryId = Id  WHERE categoryId = '$id' LIMIT $start , $limit";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_product_sale($page){
        $limit  = 10;
        $count_product_cat = "SELECT count(productid) AS total FROM product WHERE pricesale < price and pricesale != 0";
        $count = $this->db->select($count_product_cat);
        $result_count = $count->fetch_assoc();
        // echo $result_count['total'];
        $total_page = ceil($result_count['total'] / $limit);
        // echo $total_page;

        if ($page > $total_page){
            $page = $total_page;
        }elseif ($page < 1){
            $page = 1;
        }
       
        $start = ($page - 1) * $limit ;
        $query = "SELECT * FROM product INNER JOIN category ON categoryId = Id  WHERE pricesale < price and pricesale != 0 ORDER BY ProductId DESC LIMIT $start , $limit ";
        $result = $this->db->select($query);
        return $result;
    }
    public function search_product($tukhoa){
       
        $tukhoa = $this->fm->validation($tukhoa);
       
        $tukhoa = mysqli_real_escape_string($this->db->link, $tukhoa);
                
        $query = "SELECT * FROM product INNER JOIN category ON categoryId = Id  WHERE productName Like '%$tukhoa%' LIMIT 10";
        $result = $this->db->select($query);
        return $result;
    }
    public function total_page($id){
        $total_page = "SELECT count(productid) AS total FROM product WHERE categoryId = '$id'";
        $result = $this->db->select($total_page);
        return $result;
    }
    public function total_page_sale(){
        $total_page = "SELECT count(productid) AS total FROM product WHERE pricesale < price and pricesale != 0";
        $result = $this->db->select($total_page);
        return $result;
    }
    

    public function total_page_search($tukhoa){
        $tukhoa = mysqli_real_escape_string($this->db->link, $tukhoa);
        $count_search_product = "SELECT COUNT(productid) AS total FROM product WHERE productName LIKE '%$tukhoa%'";
        $count = $this->db->select($count_search_product);
        return $count;
    }

}


?>