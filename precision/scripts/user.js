var tabla;

//FunciÃ³n que se ejecuta al inicio
function init(){
    showformuser(false);
    listar();

    $("#formulario").on("submit",function(e)
    {
        saveEditUser(e);
    })

    $("#imagenmuestra").hide();
    //Mostramos los permisos
    $.post("../../ajax/user.php?op=rols&id=",function(r){
        $("#rols").html(r);
    });
}

//FunciÃ³n limpiar
function cleanuser()
{
    $("#name_user").val("");
    $("#type_user").val("");
    $("#address").val("");
    $("#phone").val("");
    $("#email").val("");
    $("#login").val("");
    $("#password").val("");
    $("#showphoto").attr("src","");
    $("#currentphoto").val("");
   // $("#rols").valueOf("");
    $("#iduser").val("");
}

//FunciÃ³n mostrar formulario
function showformuser(flag)
{
    cleanuser();
    if (flag)
    {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled",false);
        $("#btnagregar").hide();
    }
    else
    {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

//FunciÃ³n cancelarform
function cancelarform()
{
    cleanuser();
    showformuser(false);
}

//FunciÃ³n Listar
function listar()
{
    tabla=$('#tbllistuser').dataTable(
        {
            "scrollY": "416px",
            "scrollX": false,
            "scrollCollapse": true,
            "bInfo" : true,
            "paging": false,
            "aProcessing": true,//Activamos el procesamiento del datatables
            "aServerSide": false,//PaginaciÃ³n y filtrado realizados por el servidor
            dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [
                {
                    extend:    'copyHtml5',
                    text:      '<i class="fa fa-files-o"></i>',
                    titleAttr: 'Copy'
                    
                },
                {
                    extend:    'excelHtml5',
                    text:      '<i class="fa fa-file-excel-o"></i>',
                    titleAttr: 'Excel'
                },
                {
                    extend:    'csvHtml5',
                    text:      '<i class="fa fa-file-text-o"></i>',
                    titleAttr: 'Csv'
                },
                {
                    extend:    'pdfHtml5',
                    text:      '<i class="fa fa-file-pdf-o"></i>',
                    titleAttr: 'Pdf'
                },

                {

                    text: '<i class="fa " style="font-family: arial, sans-serif; font-size: 14px"><i class="fa fa-user-plus"></i> Add User</i>',
                    sButtonClass:"btn btn-primary",
                    fontFamily: "arial, sans-serif",
                    titleAttr: 'Add New Employee',
                    action: function (e, node, config){
                        $('#btnagregar').onClick(showformuser(true));
                    }}


            ],
            "ajax":
            {
                url: '../../ajax/user.php?op=listuser',
                type : "get",
                dataType : "json",
                error: function(e){
                    console.log(e.responseText);
                }
            },
            "bDestroy": true,
            //"iDisplayLength": 5,//PaginaciÃ³n
            "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
        }).DataTable();


    tabla.button(4).nodes().css('background', '#3c8dbc'); //style="font-family: arial, sans-serif"
    tabla.button(4).nodes().css('color', 'white');
    $('.dataTables_filter input[type="search"]').css({ 'width': '140px','height': '30px', 'display': 'inline-block'});

}
//FunciÃ³n para guardar o editar

function saveEditUser(e)
{
    e.preventDefault(); //No se activarÃ¡ la acciÃ³n predeterminada del evento
    $("#btnGuardar").prop("disabled",true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../../ajax/user.php?op=saveEditUser",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos)
        {
            bootbox.alert(datos);
            showformuser(false);
            tabla.ajax.reload();
        }

    });
    cleanuser();
}

function showuser(iduser)
{
    $.post("../../ajax/user.php?op=showuser",{iduser : iduser}, function(data, status)
    {
        data = JSON.parse(data);
        showformuser(true);

        $("#name_user").val(data.name_user);
        $("#tipo_documento").val(data.tipo_documento);
        // $("#tipo_documento").selectpicker('refresh');
        $("#address").val(data.address);
        $("#phone").val(data.phone);
        $("#email").val(data.email);
        $("#login").val(data.login);
        $("#password").val(data.password);
        $("#showphoto").show();
        $("#showphoto").attr("src","../../files/user/"+data.photo);
        $("#currentphoto").val(data.photo);
        $("#iduser").val(data.iduser);

    });
    $.post("../../ajax/user.php?op=rols&id="+iduser,function(r){
        $("#rols").html(r);
    });
}

//FunciÃ³n para desactivar registros
function deactivateuser(iduser)
{
    bootbox.confirm("Are you sure you want to deactivate the user?", function(result){
        if(result)
        {
            $.post("../../ajax/user.php?op=deactivateuser", {iduser : iduser}, function(e){
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//FunciÃ³n para activar registros
function activateuser(iduser)
{
    bootbox.confirm("Are you sure you want to activate the user?", function(result){
        if(result)
        {
            $.post("../../ajax/user.php?op=activateuser", {iduser : iduser}, function(e){
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

init();