<?php

class User{

    public $id;
    public $month;
    public $year;
    public $hours;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getInfo($id){
        $this->id = $id;
        $sql = "SELECT email,sifra FROM users WHERE idusers=:id";
        $query = $this->conn->prepare($sql);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $query->bindParam(":id",$this->id);
        $query->execute();
        $json_output = [];
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $json = array(
                "email"=>$row['email'],
                "pass"=>base64_decode($row['sifra'])
            );
            array_push($json_output,$json);
        }
        return print_r(json_encode($json_output));
    }

    public function edit($id,$email,$pass){
        $this->id = $id;
        $this->email = $email;
        $this->pass = base64_encode($pass);
        $sql = "UPDATE users SET email=:email,sifra=:sifra WHERE idusers=:id";
        $query = $this->conn->prepare($sql);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->pass = htmlspecialchars(strip_tags($this->pass));

        $query->bindParam(":id",$this->id);
        $query->bindParam(":email",$this->email);
        $query->bindParam(":sifra",$this->pass);
        $json_output = [];
            if(strlen($this->pass)<5){
                $json = array(
                    "status"=>false,
                    "message"=>"Sifra nije validna"
                );
            }else if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)){
                $json = array(
                    "status"=>false,
                    "message"=>"Email adresa nije validna"
                );
            }else if($query->execute()){
                $json = array(
                    "status"=>true,
                    "message"=>"Uspesno promenjeni podaci"
                );
            }else{
                $json = array(
                    "status"=>false,
                    "message"=>"Doslo je do greske"
                );
            }
            array_push($json_output,$json);
            return print_r(json_encode($json_output));
    }

    public function writeHours($month,$year,$hours,$id){
        $this->month = $month;
        $this->year = $year;
        $this->hours = $hours;
        $this->id = $id;
        $sql = "INSERT INTO radni_sati SET mesec=:month,godina=:year,broj_sati=:hours,users_idusers=:id";
        $query = $this->conn->prepare($sql);
        $this->month = htmlspecialchars(strip_tags($this->month));
        $this->year = htmlspecialchars(strip_tags($this->year));
        $this->hours = htmlspecialchars(strip_tags($this->hours));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $query->bindParam(":month",$this->month);
        $query->bindParam(":year",$this->year);
        $query->bindParam(":hours",$this->hours);
        $query->bindParam(":id",$this->id);
        $json_output = [];
            if($query->execute()){
                $json = array(
                    "status"=>true,
                    "message"=>"Uspesno upisani sati"
                );
            }else{
                $json = array(
                    "status"=>false,
                    "message"=>"Doslo je do greske"
                );
            }
            array_push($json_output,$json); 
            return print_r(json_encode($json_output));
    }

    
    public function ifIsset($month,$year,$hours,$id){
        $this->month = $month;
        $this->id = $id;
        $this->year = $year;
        $this->hours = $hours;
        $sql = "SELECT*FROM radni_sati WHERE mesec=:month AND users_idusers=:id";
        $query = $this->conn->prepare($sql);
        $this->month = htmlspecialchars(strip_tags($this->month));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $query->bindParam(":month",$this->month);
        $query->bindParam(":id",$this->id);
        $json_output = [];
        $query->execute();
            if($query->rowCount()==0){
                $this->writeHours($month,$id,$hours,$id);
            }else{
                $json = array(
                    "status"=>false,
                    "message"=>"Upisani sati za mesec ".$this->month." vec postoje"
                );
                array_push($json_output,$json);
                return print_r(json_encode($json_output)); 
            }
    }

    public function getSalaryInfo($id){
        $this->id = $id;
        $sql = "SELECT users.ime,users.prezime,plata.visina_plate,plata.mesec,plata.godina
        FROM plata
        JOIN users ON users.idusers=plata.users_idusers
        WHERE users_idusers=:id";
        $query = $this->conn->prepare($sql);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $query->bindParam(":id",$this->id);
        $json_output = [];
        $query->execute();
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $json = array(
                "user"=>$row['ime']." ".$row['prezime'],
                "salary"=>$row['visina_plate'],
                "month"=>$row['mesec'],
                "year"=>$row['godina']
            );
            array_push($json_output,$json);
        }
        return print_r(json_encode($json_output)); 
    }

}

?>