<?php
//IncluÃ­mos inicialmente la conexiÃ³n a la base de datos
require "../config/Connect.php";

Class Rols
{
    //Implementamos nuestro constructor
    public function __construct()
    {

    }


    //Implementar un mÃ©todo para listar los registros
    public function listRols()
    {
        $sql="SELECT * FROM rols";
        return ejecutarConsulta($sql);
    }

}

?>