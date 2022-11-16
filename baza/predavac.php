<?php

require_once "dbBroker.php";

class Predavac
{
    public $id;
    public $ime;
    public $prezime;
    public $godine_iskustva;

    public function __construct($id = null, $ime = null, $prezime = null, $godine_iskustva = null)
    {
        $this->id = $id;
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->godine_iskustva = $godine_iskustva;
    }

    
    public static function getAll()
    {
        $br = Broker::getBroker();
        $query = 
        "   SELECT id, ime, prezime
            FROM Predavac;";
        return $br->sql_query($query);
    }

    /*
    public static function getById($id, mysqli $conn)
    {
        $query = "SELECT * FROM Predavac WHERE id=$id";
        $myObj = array();
        if ($msqlObj = $conn->query($query)) {
            while ($red = $msqlObj->fetch_array(1)) {
                $myObj[] = $red;
            }
        }
        return $myObj;
    }

    public function update(mysqli $conn)
    {
        $query = "UPDATE Predavac SET ime=$this->ime, prezime=$this->prezime, godine_iskustva=$this->godine_iskustva WHERE id=$this->id";
        return $conn->query($query);
    }
    */

}
