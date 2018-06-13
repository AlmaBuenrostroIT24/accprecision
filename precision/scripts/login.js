
$("#frmAcceso").on('submit',function(e)
{
    e.preventDefault();
    logina=$("#logina").val();
    clavea=$("#clavea").val();



    $.post("../ajax/user.php?op=check",
        {"logina":logina,"clavea":clavea},
        function(data)
        {
            if (data!="null")
            {
                $(location).attr("href","desktop/dashboard.php");
            }
            else
            {
                bootbox.alert("Incorrect username and / or password");
            }
        });
})