<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath."/../lib/Database.php";
include_once $filepath."/../helpers/Format.php";
?>

<?php

class Employee
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();

    }


    public function employeeInsert($data, $file)
    {
        $firstname = $this->fm->validation($data['firstname']);
        $firstname = mysqli_real_escape_string($this->db->link, $firstname);

        $lastname = $this->fm->validation($data['lastname']);
        $lastname = mysqli_real_escape_string($this->db->link, $lastname);

        $email = $this->fm->validation($data['email']);
        $email = mysqli_real_escape_string($this->db->link, $email);

        $phone = $this->fm->validation($data['phone']);
        $phone = mysqli_real_escape_string($this->db->link, $phone);

        $address = $this->fm->validation($data['address']);
        $address = mysqli_real_escape_string($this->db->link, $address);

        $experience = $this->fm->validation($data['experience']);
        $experience= mysqli_real_escape_string($this->db->link,$experience);

        $salary = $this->fm->validation($data['salary']);
        $salary= mysqli_real_escape_string($this->db->link, $salary);

        $vacation = $this->fm->validation($data['vacation']);
        $vacation = mysqli_real_escape_string($this->db->link,$vacation);

        $city = $this->fm->validation($data['city']);
        $city = mysqli_real_escape_string($this->db->link, $city);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "../img/employee" . $unique_image;

        if ($firstname == "" || $lastname == "" || $email == "" || $phone == "" || $address == "" || $experience == "" || $salary == "" || $vacation == ""|| $city == ""){
            $msg="<span style='color:red; font_size:18px;'>Field must not be empty ..</span>";
            return $msg;
        }
        $mailQuery = "select * from employees where email = '$email' limit 1";
        $mailCheck = $this->db->select($mailQuery);
        if ($mailCheck !=false){
            $msg="<span style='color:red; font_size:18px;'>Email Already Exist ..</span>";
            return $msg;
        }else{
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO 
                        employees(firstname , lastname,email,phone,address,experience ,salary,vacation ,city, image) 
                        VALUES
                        ('$firstname', '$lastname', '$email', '$phone', '$address', '$experience', '$salary', '$vacation', '$city', '$uploaded_image' )";
            $inserted_rows = $this->db->insert($query);
            if ($inserted_rows) {
                $msg= "<span class='success'>Data Inserted Successfully.</span>";
                return $msg;
            }else {
                $msg= "<span class='error'>Data Not Inserted !</span>";
                return $msg;
            }
        }
    }


    public function getAllEmployee(){
        $query = "select * from employees";
        $result = $this->db->select($query);
        return $result ;

    }
    public function geEmployeeById($id)
    {
        $query = "select * from employees where id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }


    public function delEmployeeById($id)
    {
        $unlinkQuery = "select * from employees where id = '$id'";
        $getData = $this->db->select($unlinkQuery);
        if ($getData) {
            while ($delImg = $getData->fetch_assoc()) {
                $delimage = $delImg['image'];
                unlink($delimage);
            }
        }
        $query = "delete from employees where id = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $msg = "<span style='color:green; font_size:18px;'>Employee Data Deleted ..</span>";
            return $msg;

        } else {
            $msg = "<span style='color:red; font_size:18px;'>Employee Data Not  Deleted ..</span>";
            return $msg;
        }
    }

    public function employeeUpdate($data, $file, $id)
    {

        $firstname = $this->fm->validation($data['firstname']);
        $firstname = mysqli_real_escape_string($this->db->link, $firstname);

        $lastname = $this->fm->validation($data['lastname']);
        $lastname = mysqli_real_escape_string($this->db->link, $lastname);

        $email = $this->fm->validation($data['email']);
        $email = mysqli_real_escape_string($this->db->link, $email);

        $phone = $this->fm->validation($data['phone']);
        $phone = mysqli_real_escape_string($this->db->link, $phone);

        $address = $this->fm->validation($data['address']);
        $address = mysqli_real_escape_string($this->db->link, $address);

        $experience = $this->fm->validation($data['experience']);
        $experience = mysqli_real_escape_string($this->db->link, $experience);

        $salary = $this->fm->validation($data['salary']);
        $salary = mysqli_real_escape_string($this->db->link, $salary);

        $vacation = $this->fm->validation($data['vacation']);
        $vacation = mysqli_real_escape_string($this->db->link, $vacation);

        $city = $this->fm->validation($data['city']);
        $city = mysqli_real_escape_string($this->db->link, $city);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "../img/employee/" . $unique_image;


        if ($firstname == "" || $lastname == "" || $email == "" || $phone == "" || $address == "" || $experience == "" || $salary == "" || $vacation == "" || $city == "") {
            $msg = "<span style='color:red; font_size:18px;'>Field must not be empty ..</span>";
            return $msg;
        } else {
            if (!empty($file_name)) {
                if ($file_size > 1048567) {
                    echo "<span class='success'>Image size should be less 1MB. </span>";
                } else {
                    move_uploaded_file($file_temp, $uploaded_image);

                    $query = "update employees set
                            firstname = '$firstname',
                            lastname = '$lastname',
                            email = '$email',
                            phone = '$phone',
                            address = '$address',
                            experience = '$experience',
                            salary = '$salary',
                            vacation = '$vacation',
                            city = '$city',
                            image = '$uploaded_image'
                            where id= '$id'";

                    $updated_rows = $this->db->update($query);
                    if ($updated_rows) {
                        echo "<span class='success'> Updated Successfully. </span>";
                    } else {
                        echo "<span class='error'> Not Updated !</span>";
                    }
                }
            } else {
                $query = "update employees set
                            firstname = '$firstname',
                            lastname = '$lastname',
                            email = '$email',
                            phone = '$phone',
                            address = '$address',
                            experience = '$experience',
                            salary = '$salary',
                            vacation = '$vacation',
                            city = '$city'
                            where id= '$id'";

                $updated_rows = $this->db->update($query);
                if ($updated_rows) {
                    echo "<span class='success'> Updated Successfully. </span>";
                } else {
                    echo "<span class='error'> Not Updated !</span>";
                }


            }
        }
    }


}