<?php
include_once "../lib/Database.php";
include_once "../helpers/Format.php";
?>
<?php

class Color
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();

    }

    public function colorInsert($color)
    {
        $color = $this->fm->validation($color);
        $color = mysqli_real_escape_string($this->db->link, $color);
        if (empty($color)) {
            $msg = "<span style='color:red; font_size:18px;'>This field must not be Empty..</span>";
            return $msg;
        } else {
            $query = "insert into colors(color) values('$color')";
            $color = $this->db->insert($query);
            if ($color) {
                $msg = "<span style='color:green; font_size:18px;'>Color Inserted ..</span>";
                return $msg;

            } else {
                $msg = "<span style='color:red; font_size:18px;'>Color Not  Inserted ..</span>";
                return $msg;
            }
        }

    }
    public function getAllColor(){
        $query = "select * from colors order by id desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function getColorById($id){
        $query = "select * from colors where id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function ColorUpdate($color, $id){
        $color = $this->fm->validation($color);
        $color = mysqli_real_escape_string($this->db->link, $color);
        $id = mysqli_real_escape_string($this->db->link, $id);
        if (empty($color)) {
            $msg = "<span style='color:red; font_size:18px;'>This field must not be Empty..</span>";
            return $msg;
        }else {
            $query = "update colors set
                            color = '$color'
                            where id= '$id'";
            $brandUpdate = $this->db->update($query);
            if ($brandUpdate) {
                $msg = "<span style='color:green; font_size:18px;'>Color Updated ..</span>";
                return $msg;

            } else {
                $msg = "<span style='color:red; font_size:18px;'>Color Not  Updated ..</span>";
                return $msg;
            }
        }


    }

    public function delColorById($id){
        $query = "delete from colors where id = '$id'";
        $result = $this->db->delete($query);
        if ($result){
            $msg = "<span style='color:green; font_size:18px;'>Color Deleted ..</span>";
            return $msg;

        }else {
            $msg = "<span style='color:red; font_size:18px;'>Color Not  Deleted ..</span>";
            return $msg;
        }
    }

}