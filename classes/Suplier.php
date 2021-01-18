<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath."/../lib/Database.php";
include_once $filepath."/../helpers/Format.php";
?>

<?php

class Suplier
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();

    }


    public function suplierInsert($data, $file)
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

        $shopName = $this->fm->validation($data['shopName']);
        $shopName= mysqli_real_escape_string($this->db->link,$shopName);

        $accountHolder = $this->fm->validation($data['accountHolder']);
        $accountHolder= mysqli_real_escape_string($this->db->link, $accountHolder);

        $accountNumber = $this->fm->validation($data['accountNumber']);
        $accountNumber = mysqli_real_escape_string($this->db->link,$accountNumber);

        $bankName = $this->fm->validation($data['bankName']);
        $bankName= mysqli_real_escape_string($this->db->link, $bankName);

        $bankBranch = $this->fm->validation($data['bankBranch']);
        $bankBranch = mysqli_real_escape_string($this->db->link,$bankBranch);

        $city = $this->fm->validation($data['city']);
        $city = mysqli_real_escape_string($this->db->link, $city);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "../img/suplier/" . $unique_image;

        if ($firstname == "" || $lastname == "" || $email == "" || $phone == "" || $address == "" || $shopName == "" || $accountHolder == "" || $accountNumber == ""|| $bankName == ""|| $bankBranch == ""|| $city == ""){
            $msg="<span style='color:red; font_size:18px;'>Field must not be empty ..</span>";
            return $msg;
        }
        $mailQuery = "select * from supliers where email = '$email' limit 1";
        $mailCheck = $this->db->select($mailQuery);
        if ($mailCheck !=false){
            $msg="<span style='color:red; font_size:18px;'>Email Already Exist ..</span>";
            return $msg;
        }else{
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO 
                        supliers(firstname , lastname,email,phone,address,shopName, image ,accountHolder , accountNumber, bankName, bankBranch, city) 
                        VALUES
                        ('$firstname', '$lastname', '$email', '$phone', '$address', '$shopName', '$uploaded_image', '$accountHolder', '$accountNumber', '$bankName','$bankBranch', '$city' )";
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




    public function getAllSuplier(){
        $query = "select * from supliers";
        $result = $this->db->select($query);
        return $result ;

    }

    public function delSuplierById($id)
    {
        $unlinkQuery = "select * from supliers where id = '$id'";
        $getData = $this->db->select($unlinkQuery);
        if ($getData) {
            while ($delImg = $getData->fetch_assoc()) {
                $delimage = $delImg['image'];
                unlink($delimage);
            }
        }
        $query = "delete from supliers where id = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $msg = "<span style='color:green; font_size:18px;'>Suplier Data Deleted ..</span>";
            return $msg;

        } else {
            $msg = "<span style='color:red; font_size:18px;'>Suplier Data Not  Deleted ..</span>";
            return $msg;
        }
    }

    public function geSuplierById($id)
    {
        $query = "select * from supliers where id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function suplierUpdate($data, $file, $id)
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

        $shopName = $this->fm->validation($data['shopName']);
        $shopName = mysqli_real_escape_string($this->db->link, $shopName);

        $accountHolder = $this->fm->validation($data['accountHolder']);
        $accountHolder = mysqli_real_escape_string($this->db->link, $accountHolder);

        $accountNumber = $this->fm->validation($data['accountNumber']);
        $accountNumber = mysqli_real_escape_string($this->db->link, $accountNumber);

        $bankName = $this->fm->validation($data['bankName']);
        $bankName = mysqli_real_escape_string($this->db->link, $bankName);

        $bankBranch = $this->fm->validation($data['bankBranch']);
        $bankBranch = mysqli_real_escape_string($this->db->link, $bankBranch);

        $city = $this->fm->validation($data['city']);
        $city = mysqli_real_escape_string($this->db->link, $city);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "../img/customer/" . $unique_image;

        if ($firstname == "" || $lastname == "" || $email == "" || $phone == "" || $address == "" || $shopName == "" || $accountHolder == "" || $accountNumber == "" || $bankName == "" || $bankBranch == "" || $city == "") {
            $msg = "<span style='color:red; font_size:18px;'>Field must not be empty ..</span>";
            return $msg;
        } else {
            if (!empty($file_name)) {
                if ($file_size > 1048567) {
                    echo "<span class='success'>Image size should be less 1MB. </span>";
                } else {
                    move_uploaded_file($file_temp, $uploaded_image);

                    $query = "update supliers set
                            firstname = '$firstname',
                            lastname = '$lastname',
                            email = '$email',
                            phone = '$phone',
                            address = '$address',
                            shopName = '$shopName',
                             image = '$uploaded_image',
                            accountHolder = '$accountHolder',
                            accountNumber = '$accountNumber',
                            bankName = '$bankName',
                            bankBranch = '$bankBranch',
                            city = '$city'
                            where id= '$id'";

                    $updated_rows = $this->db->update($query);
                    if ($updated_rows) {
                        echo "<span class='success'> Updated Successfully. </span>";
                    } else {
                        echo "<span class='error'> Not Updated !</span>";
                    }
                }
            } else {
                $query = "update supliers set
                             firstname = '$firstname',
                            lastname = '$lastname',
                            email = '$email',
                            phone = '$phone',
                            address = '$address',
                            shopName = '$shopName',
                            accountHolder = '$accountHolder',
                            accountNumber = '$accountNumber',
                            bankName = '$bankName',
                            bankBranch = '$bankBranch',
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