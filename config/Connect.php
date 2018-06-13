<?php

require_once "global.php";

$connect=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

mysqli_query($connect,'SET NAMES " '.DB_ENCODE.'"');

//Si tenemos un posible error en la conexicon lo mostramos
if(mysqli_connect_errno()){

    printf("Failure to connect to the database: %s\n",mysqli_connect_error());
    exit();
}

if(!function_exists('ejecutarConsulta'))
{
    function ejecutarConsulta($sql)
    {
        global $connect;
        $query= $connect->query($sql);
        return $query;
    }
    function ejecutarConsultaSimpleFila($sql)
    {
        global $connect;
        $query= $connect->query($sql);
        $row= $query->fetch_assoc();
        return $row;
    }
    function ejecutarConsulta_retornarID($sql)
    {
        global $connect;
        $query= $connect->query($sql);
        return $connect->insert_id;
    }
    function limpiarCadena($str)
    {
        global $connect;
        $str= mysqli_real_escape_string($connect,trim($str));
        return htmlspecialchars($str);
    }
}

?>