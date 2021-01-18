<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath."/../lib/Database.php";
include_once $filepath."/../helpers/Format.php";
?>


<?php

class Category
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();

    }

    public function productInsert($catName)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        if (empty($catName)) {
            $msg = "<span style='color:red; font_size:18px;'>This field must not be Empty..</span>";
            return $msg;
        } else {
            $query = "insert into categories(categoryName) values('$catName')";
            $catInsert = $this->db->insert($query);
            if ($catInsert) {
                $msg = "<span style='color:green; font_size:18px;'>Category Inserted ..</span>";
                return $msg;
            } else {
                $msg = "<span style='color:red; font_size:18px;'>Category Not  Inserted ..</span>";
                return $msg;
            }
        }

    }
    public function getAllCat(){
        $query = "select * from categories order by id desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function getCatById($id){
        $query = "select * from categories where id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function catUpdate($catName, $id){
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $id = mysqli_real_escape_string($this->db->link, $id);
        if (empty($catName)) {
            $msg = "<span style='color:red; font_size:18px;'>This field must not be Empty..</span>";
            return $msg;
         } else {
            $query = "update categories set
                            categoryName = '$catName'
                            where id= '$id'";
            $catUpdate = $this->db->update($query);
            if ($catUpdate) {
                $msg = "<span style='color:green; font_size:18px;'>Category Updated ..</span>";
                return $msg;


            } else {
                $msg = "<span style='color:red; font_size:18px;'>Category Not  Updated ..</span>";
                return $msg;
            }
        }


    }

    public function delCatById($id){
        $query = "delete from categories where id = '$id'";
        $result = $this->db->delete($query);
        if ($result){
            $msg = "<span style='color:green; font_size:18px;'>Category Deleted ..</span>";
            return $msg;

        }else {
            $msg = "<span style='color:red; font_size:18px;'>Category Not  Deleted ..</span>";
            return $msg;
        }
    }

}