var tablerols;

//Función que se ejecuta al inicio
function init(){
    showformrols(false);
    listrols();
}

//Función mostrar formulario
function showformrols(flag)
{
    if (flag)
    {
        $("#listingregistersrols").hide();
    }
    else
    {
        $("#listingregistersrols").show();
    }
}


//Función Listar
function listrols()
{
    tablerols=$('#tbllistrols').dataTable(
        {
            "aProcessing": true,//Activamos el procesamiento del datatables
            "aServerSide": true,//Paginación y filtrado realizados por el servidor
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
            ],
            "ajax":
            {
                url: '../../ajax/rols.php?op=listrols',
                type : "get",
                dataType : "json",
                error: function(e){
                    console.log(e.responseText);
                }
            },
            "bDestroy": true,
            "iDisplayLength": 10,//Paginación
            "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
        }).DataTable();
}

init();