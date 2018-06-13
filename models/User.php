<?php
//IncluÃ­mos inicialmente la conexiÃ³n a la base de datos
require "../config/Connect.php";

Class User
{
    //Implementamos nuestro constructor
    public function __construct()
    {

    }

    //Implementamos un mÃ
    public function insertUser($name_user,$type_user,$address,$phone,$email,$login,$password,$photo, $rols)
    {
        $sql="INSERT INTO user (name_user,type_user,address,phone,email,login,password,photo,status)
        VALUES ('$name_user','$type_user','$address','$phone','$email','$login','$password','$photo','1')";
       // return ejecutarConsulta($sql);

        $idusernew=ejecutarConsulta_retornarID($sql);

        $num_elements=0;
        $sw=true;

        while ($num_elements < count($rols))
        {
            $sql_detalle = "INSERT INTO user_rols(iduser, idrols) VALUES('$idusernew', '$rols[$num_elements]')";
            ejecutarConsulta($sql_detalle) or $sw = false;
            $num_elements=$num_elements + 1;
        }

        return $sw;

    }

    //Implementamos un m
    public function editUser($iduser,$name_user,$type_user,$address,$phone,$email,$login,$password,$photo,$rols)
    {
        $sql="UPDATE user SET name_user='$name_user',type_user='$type_user',address='$address',phone='$phone',email='$email',login='$login',password='$password',photo='$photo' WHERE iduser='$iduser'";
        ejecutarConsulta($sql);

        //Eliminamos todos los permisos asignados para volverlos a registrar
        $sqldel="DELETE FROM user_rols WHERE iduser='$iduser'";
        ejecutarConsulta($sqldel);

        $num_elements=0;
        $sw=true;

        while ($num_elements < count($rols))
        {
            $sql_detalle = "INSERT INTO user_rols(iduser, idrols) VALUES('$iduser', '$rols[$num_elements]')";
            ejecutarConsulta($sql_detalle) or $sw = false;
            $num_elements=$num_elements + 1;
        }

        return $sw;

    }


    //Implementamos un mÃ
    public function deactivateUser($iduser)
    {
        $sql="UPDATE user SET status='0' WHERE iduser='$iduser'";
        return ejecutarConsulta($sql);
    }

    //Implementamos un mÃ
    public function activateUser($iduser)
    {
        $sql="UPDATE user SET status='1' WHERE iduser='$iduser'";
        return ejecutarConsulta($sql);
    }

    //Implementar un mÃ©
    public function showUser($iduser)
    {
        $sql="SELECT * FROM user WHERE iduser='$iduser'";
        return ejecutarConsultaSimpleFila($sql);
    }

    //Implementar un mÃ
    public function listUser()
    {
        $sql="SELECT * FROM user";
        return ejecutarConsulta($sql);
    }


    //Implementar un mÃ©
    public function listMarkeduser($iduser)
    {
        $sql="SELECT * FROM user_rols WHERE iduser='$iduser'";
        return ejecutarConsulta($sql);
    }

    //FunciÃ³n para verificar el acceso al sistema
    public function checkUser($login,$password)
    {
        $sql="SELECT iduser,name_user,type_user,phone,email,photo,login FROM user WHERE login='$login' AND password='$password' AND status='1'";
        return ejecutarConsulta($sql);
    }
}

?>