<?php

class WorkPlaces{

    public $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    //metoda koja vraca sva radna mesta
    public function allWorkPlaces(){
        $sql = "SELECT*FROM radno_mesto";
        $query = $this->conn->prepare($sql);
        $json_output = [];
            if($query->execute()){
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $json = array(
                        "id" => $row['idradno_mesto'],
                        "name" => $row['naziv_radnog_mesta'],
                        "price" => $row['cena_radnog_sata']
                    );
                    array_push($json_output,$json);
                }
            }
            echo json_encode($json_output);
    }

    //metoda koja vraca informacije o ranim mestima
    public function infoWorkPlaces(){
        $sql = "SELECT COUNT(users.idusers) as broj,radno_mesto.naziv_radnog_mesta
                FROM users
                JOIN radno_mesto ON radno_mesto.idradno_mesto=users.radno_mesto_idradno_mesto
                GROUP BY radno_mesto.naziv_radnog_mesta";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $json_output = [];
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $json = array(
                "workPlace"=>$row['naziv_radnog_mesta'],
                "number"=>$row['broj']
            );
            array_push($json_output,$json);
        }
        return print_r(json_encode($json_output));
    }
}

?>