<?php

class Boxes{

    public $conn;
    public $month;
    public $year;
    public $number;
    public $price;
    public $id;
    public $dimensione;

    public function __construct($db){
        $this->conn = $db;
    }

    // metoda za dodavanje kutija u bazu
    public function addNewBoxes($dimensione,$price){
        $this->dimensione = $dimensione;
        $this->price = $price;
         
        $sql = "INSERT INTO kutije SET dimenzija_kutije=:dimensione,cena=:price";
        $query = $this->conn->prepare($sql);
        $this->dimensione = htmlspecialchars(strip_tags($this->dimensione));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $query->bindParam(":dimensione",$this->dimensione);
        $query->bindParam(":price",$this->price);  
        $json_output = [];
            if($query->execute()){
                $json = array(
                    "status"=>true,
                    "message"=>"Uspesno dodata nova vrsta kutije"
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

    // metoda koja proverava da li dodata kutija vec postiji u bazi
    public function ifIssetBoxes($dimensione,$price){
        $this->dimensione = $dimensione;
         
        $sql = "SELECT*FROM kutije WHERE dimenzija_kutije=:dimensione";
        $query = $this->conn->prepare($sql);
        $this->dimensione = htmlspecialchars(strip_tags($this->dimensione));
        $query->bindParam(":dimensione",$this->dimensione);
        $json_output = [];
            $query->execute();
            if($query->rowCount()==0&&preg_match_all('/^[0-9]{2,4}x[0-9]{2,4}x[0-9]{2,4}$/m', $this->dimensione, $matches, PREG_SET_ORDER, 0)){
                $this->addNewBoxes($dimensione,$price);
            }else{
                $json = array(
                    "status"=>false,
                    "message"=>"Pokusajte ponovo"
                );
                array_push($json_output,$json);
                return print_r(json_encode($json_output)); 
            }
    }

    //metoda za izlistavanje svih vrsta kutija
    public function typesOfBoxes(){
        $sql = "SELECT idkutije,dimenzija_kutije,cena FROM kutije";
        $query = $this->conn->prepare($sql);
        $json_output = [];
            $query->execute();
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $json = array(
                    "id"=>$row['idkutije'],
                    "dimension"=>$row['dimenzija_kutije'],
                    "price"=>$row['cena']
                );
                array_push($json_output,$json);
            }
            return print_r(json_encode($json_output));
    }

    //metoda za menjanje cene kutije
    public function editPrice($id,$price){
        $this->id = $id;
        $this->price = $price;
        $sql = "UPDATE kutije SET cena=:price WHERE kutije.idkutije=:id";
        $query = $this->conn->prepare($sql);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $query->bindParam(":id",$this->id);
        $query->bindParam(":price",$this->price);
        $json_output = [];
            if($query->execute()){
                $json = array(
                    "status"=>true,
                    "message"=>"Cena je uspesno promenjena"
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

    //metoda za brisanje kutija
    public function deleteBoxes($id){
        $this->id = $id;
        $sql = "DELETE FROM kutije WHERE idkutije=:id";
        $query = $this->conn->prepare($sql);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $query->bindParam(":id",$this->id);
        $json_output = [];
            if($query->execute()){
                $json = array(
                    "status"=>true
                );
            }else{
                $json = array(
                    "status"=>false
                );
            }
            array_push($json_output,$json);
            return print_r(json_encode($json_output));
    }

    //metoda koja vraca ukupan broj svih kutija 
    public function numberOfBoxes(){
        $sql = "SELECT idkutije FROM kutije";
        $query = $this->conn->prepare($sql);
        $json_output = [];
            $query->execute();
                $json = array(
                   "total"=>$query->rowCount()
                );
                array_push($json_output,$json);
            return print_r(json_encode($json_output));
    }

    //metoda koja vraca uradjenje kutije za odredjeni mesec i godinu
    public function done($month,$year){
        $this->month = $month;
        $this->year = $year;
        $sql="SELECT uradjeno.mesec,uradjeno.godina,kutije.dimenzija_kutije,kutije.cena,uradjeno.komada
        FROM kutije
        JOIN uradjeno ON kutije.idkutije=uradjeno.kutije_idkutije  
        WHERE mesec=:month AND godina=:year";
        $query = $this->conn->prepare($sql);
        $this->month = htmlspecialchars(strip_tags($this->month));
        $this->year = htmlspecialchars(strip_tags($this->year));
        $query->bindParam(":month",$this->month);
        $query->bindParam(":year",$this->year);
            $query->execute();
            $json_output = [];
            if($query->rowcount()==0){
                $json = array(
                    "status"=>false
                );
                array_push($json_output,$json);
            }else while($row = $query->fetch(PDO::FETCH_ASSOC)){
                            $json = array(
                                "status"=>true,
                                "month"=>$row['mesec'],
                                "year"=>$row['godina'],
                                "dimension"=>$row['dimenzija_kutije'],
                                "price"=>$row['cena'],
                                "pieces"=>$row['komada'],
                                 "income"=>$row['cena']*$row['komada']
                            );
                            array_push($json_output,$json);
                        }
            return print_r(json_encode($json_output));
    }

    //metoda koja upisuje uradjene kutije za odredjeni mesec i godinu
    public function insertDoneBoxes($month,$year,$number,$id){
        $this->month = $month;
        $this->year = $year;
        $this->number = $number;
        $this->id = $id;

        $sql = "INSERT INTO uradjeno SET mesec=:month,godina=:year,komada=:number,kutije_idkutije=:id";
        $query = $this->conn->prepare($sql);
        $this->month = htmlspecialchars(strip_tags($this->month));
        $this->year = htmlspecialchars(strip_tags($this->year));
        $this->number = htmlspecialchars(strip_tags($this->number));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $query->bindParam(":month",$this->month);
        $query->bindParam(":year",$this->year);
        $query->bindParam(":number",$this->number);
        $query->bindParam(":id",$this->id);
        $json_output = [];
            if($query->execute()){
                $json = array(
                    "status"=>true,
                    "message"=>"Uspesno"
                );
            }else{
                $json = array(
                    "status"=>false,
                    "message"=>"Doslo je do greske, pokusajte ponovo"
                );
            }
            array_push($json_output,$json);
            return print_r(json_encode($json_output));
    }

    /*metoda proverava da li upisana kutija da je uradjena za odredjeni mesec i godinu
    vec postoji u bazi ako postoji nece dozvoliti da se ponovi jos jednom*/
    public function check($month,$year,$number,$id){
        $this->month = $month;
        $this->year = $year;
        $this->number = $number;
        $this->id = $id;

        $sql = "SELECT*FROM uradjeno WHERE mesec=:month AND godina=:year AND kutije_idkutije=:id";
        $query = $this->conn->prepare($sql);
        $this->month = htmlspecialchars(strip_tags($this->month));
        $this->year = htmlspecialchars(strip_tags($this->year));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $query->bindParam(":month",$this->month);
        $query->bindParam(":year",$this->year);
        $query->bindParam(":id",$this->id);
        $json_output = [];
            $query->execute();
            if($query->rowCount()==0){
                    $this->insertDoneBoxes($month,$year,$number,$id);
            }else{
                $json = array(
                    "status"=>false,
                    "message"=>"Oznacene kutije su vec upisane za odredjeni period"
                );
                array_push($json_output,$json);
                return print_r(json_encode($json_output));
            }   
    }
}

?>