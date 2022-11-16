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

}
