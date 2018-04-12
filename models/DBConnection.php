<?php

class DBConnection {
    
    public function connect() {
        $link = new PDO("mysql:host=localhost;dbname=proyectoprogra4", "root", "");
        return $link;
    }

}

?>