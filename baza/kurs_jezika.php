<?php

require_once "dbBroker.php";

class Kurs_jezika
{
    public $id;
    public $jezik;
    public $trajanje_meseci;
    public $nivo_id;
    public $predavac_id;

    public function __construct($jezik = null, $trajanje_meseci = null, $nivo_id = null, $predavac_id = null, $id=null)
    {
        $this->jezik = $jezik;
        $this->trajanje_meseci = $trajanje_meseci;
        $this->nivo_id = $nivo_id;
        $this->predavac_id = $predavac_id;
        $this->id = $id;

    }

    
    public static function getAll()
    {   
        $br= Broker::getBroker();
        $query = 
        "   SELECT jezik as `Jezik`, trajanje_meseci as `Trajanje kursa u mesecima`, Nivo.skraceni_naziv as `Nivo`, 
            CONCAT(Predavac.ime,' ',Predavac.prezime) as `Predavac`, Kurs_jezika.id as `id`, Nivo.id as `nivo_id`, Predavac.id as `predavac_id`
            FROM Kurs_jezika
	            JOIN Nivo ON Kurs_jezika.nivo_id=Nivo.id
                JOIN Predavac ON Kurs_jezika.predavac_id=Predavac.id;";
        return $br->sql_query($query);
    }

    public static function getById($id)
    {   
        $br= Broker::getBroker();
        $query = 
        "   SELECT jezik as `Jezik`, trajanje_meseci as `Trajanje kursa u mesecima`, Nivo.skraceni_naziv as `Nivo`, 
            CONCAT(Predavac.ime,' ',Predavac.prezime) as `Predavac`
            FROM Kurs_jezika
	            JOIN Nivo ON Kurs_jezika.nivo_id=Nivo.id
                JOIN Predavac ON Kurs_jezika.predavac_id=Predavac.id
            WHERE Kurs_jezika.id=$id;";
        return $br->sql_query($query);
    }

    public static function getByNivo($nivo)
    {   
        $br= Broker::getBroker();
        $query = 
        "   SELECT jezik as `Jezik`, trajanje_meseci as `Trajanje kursa u mesecima`, Nivo.skraceni_naziv as `Nivo`, 
            CONCAT(Predavac.ime,' ',Predavac.prezime) as `Predavac`
            FROM Kurs_jezika
	            JOIN Nivo ON Kurs_jezika.nivo_id=Nivo.id
                JOIN Predavac ON Kurs_jezika.predavac_id=Predavac.id
            WHERE Nivo.skraceni_naziv=$nivo;";
        return $br->sql_query($query);
    }

    public function insert()
    {   
        $br= Broker::getBroker();
        $query = 
        "   INSERT INTO Kurs_jezika 
                (jezik, trajanje_meseci, nivo_id, predavac_id)
            VALUES ('$this->jezik', '$this->trajanje_meseci',    
                '$this->nivo_id', '$this->predavac_id');";
        return $br->sql_ins_upd_del($query);
    }

    public function update()
    {   
        $br= Broker::getBroker();
        $query = 
        "   UPDATE Kurs_jezika 
            SET jezik='$this->jezik', trajanje_meseci='$this->trajanje_meseci',    
                nivo_id='$this->nivo_id', predavac_id='$this->predavac_id'
            WHERE id=$this->id;";
        return $br->sql_ins_upd_del($query);
    }

    public static function delete($id)
    {   
        $br= Broker::getBroker();
        $query = 
        "   DELETE FROM Kurs_jezika 
            WHERE id=$id;";
        return $br->sql_ins_upd_del($query);
    }


}
