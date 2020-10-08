<?php

class Logout{

    public function logoutAdmin(){
        if(isset($_POST['logout'])){
            session_start();
            session_destroy();
            header("Location: http://localhost/evidencija%20zaposlenih/admin/index.php");
        }
    }
}

?>