<?php

class Salary{

    public $conn;

    public function __construct($db){
        $this->conn = $db;
    
    }

    //metoda vraca najvecu isplacenu platu
    public function getMaxSalary(){
        $sql = "SELECT max(visina_plate)as plata,mesec,godina FROM plata"; 
        $query = $this->conn->prepare($sql);
        $query->execute();
        $json_output = [];
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $json = array(
                "salary"=>$row['plata'],
                "month"=>$row['mesec'],
                "year"=>$row['godina']
            );
            array_push($json_output,$json);
        }
        return print_r(json_encode($json_output));
    }
    
    //metoda vraca najmanju isplacenu platu
    public function getMinSalary(){
        $sql = "SELECT min(visina_plate)as plata, mesec, godina FROM plata";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $json_output = [];
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $json = array(
                "salary"=>$row['plata'],
                "month"=>$row['mesec'],
                "year"=>$row['godina']
            );
            array_push($json_output,$json);
        }
        return print_r(json_encode($json_output));
    }
}

?>