<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath."/../lib/Database.php";
include_once $filepath."/../helpers/Format.php";
?>


<?php

class Expence
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();

    }
    /*
    employee_id
    month
    year
    advance_salary*/

    public function addExpence($data)
    {
        $details = $this->fm->validation($data['details']);
        $details = mysqli_real_escape_string($this->db->link, $details);

        $amount = $this->fm->validation($data['amount']);
        $amount = mysqli_real_escape_string($this->db->link, $amount);

        $year = $this->fm->validation($data['year']);
        $year = mysqli_real_escape_string($this->db->link, $year);

        $month = $this->fm->validation($data['month']);
        $month = mysqli_real_escape_string($this->db->link, $month);

        $date = $this->fm->validation($data['date']);
        $date = mysqli_real_escape_string($this->db->link, $date);

        if ($details == "" ||$amount == ""  ||$year == ""  ||$month == ""  ||$date == ""  ) {
            $msg = "<span style='color:red; font_size:18px;'> field must not be Empty..</span>";
            return $msg;
        } else {
            $query = "insert into expenses(details, amount, year, month, date ) values('$details', '$amount','$year','$month','$date')";
            $catInsert = $this->db->insert($query);
            if ($catInsert) {
                $msg = "<span style='color:green; font_size:18px;'>Todays Expence Added ..</span>";
                return $msg;
            } else {
                $msg = "<span style='color:red; font_size:18px;'>Todays Expence Not Added ..</span>";
                return $msg;
            }
        }

    }

    public function getTodayExpence(){
        $date =date("d/m/y");
        $query = "select * from expenses where date='$date' order by id desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function getTodayTOtalExpence(){
        $date =date("d/m/y");
        $query = "SELECT SUM(amount) AS sum FROM  expenses WHERE date = '$date' ";
        $result = $this->db->select($query);
        return $result;
    }
 public function getMonthlyTOtalExpence(){
        $month =date("F");
        $query = "SELECT SUM(amount) AS sum FROM  expenses WHERE month = '$month' ";
        $result = $this->db->select($query);
        return $result;
    }
    public function getMonthlyExpence(){
        $month =date("F");
        $query = "select * from expenses where month='$month' order by id desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function getYearlyExpence(){
        $year =date("Y");
        $query = "select * from expenses where year='$year' order by id desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function getYearlyTOtalExpence(){
        $year =date("Y");
        $query = "SELECT SUM(amount) AS sum FROM  expenses WHERE year = '$year' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function getAdvanceSalaryById($id){
        $query = "select * from advance_salaries where id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function advanceSalaryUpdate($data, $id){
        $employee_id = $this->fm->validation($data['employee_id']);
        $employee_id = mysqli_real_escape_string($this->db->link, $employee_id);

        $month = $this->fm->validation($data['month']);
        $month = mysqli_real_escape_string($this->db->link, $month);

        $advance_salary = $this->fm->validation($data['advance_salary']);
        $advance_salary = mysqli_real_escape_string($this->db->link, $advance_salary);

        if ($employee_id == "" ||$month == "" ||$advance_salary == "" ) {
            $msg = "<span style='color:red; font_size:18px;'> field must not be Empty..</span>";
            return $msg;
        } else {
            $query = "update advance_salaries set
                            employee_id = '$employee_id',
                            month = '$month',
                            advance_salary = '$advance_salary'
                            where id= '$id'";
            $catUpdate = $this->db->update($query);
            if ($catUpdate) {
                $msg = "<span style='color:green; font_size:18px;'>advance salaries Updated ..</span>";
                return $msg;


            } else {
                $msg = "<span style='color:red; font_size:18px;'>advance salaries Not  Updated ..</span>";
                return $msg;
            }
        }


    }

    public function delAdvanceSalaryById($id){
        $query = "delete from advance_salaries where id = '$id'";
        $result = $this->db->delete($query);
        if ($result){
            $msg = "<span style='color:green; font_size:18px;'>advance salaries Deleted ..</span>";
            return $msg;

        }else {
            $msg = "<span style='color:red; font_size:18px;'>advance salaries Not  Deleted ..</span>";
            return $msg;
        }
    }


    public function januaryExpense(){
        $month ="January";
        $query = "select * from expenses where month='$month'";
        $result = $this->db->select($query);
        return $result;
    }

    public function FebruaryExpense(){
        $month ="February";
        $query = "select * from expenses where month='$month'";
        $result = $this->db->select($query);
        return $result;
    }

    public function MarchExpense(){
        $month ="March";
        $query = "select * from expenses where month='$month'";
        $result = $this->db->select($query);
        return $result;
    }

    public function AprilExpense(){
        $month ="April";
        $query = "select * from expenses where month='$month'";
        $result = $this->db->select($query);
        return $result;
    }

    public function MayExpense(){
        $month ="May";
        $query = "select * from expenses where month='$month'";
        $result = $this->db->select($query);
        return $result;
    }

    public function JuneExpense(){
        $month ="June";
        $query = "select * from expenses where month='$month'";
        $result = $this->db->select($query);
        return $result;
    }

    public function JulyExpense(){
        $month ="July";
        $query = "select * from expenses where month='$month'";
        $result = $this->db->select($query);
        return $result;
    }

    public function AugustExpense(){
        $month ="August";
        $query = "select * from expenses where month='$month'";
        $result = $this->db->select($query);
        return $result;
    }

    public function SeptemberExpense(){
        $month ="September";
        $query = "select * from expenses where month='$month'";
        $result = $this->db->select($query);
        return $result;
    }

    public function OctoberExpense(){
        $month ="October";
        $query = "select * from expenses where month='$month'";
        $result = $this->db->select($query);
        return $result;
    }

    public function NovemberExpense(){
        $month ="November";
        $query = "select * from expenses where month='$month'";
        $result = $this->db->select($query);
        return $result;
    }

    public function DecemberExpense(){
        $month ="December";
        $query = "select * from expenses where month='$month'";
        $result = $this->db->select($query);
        return $result;
    }

}