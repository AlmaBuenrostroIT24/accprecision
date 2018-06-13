<?php
session_start();
require_once "../models/User.php";

$user=new User();

$iduser=isset($_POST["iduser"])? limpiarCadena($_POST["iduser"]):"";
$name_user=isset($_POST["name_user"])? limpiarCadena($_POST["name_user"]):"";
$type_user=isset($_POST["type_user"])? limpiarCadena($_POST["type_user"]):"";
$address=isset($_POST["address"])? limpiarCadena($_POST["address"]):"";
$phone=isset($_POST["phone"])? limpiarCadena($_POST["phone"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$password=isset($_POST["password"])? limpiarCadena($_POST["password"]):"";
$photo=isset($_POST["photo"])? limpiarCadena($_POST["photo"]):"";

switch ($_GET["op"]){
    case 'saveEditUser':

        if (!file_exists($_FILES['photo']['tmp_name']) || !is_uploaded_file($_FILES['photo']['tmp_name']))
        {
            $photo=$_POST["currentphoto"];
        }
        else
        {
            $ext = explode(".", $_FILES["photo"]["name"]);
            if ($_FILES['photo']['type'] == "image/jpg" || $_FILES['photo']['type'] == "image/jpeg" || $_FILES['photo']['type'] == "image/png")
            {
                $photo = round(microtime(true)) . '.' . end($ext);
                move_uploaded_file($_FILES["photo"]["tmp_name"], "../files/user/" . $photo);
            }
        }
        //Hash SHA256 en la contraseÃ±a
        $passwordhash=hash("SHA256",$password);

        if (empty($iduser)){
            $rspta=$user->insertUser($name_user,$type_user,$address,$phone,$email,$login,$passwordhash,$photo,$_POST['rols']);
            echo $rspta ? "Registered user" : "Could not register all user data, enter an image";
        }
        else {
            $rspta=$user->editUser($iduser,$name_user,$type_user,$address,$phone,$email,$login,$passwordhash,$photo,$_POST['rols']);
            echo $rspta ? "User Update" : "User could not Update";
        }
        break;

    case 'deactivateuser':
        $rspta=$user->deactivateUser($iduser);
        echo $rspta ? "User Disabled" : "User can not be deactivated";
        break;

    case 'activateuser':
        $rspta=$user->activateUser($iduser);
        echo $rspta ? "User activated" : "User can not activate";
        break;

    case 'showuser':
        $rspta=$user->showUser($iduser);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);
        break;

    case 'listuser':
        $rspta=$user->listUser();
        //Vamos a declarar un array
        $data= Array();

        while ($reg=$rspta->fetch_object()){
            $data[]=array(

                "0"=>$reg->name_user,
                "1"=>$reg->type_user,
                "2"=>$reg->phone,
                "3"=>$reg->email,
                "4"=>$reg->login,
                "5"=>"<img src='../../files/user/".$reg->photo."' height='50px' width='50px' >",
                "6"=>($reg->status)?'<span class="label bg-green">Activate</span>':
                    '<span class="label bg-red">Deactivated</span>',
                "7"=>($reg->status)?'<button class="btn btn-warning" onclick="showuser('.$reg->iduser.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btn btn-danger" onclick="deactivateuser('.$reg->iduser.')"><i class="fa fa-close"></i></button>':
                    '<button class="btn btn-warning" onclick="showuser('.$reg->iduser.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btn btn-primary" onclick="activateuser('.$reg->iduser.')"><i class="fa fa-check"></i></button>',
            );
        }
        $results = array(
            "sEcho"=>1, //InformaciÃ³n para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
        echo json_encode($results);

        break;

    case 'rols':
        //Obtenemos todos los permisos de la tabla permisos
        require_once "../models/Rols.php";
        $rols = new Rols();
        $rspta = $rols->listRols();

        //Obtener los permisos asignados al usuario
        $id=$_GET['id'];
        $checked = $user->listMarkeduser($id);
        //Declaramos el array para almacenar todos los permisos marcados
        $valueuser=array();

        //Almacenar los permisos asignados al usuario en el array
        while ($per = $checked->fetch_object())
        {
            array_push($valueuser, $per->idrols);
        }



        //Mostramos la lista de permisos en la vista y si estÃ¡n o no marcados
        while ($reg = $rspta->fetch_object())
        {
            $sw=in_array($reg->idrols,$valueuser)?'checked':'';
            echo '<li> <input type="checkbox" class="icheckbox_flat-blue" '.$sw.'  name="rols[]" value="'.$reg->idrols.'">'.$reg->name_rols.'</li>';

        }
        break;

    case 'check':
        $logina=$_POST['logina'];
        $clavea=$_POST['clavea'];



        //Hash SHA256 en la contraseÃ±a
        $clavehash=hash("SHA256",$clavea);

        $rspta=$user->checkUser($logina, $clavehash);

        $fetch=$rspta->fetch_object();

        if (isset($fetch))
        {
            //Declaramos las variables de sesiÃ³n
            $_SESSION['iduser']=$fetch->iduser;
            $_SESSION['name_user']=$fetch->name_user;
            $_SESSION['photo']=$fetch->photo;
            $_SESSION['login']=$fetch->login;

            //Obtenemos los permisos del usuario
            $checked = $user->listMarkeduser($fetch->iduser);

            //Declaramos el array para almacenar todos los permisos marcados
            $valueuser=array();

            //Almacenamos los permisos marcados en el array
            while ($per = $checked->fetch_object())
            {
                array_push($valueuser, $per->idrols);
            }

            //Determinamos los accesos del usuario
            in_array(1,$valueuser)?$_SESSION['desktop']=1:$_SESSION['desktop']=0;
            in_array(2,$valueuser)?$_SESSION['purchases']=1:$_SESSION['purchases']=0;
            in_array(3,$valueuser)?$_SESSION['sales']=1:$_SESSION['sales']=0;
            in_array(4,$valueuser)?$_SESSION['employees']=1:$_SESSION['employees']=0;
            in_array(5,$valueuser)?$_SESSION['access']=1:$_SESSION['access']=0;

        }
        echo json_encode($fetch);
        break;

    case 'exit':
        //Limpiamos las variables de sesiÃ³n   
        session_unset();
        //DestruÃ¬mos la sesiÃ³n
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");

        break;
}
?>