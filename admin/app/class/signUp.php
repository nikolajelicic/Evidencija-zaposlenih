<?php

include '../database/db.php';

class LoginAdmin extends Database{

    public $db;
    public $conn;
    public $email;
    public $password;
    public $error;
    public function authAdmin($email,$password){
        $this->email = $email;
        $this->password = $password;
        $sql = "SELECT * FROM admin WHERE email=:email AND password=:password";
        $query = parent::connect()->prepare($sql);
        $query->bindParam(":email",$this->email);
        $query->bindParam(":password",$this->password);
        if(isset($_POST['submit'])){
            $query->execute();
            if($query->rowCount()==1){
                //session_start();
                //$_SESSION['name']="ADMIN";
                $this->session();
                header("Location: http://localhost/evidencija%20zaposlenih/admin/adminpanel.php");
            }else {
                echo "<div class='alert alert-danger'><strong>Data is not valid</strong></div>";
            }
        }
    }

    public function session(){
        session_start();
        $_SESSION['name']="ADMIN";
    } 
}
?>