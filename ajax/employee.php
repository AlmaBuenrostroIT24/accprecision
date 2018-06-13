<?php
session_start();
require_once "../models/Employee.php";

$employee=new Employee();

$idposition=isset($_POST["idposition"])? limpiarCadena($_POST["idposition"]):"";
$positiontitle=isset($_POST["positiontitle"])? limpiarCadena($_POST["positiontitle"]):"";
$positioncode=isset($_POST["positioncode"])? limpiarCadena($_POST["positioncode"]):"";
$positiongroup=isset($_POST["positiongroup"])? limpiarCadena($_POST["positiongroup"]):"";


switch ($_GET["op"]){
    case 'savedit':

        if (empty($idcategorie)){
            $rspta=$competence->insert($title,$code, $typee,$description,$parent_id);
            echo $rspta ? "Registered Area or Detail" : "Could not register all user data, enter an image";
        }
        else {
            $rspta=$competence->edit($idcategorie,$title,$code,$typee, $description);
            echo $rspta ? "Composer Update" : "User could not Update";
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
        $rspta=$employee->showposition($idposition);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);
        break;

    case 'tolistposition':
        $rspta=$employee->tolistposition();
        //Vamos a declarar un array
        $data= Array();

        while ($reg=$rspta->fetch_object()){
            $data[]=array(

                "0"=>$reg->positiontitle,
                "1"=>$reg->positioncode,
                "2"=>$reg->positiongroup,
                "3"=>'<button class="btn btn-primary" data-toggle="tooltip" title="Edit" onclick="mostrar('.$reg->idposition.')"><i class="fa fa-edit pull-right"></i></button>'.
                    ' <button class="btn btn-danger" data-toggle="tooltip" title="Delete" onclick="activar('.$reg->idposition.')"><i class="fa fa-trash pull-right"></i></button>',

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

    case 'treeviewposition':
        $rspta=$employee->treeviewposition();




        while( $row = mysqli_fetch_assoc($rspta) ) {//$row=$rspta->fetch_object()
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
// Encode:
        echo json_encode($data);

        break;






}
?>