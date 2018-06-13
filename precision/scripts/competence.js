/**
 * Created by licin on 09/05/2018.
 */
var tabla;

//Funcion que se ejecuta al inicio
function init(){
    $("#divDescription").hide();
    $("#CodigosDisponibles").hide();
    $("#GuardarEditar").hide();
    $("#GuardarEditar").val("NEW");

    // mostrarform(false);
    tolist();

    $("#formcompetence").on("submit",function(e)
    {


        $("#code").prop('disabled', false);
        //alert("saveddddd");
        savedit(e);


    });
    $.post("../../ajax/competence.php?op=insertpadre",function(r){
        $("#rolsfather").html(r);
        //$("#rolsfather").selectpicker('refresh'); ///como vez? pues si espero agarrarle pronto :p quieres moverle y ya me preguntasok deja le doy un llegue
        // ok solo no vayas a mover nada de user
    });
    $.post("../../ajax/competence.php?op=combotype",function(r){
        $("#typee").html(r);
    });


}
$("#rolsfather").change(function() {

    if($("#rolsfather").val()!=0){
        $("#divDescription").show();
        $("#code").prop('disabled', true);
        traerCodigosParaHijo($("#rolsfather").val());
    }else{
        $("#divDescription").hide();
        $("#code").val("");
        $("#code").prop('disabled', false);
        $("#CodigosDisponibles").hide();

    }



});


$("#CodigosDisponibles").change(function() {
    $("#code").val($("#CodigosDisponibles").val());
});




function traerCodigosParaHijo(idPadreCategorie){

    $('#CodigosDisponibles option').remove();

    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "../../ajax/competence.php?op=getCodeChildren",
        data: {
            idPadreCategorie:idPadreCategorie
        },
        success:function(data){
            $("#code").val(data[0]);
            var Cont = data.length;
            if(Cont>1){
                $("#CodigosDisponibles").show();
                for(var x=0; x<Cont; x++)
                    $('#CodigosDisponibles').append('<option value="'+data[x]+'">'+data[x]+'</option>');
            }else{
                $("#CodigosDisponibles").hide();
            }
        }
    });
}

//Funcion clean
function limpiar()
{
    $("#title").val("");
    $("#typee").val("basic");
    $("#code").val("");
    $("#description").val("");
    $("#rolsfather").val(0);
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




function tolist()
{
    tabla=$('#competence').dataTable(
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
                url: '../../ajax/competence.php?op=tolist',
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




function DeletCompetence(dataToDelete) {


    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "../../ajax/competence.php?op=catdelete",
        data: {
            idcategorie:dataToDelete.idcategorie,
            parentId:dataToDelete.parent_id,
            codetosave:dataToDelete.code
        },
        success:function(data){

            // location.reload();

        }
    });
    //limpiar();
    location.reload();

}

function llennrCamposEditar(datosrow){
    $("#title").val(datosrow.title);
    $("#typee").val(datosrow.typee);
    $("#code").val(datosrow.code);
    $("#description").val(datosrow.description);
    $("#rolsfather").val(datosrow.parent_id);
    $("#divDescription").show();
    $("#code").prop('disabled', true);
    $("#GuardarEditar").val(datosrow.idcategorie);
}




function savedit(e)
{
    e.preventDefault(); //No se activarÃ¡ la acciÃ³n predeterminada del evento///rolsfather

    $("#btnSave").prop("disabled",true);
    var formData = new FormData($("#formcompetence")[0]);
    console.log(formData);
    $.ajax({
        url: "../../ajax/competence.php?op=savedit",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos)
        {
            bootbox.confirm({
                message: "<p>"+datos+"</p>",
                title: "SAVED",
                callback: function(result){
                    location.reload();
                    //if(result == true){DeletCompetence($node.original); }
                }
            });
            //bootbox.alert(datos);
            //mostrarform(false);
            // tabla.ajax.reload();
            // location.reload();
        }

    });
    limpiar();
}

function DeleteCompetence(){

    $('#modalDeleteCompetence').modal();

}
init();










