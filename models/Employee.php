<?php
/**
 * Created by PhpStorm.
 * User: licin
 * Date: 11/05/2018
 * Time: 05:05 PM
 */
//Incluímos inicialmente la conexión a la base de datos
require "../config/Connect.php";

Class Employee
{
    //Implementamos nuestro constructor
    public function __construct()
    {

    }

    //Implementamos un método para insertar registros
    public function insert($postiontitle,$positioncode,$positiongroup)
    {
        $sql="INSERT INTO positions (positiontitle,positioncode,positiongroup)
        VALUES ('$postiontitle','$positioncode','$positiongroup')";
        return ejecutarConsulta($sql);
    }


    //Implementamos un método para editar registros
    public function edit($idposition,$positiontitle,$positioncode,$positiongroup)
    {
        $sql="UPDATE positions SET positiontitle='$positiontitle',positioncode='$positioncode',positiongroup='$positiongroup' WHERE idposition='$idposition'";
        return ejecutarConsulta($sql);
    }

    //Implementamos un método para desactivar categorías
    public function deactivate($idcategorie)
    {
        $sql="UPDATE categories SET condicion='0' WHERE idcategorie='$idcategorie'";
        return ejecutarConsulta($sql);
    }

    //Implementamos un método para activar categorías
    public function activate($idcategorie)
    {
        $sql="UPDATE categories SET condicion='1' WHERE idcategorie='$idcategorie'";
        return ejecutarConsulta($sql);
    }

    //Implementar un método para mostrar los datos de un registro a modificar
    public function showposition($idposition)
    {
        $sql="SELECT * FROM positions WHERE idcategorie='$idposition'";
        return ejecutarConsultaSimpleFila($sql);
    }

    //Implementar un método para listar los registros
    public function tolistposition()
    {

        $sql="SELECT * FROM positions";
        return ejecutarConsulta($sql);
    }

    public function treeviewposition(){
        $sql="SELECT * FROM categories";
        return ejecutarConsulta($sql);

    }


}

?>