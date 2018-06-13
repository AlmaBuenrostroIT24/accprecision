<?php
session_start();
require_once "../models/Competence.php";


$competence=new Competence();

$idcategorie=isset($_POST["permisos"])? limpiarCadena($_POST["permisos"]):"";
$title=isset($_POST["title"])? limpiarCadena($_POST["title"]):"";
$code=isset($_POST["code"])? limpiarCadena($_POST["code"]):"";
$typee=isset($_POST["typee"])? limpiarCadena($_POST["typee"]):"";
$description=isset($_POST["description"])? limpiarCadena($_POST["description"]):"";
$parent_id=isset($_POST["permisos"])? limpiarCadena($_POST["permisos"]):"";
$GuardarEdit=isset($_POST["GuardarEditar"])? limpiarCadena($_POST["GuardarEditar"]):"";


switch ($_GET["op"]){
    case 'savedit':

        if (empty($idcategorie)){
            $rspta=$competence->insertPadre($title,$code, $typee,$parent_id);
            echo $rspta ? "Registered Area or Detail" : "Could not register all user data, enter an image";
        }
        else {
            if($GuardarEdit=="NEW"){
                $removeCodSaved=$competence->DeleteCodSaved($code);
                $rspta=$competence->insert($title,$code, $typee,$description,$parent_id);
                //echo $rspta;
                echo $rspta ? "Registered Area or Detail" : "Could not register all user data, enter an image";
            }else{
                $rspta=$competence->edit($GuardarEdit,$title,$code,$typee, $description,$parent_id);
                echo $rspta ? "Composer Update" : "User could not Update";
            }

        }
        //echo $rspta ? "Composer Update" : "User could not Update";
        break;

    case 'catdelete':

        //echo json_encode($_POST['co']);
        if($_POST['parentId']==0){
            $DeleteCodigo=$competence->DeleteCodSavedbyFther($_POST['idcategorie']);
            $DeleteCodigo=$competence->DeleteHijosofFther($_POST['idcategorie']);
            $rspta=$competence->DeleteCat($_POST['idcategorie']);
            echo $rspta ? "Deleted Area or Detail" : "Could not delete all user data, enter an image";
        }else{
            $salvarCodigo=$competence->salveCodigoDeleted($_POST['parentId'],$_POST['codetosave']);
            $rspta=$competence->DeleteCat($_POST['idcategorie']);
            echo $rspta ? "Deleted Area or Detail" : "Could not delete all user data, enter an image";
        }

        break;


    case 'desactivar':
        $rspta=$usuario->desactivar($idusuario);
        echo $rspta ? "User Disabled" : "User can not be deactivated";
        break;

    case 'activar':
        $rspta=$usuario->activar($idusuario);
        echo $rspta ? "User activated" : "User can not activate";
        break;

    case 'mostrar':
        $rspta=$usuario->mostrar($idusuario);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);
        break;

    case 'tolist':
        $rspta=$competence->tolist();
        //Vamos a declarar un array
        $data= Array();

        while ($reg=$rspta->fetch_object()){
            $data[]=array(

                "0"=>$reg->title,
                "1"=>$reg->typee,
                "2"=>$reg->code,
                "3"=>$reg->description,
                "4"=>'<button class="btn btn-primary" data-toggle="tooltip" title="Edit" onclick="mostrar('.$reg->idcategorie.')"><i class="fa fa-edit pull-right"></i></button>'.
                    ' <button class="btn btn-danger" data-toggle="tooltip" title="Delete" onclick="activar('.$reg->idcategorie.')"><i class="fa fa-trash pull-right"></i></button>',

                //<a href=""><button class="btn btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-edit pull-right"></i></button></a>
                // <a href="" data-target=""  data-toggle="modal"><button class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash pull-right"></i></button></a>
            );
        }
        $results = array(
            "sEcho"=>1, //InformaciÃ³n para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
        echo json_encode($results);

        break;

    case 'insertpadre':

        $rspta=$competence->insertfather();

        echo '<option value="0">New Category</option>';
        while ($reg = $rspta->fetch_object())
        {
            echo  '<option value="'.$reg->idcategorie.'">'.$reg->title.'</option>';
        }

        break;

    case 'combotype':

        $rspta=$competence->combotype();

        // echo '<option value="0">New Category</option>';
        while ($reg = $rspta->fetch_object())
        {
            echo  '<option value="'.$reg->IdTypeCategories.'">'.$reg->type_valor.'</option>';
        }

        break;

    case 'getCodeChildren':

        $CodePadre=$competence->getcodeFather($_POST['idPadreCategorie']);
        $codPa=array();
        while( $row=$CodePadre->fetch_object())
        {
            $codPa[]=$row->code;
        }

        $CodeHijos=$competence->getcodeChildren($_POST['idPadreCategorie']);
        $codHijos=array();
        while( $row=$CodeHijos->fetch_object())
        {
            $codHijos[]=$row->numerohijos;
        }
        //  echo json_encode($codHijos);

        $CodigosEliminados=$competence->getCodesDeletedCategories($_POST['idPadreCategorie']);
        $codEliminados=array();
        while( $row=$CodigosEliminados->fetch_object())
        {
            $codEliminados[]=$row->CodeDeleted;
        }

        $cantidadHijosMasEliminados=(int)$codHijos[0]+(int)count($codEliminados)+1;
        $codigoConsecutivo="";
        $codigoConsecutivo[0]=$codPa[0].(string)$cantidadHijosMasEliminados;


        echo json_encode(array_merge($codigoConsecutivo,$codEliminados));


        break;

    case 'treeview': // despues dependiendo el caso es donde llamas al js// los script que vamos utilizar estara adentos de las vistas que es ets
        // cuando dice caso es el nombre del caso
        $rspta=$competence->treeview();

        while( $row=$rspta->fetch_object())
        {
            // dd($row->id);
            $sub_data["idcategorie"] = $row->idcategorie;
            $sub_data["title"] = $row->title;
            $sub_data["text"] =  $row->title;
            $sub_data["code"] =  $row->code;
            $sub_data["typee"] =  $row->typee;
            $sub_data["description"] =  $row->description;
            $sub_data["parent_id"] =  $row->parent_id;
            $sub_data["type_valor"] =  $row->type_valor;
            $data[] = $sub_data;
        }

// Build array of item references:
        foreach($data as $key => &$item) {
            $itemsByReference[$item['idcategorie']] = &$item;

            // Children array:
            //$itemsByReference[$item['idcategorie']]['data'] =array();
            $itemsByReference[$item['idcategorie']]['data'] = new StdClass($item);
        }

// Set items as children of the relevant parent item.
        foreach($data as $key => &$item)  {
            //echo "<pre>";print_r($itemsByReference[$item['parent_id']]);die;
            if($item['parent_id'] && isset($itemsByReference[$item['parent_id']])) {
                $itemsByReference [$item['parent_id']]['children'][] =&$item; //despues de cada data le falta ]
                $itemsByReference[$item['idcategorie']]['data']  = (object)$item;//new StdClass($item);y
                // $itemsByReference[$item['idcategorie']]['data'] ="{$item["description"]}";// me esta tomando el ultimo valor
            }
        }

// Remove items that were added to parents elsewhere:
        foreach($data as $key => &$item) {
            if($item['parent_id'] && isset($itemsByReference[$item['parent_id']]))
                unset($data[$key]);
        }

        foreach ($data as $row) {
            $resha[] = $row;

        } // Encode:
        echo json_encode($resha);


        break;

    case 'get_node':

        $node = isset($_GET['idcategorie']) && $_GET['idcategorie'] !== '#' ? (int)$_GET['idcategorie'] : 0;
        //$sql = "SELECT * FROM `treeview_items` ";
        // $res = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
        //iterate on results row and create new index array of data
        while( $row=$rspta->fetch_object()) {
            $data[] = $row;
        }
        $itemsByReference = array();

        // Build array of item references:
        foreach($data as $key => &$item) {
            $itemsByReference[$item['idcategorie']] = &$item;
            // Children array:
            $itemsByReference[$item['idcategorie']]['children'] = array();
            // Empty data class (so that json_encode adds "data: {}" )
            $itemsByReference[$item['idcategorie']]['data'] = new StdClass();
        }

        // Set items as children of the relevant parent item.
        foreach($data as $key => &$item)
            if($item['parent_id'] && isset($itemsByReference[$item['parent_id']]))
                $itemsByReference [$item['parent_id']]['children'][] = &$item;

        // Remove items that were added to parents elsewhere:
        foreach($data as $key => &$item) {
            if($item['parent_id'] && isset($itemsByReference[$item['parent_id']]))
                unset($data[$key]);
        }
        $result = $data;///
        break;


    case 'create_node':
        $node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;

        $nodeText = isset($_GET['text']) && $_GET['text'] !== '' ? $_GET['text'] : '';
        $sql ="INSERT INTO `treeview_items` (`name`, `text`, `parent_id`) VALUES('".$nodeText."', '".$nodeText."', '".$node."')";
        mysqli_query($conn, $sql);

        $result = array('id' => mysqli_insert_id($conn));
        break;




}
?>