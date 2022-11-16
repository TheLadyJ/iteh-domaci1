<?php

require_once "../baza/kurs_jezika.php";
require_once "../baza/nivo.php";
require_once "../baza/predavac.php";


$action = $_POST["action"];

if($action=="vratiSveKurseve"){
    $result = Kurs_jezika::getAll();
    echo json_encode($result); //sa echo se vraca rezultat
    exit();
}

if($action=="ucitajCbNivoa"){
    $result = Nivo::getAll();
    echo json_encode($result);
    exit();
}

if($action=="ucitajCbPredavaca"){
    $result = Predavac::getAll();
    echo json_encode($result);
    exit();
}


if($action=="sacuvajKurs"){
    $jezik = $_POST['jezik'];
    $trajanje = $_POST['trajanje'];
    $nivo = $_POST['nivo'];
    $predavac = $_POST['predavac'];
    $flag = $_POST['flag'];
    $kursId = $_POST['kursId'];

    $kurs = new Kurs_jezika($jezik, $trajanje, $nivo, $predavac, $kursId);
    if ($flag=="izmeni"){    
        $result = $kurs->update();
    }
    else{
        $result = $kurs->insert();
    }
    echo json_encode($result);
    exit();
}

if($action=="izbrisiKurs"){
    $kursId=$_POST['kursId'];
    $result = Kurs_jezika::delete($kursId);
    echo json_encode($result);
    exit();
}

?>