<?php

class Broker{

    private $conn = "";
    private static $broker;
       
    private function __construct(){
        $this->conn = new mysqli("localhost", "root", "", "Kursevi_jezika");
        $this->conn->set_charset("utf8");
    }

    public static function getBroker(){
        if(!isset($broker)){
            $broker=new Broker();
        }
        return $broker;
    }

    public function sql_query($upit){
        $odgovor = $this->conn->query($upit);
        $rezultat = [];
        if($odgovor){
            while($red=$odgovor->fetch_assoc()){
                $rezultat[]=$red;
            }
        }
        else{
            $rezultat['error']=$this->conn->error;
        }

        return $rezultat;
    }

    public function sql_ins_upd_del($upit){
        return $this->conn->query($upit);
    }

}


?>