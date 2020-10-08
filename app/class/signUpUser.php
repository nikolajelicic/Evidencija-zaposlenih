<?php

include 'database/db.php';

class SignUpUser extends Database{

    public $db;
    public $conn;
    public $email;
    public $password;
    public $error;
    public function authUser($email,$password){
        $this->email = $email;
        $this->password = base64_encode($password);
        $sql = "SELECT * FROM users WHERE email=:email AND sifra=:password";
        $query = parent::connect()->prepare($sql);
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $query->bindParam(":email",$this->email);
        $query->bindParam(":password",$this->password);
            $query->execute();
            if(empty($this->email)||empty($this->password)){
                echo "<div class='alert alert-danger'><strong>Sva polja moraju biti popunjena</strong></div>";
            }else if($query->rowCount()==0){
                echo "<div class='alert alert-danger'><strong>Podaci nisu validni</strong></div>";
            }else {
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    session_start();
                    $_SESSION['user']=$row['ime']." ".$row['prezime'];
                    $_SESSION['id']=$row['idusers'];
                    header("Location: http://localhost/evidencija%20zaposlenih/profile.php");
                }
            }
    }
}
?>