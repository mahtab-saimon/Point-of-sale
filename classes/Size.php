<?php
include_once "../lib/Database.php";
include_once "../helpers/Format.php";
?>
<?php

class Size
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();

    }

    public function sizeInsert($sizeName)
    {
        $sizeName = $this->fm->validation($sizeName);
        $sizeName = mysqli_real_escape_string($this->db->link, $sizeName);
        if (empty($sizeName)) {
            $msg = "<span style='color:red; font_size:18px;'>This field must not be Empty..</span>";
            return $msg;
        } else {
            $query = "insert into sizes (sizeName) values('$sizeName')";
            $sizeName = $this->db->insert($query);
            if ($sizeName) {
                $msg = "<span style='color:green; font_size:18px;'>Size Inserted ..</span>";
                return $msg;

            } else {
                $msg = "<span style='color:red; font_size:18px;'>Size Not  Inserted ..</span>";
                return $msg;
            }
        }

    }
    public function getAllSize(){
        $query = "select * from sizes order by id desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function getSizeById($id){
        $query = "select * from sizes where id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function SizeUpdate($sizeName, $id){
        $sizeName = $this->fm->validation($sizeName);
        $sizeName = mysqli_real_escape_string($this->db->link, $sizeName);
        $id = mysqli_real_escape_string($this->db->link, $id);
        if (empty($sizeName)) {
            $msg = "<span style='color:red; font_size:18px;'>This field must not be Empty..</span>";
            return $msg;
        }else {
            $query = "update sizes set
                            sizeName = '$sizeName'
                            where id= '$id'";
            $brandUpdate = $this->db->update($query);
            if ($brandUpdate) {
                $msg = "<span style='color:green; font_size:18px;'>size Updated ..</span>";
                return $msg;

            } else {
                $msg = "<span style='color:red; font_size:18px;'>size Not  Updated ..</span>";
                return $msg;
            }
        }


    }

    public function delSizeById($id){
        $query = "delete from sizes where id = '$id'";
        $result = $this->db->delete($query);
        if ($result){
            $msg = "<span style='color:green; font_size:18px;'>size Deleted ..</span>";
            return $msg;

        }else {
            $msg = "<span style='color:red; font_size:18px;'>size Not  Deleted ..</span>";
            return $msg;
        }
    }

}