<?php

require_once "dbBroker.php";

class Nivo
{
    public $id;
    public $pun_naziv;
    public $skraceni_naziv;

    public function __construct($pun_naziv = null, $skraceni_naziv = null)
    {
        $this->ipun_nazivd = $pun_naziv;
        $this->skraceni_naziv = $skraceni_naziv;
    }

    
    public static function getAll()
    {
        $br = Broker::getBroker();
        $query = 
        "   SELECT id, CONCAT(skraceni_naziv, ' (', pun_naziv,')') as Nivo
            FROM Nivo;";
        return $br->sql_query($query);

    }

}
