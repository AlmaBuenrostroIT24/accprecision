<?php


session_start();

require_once "../models/Rols.php";

$rol=new Rols();

switch ($_GET["op"]){

    case 'listrols':
        $rspta=$rol->listRols();
        //Vamos a declarar un array
        $data= Array();

        while ($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>$reg->name_rols
            );
        }
        $results = array(
            "sEcho"=>1, //InformaciÃ³n para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
        echo json_encode($results);

        break;
}
?>