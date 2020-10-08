<?php

class Worker{

    public $conn;
    public $hashPass;
    public $name;
    public $sudname;
    public $email;
    public $pass;
    public $workplace;
    public $id;
    public $month;
    public $year;

    public function __construct($db){
        $this->conn = $db;
    }

    //dodavanje radnika
    public function addWorker($name,$surname,$email,$pass,$workplace){
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->pass = base64_encode($pass);
        $this->workplace = $workplace;
        $sql = "INSERT INTO users SET ime=:name, prezime=:surname, email=:email, sifra=:pass, radno_mesto_idradno_mesto=:workplace";
        $query = $this->conn->prepare($sql);
        
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->surname=htmlspecialchars(strip_tags($this->surname));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->pass=htmlspecialchars(strip_tags($this->pass));
        $this->workplace=htmlspecialchars(strip_tags($this->workplace));
    
        $query->bindParam(":name",$this->name);
        $query->bindParam(":surname",$this->surname);
        $query->bindParam(":email",$this->email);
        $query->bindParam(":pass",$this->pass);
        $query->bindParam(":workplace",$this->workplace);

        $json_output = [];
        if(empty($this->name)||empty($this->surname)||empty($this->email)||empty($this->pass)||empty($this->workplace)){
            $json = array(
                "status"=>false,
                "message"=>"Sva polja moraju biti popunjena"
            ); 
        }else if(strlen($this->name)<2){
            $json = array(
                "status"=>false,
                "message"=>"Ime nije validno"
            );
        }else if(strlen($this->surname)<2){
            $json = array(
                "status"=>false,
                "message"=>"Prezime nije validno"
            );
        }else if(strlen($this->pass)<5){
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
               "message"=>"Radnik ".$this->name." ".$this->surname." je uspesno dodat"
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

    /*provera da li radnik sa odredjenim mejlom vec postoji, ako postoji izbacuje poruku o gresci,
    inace dopusta da se doda radnik u bazu ako je prosao sve ostale korake za validnost*/
    public function ifIssetEmail($name,$surname,$email,$pass,$workplace){
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->pass = base64_encode($pass);
        $this->workplace = $workplace;

        $sql = "SELECT*FROM users WHERE email=:email";
        $query = $this->conn->prepare($sql);
        $this->email=htmlspecialchars(strip_tags($this->email));
        $query->bindParam(":email",$this->email);
        $json_output = [];
            $query->execute();
            if($query->rowCount()==0){
                $this->addWorker($name,$surname,$email,$pass,$workplace);
            }else{
                $json = array(
                    "status"=>false,
                    "message"=>"Radnik sa mejlom ".$this->email. " vec postoji"
                );
                array_push($json_output,$json);
                return print_r(json_encode($json_output));
            }

    }

    //metoda vraca sve radnike
    public function getAllWorker(){
        $sql = "SELECT idusers,ime,prezime FROM users";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $json_output = [];
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $json = array(
                    "id"=>$row['idusers'],
                    "name"=>$row['ime'],
                    "surname"=>$row['prezime']
                );
                array_push($json_output, $json);
            }
            return print_r(json_encode($json_output));
    }

    //metoda za brisanje radnika na osnovu id-ja
    public function deleteWorker($id){
        $this->id = $id;
        $sql = "DELETE FROM users WHERE idusers=:id";
        $query = $this->conn->prepare($sql);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $query->bindParam(":id",$this->id);
        $json_output = [];
            if($query->execute()){
                $json = array(
                    "status"=>true,
                    "message"=>"Uspesno obrisan radnik"
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

    //metoda vraca ukupan broj radnika
    public function numberOfWorker(){
        $sql = "SELECT idusers FROM users";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $json_output = [];
            $json = array(
                "numberOfWorker" => $query->rowCount()
            );
            array_push($json_output,$json);
            return print_r(json_encode($json_output));
    }

    //metoda vraca informacije o radniku
    public function infoWorker($id){
        $this->id = $id;
        $sql = "SELECT radni_sati.mesec,radni_sati.godina,radni_sati.broj_sati,radno_mesto.cena_radnog_sata
                FROM users
                JOIN radno_mesto ON users.radno_mesto_idradno_mesto=radno_mesto.idradno_mesto
                JOIN radni_sati ON users.idusers=radni_sati.users_idusers
                WHERE users.idusers=:id";
        $query = $this->conn->prepare($sql);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $query->bindParam(":id",$this->id);
        $query->execute();
        $json_output = [];
            if($query->rowCount()>0){
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $json = array(
                        "status"=>true,
                        "month"=>$row['mesec'],
                        "year"=>$row['godina'],
                        "number_workingHours"=>$row['broj_sati'],
                        "salary"=>$row['broj_sati']*$row['cena_radnog_sata']." "."dinara"
                    );
                    array_push($json_output,$json);
                }
            }else{
                $json = array(
                    "status"=>false,
                    "message"=>"Jos uvek nema podataka za naznacenog radnika"
                );
                array_push($json_output,$json);
            }
            return print_r(json_encode($json_output));
    }

    //metoda koja vraca mejl i sifru radnika
    public function getEmailPass($id){
        $this->id = $id;
        $sql = "SELECT email,sifra,idusers FROM users WHERE idusers=:id";
        $query = $this->conn->prepare($sql);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $query->bindParam(":id",$this->id);
            $query->execute();
            $json_output = [];
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $json = array(
                    "id"=>$row['idusers'],
                    "email"=>$row['email'],
                    "pass"=>base64_decode($row['sifra'])
                );
                array_push($json_output,$json);
            }
            return print_r(json_encode($json_output));
    }

    //metoda koja menja mejl i sifru radnika 
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

    //metoda koja vraca informacije o plati
    public function getSalaryInfo(){
        $sql="SELECT users.idusers,users.ime,users.prezime, radni_sati.mesec,radni_sati.godina,radni_sati.broj_sati,radno_mesto.cena_radnog_sata 
        FROM users 
        JOIN radno_mesto ON users.radno_mesto_idradno_mesto=radno_mesto.idradno_mesto 
        JOIN radni_sati ON users.idusers=radni_sati.users_idusers";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $json_output = [];
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $json = array(
                "id"=>$row['idusers'],
                "name"=>$row['ime'],
                "surname"=>$row['prezime'],
                "month"=>$row['mesec'],
                "year"=>$row['godina'],
                "salary"=>$row['cena_radnog_sata']*$row['broj_sati']
            );
            array_push($json_output,$json);
        }
        return print_r(json_encode($json_output));
    }

    //metoda za isplacivanje plate
    public function payTheSalary($id,$month,$year,$salary){
        $this->id = $id;
        $this->month = $month;
        $this->year = $year;
        $this->salary = $salary;

        $sql = "INSERT INTO plata SET visina_plate=:salary, mesec=:month, godina=:year, users_idusers=:id";
        $query = $this->conn->prepare($sql);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->month = htmlspecialchars(strip_tags($this->month));
        $this->year = htmlspecialchars(strip_tags($this->year));
        $this->salary = htmlspecialchars(strip_tags($this->salary));
        $query->bindParam(":month",$this->month);
        $query->bindParam(":year",$this->year);
        $query->bindParam(":id",$this->id);
        $query->bindParam(":salary",$this->salary);
        $json_output = [];
            if($query->execute()){
                $json = array(
                    "status"=>true,
                    "message"=>"Plata uspesno isplacena"
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

    //metoda koja proverava dal je plata vec isplacena
    public function ifIssetSalary($id,$month,$year,$salary){
        $this->id = $id;
        $this->month = $month;
        $this->year = $year;
        $this->salary = $salary;

        $sql = "SELECT * FROM `plata` WHERE mesec=:month AND godina=:year AND users_idusers=:id AND visina_plate=:salary";
        $query = $this->conn->prepare($sql);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->month = htmlspecialchars(strip_tags($this->month));
        $this->year = htmlspecialchars(strip_tags($this->year));
        $this->salary = htmlspecialchars(strip_tags($this->salary));

        $query->bindParam(":month",$this->month);
        $query->bindParam(":year",$this->year);
        $query->bindParam(":id",$this->id);
        $query->bindParam(":salary",$this->salary);
        $json_output = [];
        $query->execute();
        if($query->rowCount()==0){
            $this->payTheSalary($id,$month,$year,$salary);
        }else{
            $json = array(
                "status"=>false,
                "message"=>"Radniku je vec isplacena plata za naznaceni period"
            );
            array_push($json_output,$json);
            return print_r(json_encode($json_output));
        }

    }
}

?>