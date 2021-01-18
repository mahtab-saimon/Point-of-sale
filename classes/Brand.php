<?php
include_once "../lib/Database.php";
include_once "../helpers/Format.php";
?>
<?php

class Brand
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();

    }

    public function brandInsert($brandName)
    {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        if (empty($brandName)) {
            $msg = "<span style='color:red; font_size:18px;'>This field must not be Empty..</span>";
            return $msg;
        } else {
            $query = "insert into brands(brandName) values('$brandName')";
            $brandName = $this->db->insert($query);
            if ($brandName) {
                $msg = "<span style='color:green; font_size:18px;'>Brand Inserted ..</span>";
                return $msg;

            } else {
                $msg = "<span style='color:red; font_size:18px;'>Brand Not  Inserted ..</span>";
                return $msg;
            }
        }

    }
    public function getAllBrand(){
        $query = "select * from brands order by id desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function getBrandById($id){
        $query = "select * from brands where id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function brandUpdate($brandName, $id){
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        $id = mysqli_real_escape_string($this->db->link, $id);
        if (empty($brandName)) {
            $msg = "<span style='color:red; font_size:18px;'>This field must not be Empty..</span>";
            return $msg;
        }else {
            $query = "update brands set
                            brandName = '$brandName'
                            where id= '$id'";
            $brandUpdate = $this->db->update($query);
            if ($brandUpdate) {
                $msg = "<span style='color:green; font_size:18px;'>Brand Updated ..</span>";
                return $msg;

            } else {
                $msg = "<span style='color:red; font_size:18px;'>Brand Not  Updated ..</span>";
                return $msg;
            }
        }


    }

    public function delBrandById($id){
        $query = "delete from brands where id = '$id'";
        $result = $this->db->delete($query);
        if ($result){
            $msg = "<span style='color:green; font_size:18px;'>Brand Deleted ..</span>";
            return $msg;

        }else {
            $msg = "<span style='color:red; font_size:18px;'>Brand Not  Deleted ..</span>";
            return $msg;
        }
    }

}