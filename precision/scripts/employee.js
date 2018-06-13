/**
 * Created by licin on 09/05/2018.
 */
var tabla;

//Funcion que se ejecuta al inicio
function init(){
    // mostrarform(false);
    tolistposition();

    $("#formcompetence").on("submit",function(e)
    {
        savedit(e);
    })
    $.post("../../ajax/competence.php?op=insertpadre",function(r){
        $("#rolsfather").html(r);
        //$("#rolsfather").selectpicker('refresh');
    });
}

//Funcion clean
function limpiar()
{
    $("#title").val("");
    $("#typee").val("");
    $("#code").val("");
    $("#description").val("");
    $("#idcategorie").val("");
}

//Function mostrar formulario
function mostrarform(flag)
{
    limpiar();
    if (flag)
    {
        $("#listcompetence").hide();
        $("#formcompetence").show();
        $("#btnSave").prop("disabled",false);
        // $("#btnagregar").hide();
    }
    else
    {
        $("#listcompetence").show();
        $("#formcompetence").hide();
        $("#btnSave").show();
    }
}


function tolistposition()
{
    tabla=$('#tableposition').dataTable(
        {
            "scrollY": "400px",
            "scrollX": true,
            "scrollCollapse": true,
            "paging": false,
            "aProcessing": true,//Activamos el procesamiento del datatables
            "aServerSide": true,//PaginaciÃ³n y filtrado realizados por el servidor
            dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'
            ],
            "ajax":
            {
                url: '../../ajax/employee.php?op=tolistposition',
                type : "get",
                dataType : "json",
                error: function(e){
                    console.log(e.responseText);
                }
            },
            "bDestroy": true,
            "iDisplayLength": 10,//PaginaciÃ³ninaciÃ³n
            "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
        }).DataTable();
}


function savedit(e)
{
    e.preventDefault(); //No se activarÃ¡ la acciÃ³n predeterminada del evento
    $("#btnSave").prop("disabled",true);
    var formData = new FormData($("#formcompetence")[0]);

    $.ajax({
        url: "../../ajax/competence.php?op=savedit",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos)
        {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }

    });
    limpiar();
}


$(document).ready(function(){
    //fill data to tree  with AJAX call
    $('#tree-container').jstree({
        'plugins': ["wholerow", "checkbox"],
        'core' : {
            'data' : {
                "url" : "../../ajax/competence.php?op=treeview",
                "plugins" : [ "wholerow", "checkbox" ],
                "dataType" : "json" // needed only if you do not supply JSON headers
            }
        }
    })
});


function DeleteCompetence(){

    $('#modalDeleteCompetence').modal();

}
init();




