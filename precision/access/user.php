
<?php

//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if(!isset($_SESSION["name_user"]))
{
    header("Location:login.html");
}
else
{

    require '../layouts/header.php';
    if($_SESSION['access']==1)
    {

        ?>
        <!--Contenido-->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">


                <div class="row">
                    <div class="col-xs-12">
                        <!-- interactive chart -->
                        <div class="box box-primary" style="font-family: arial, sans-serif">
                            <div class="box-header with-border">
                                <i class="fa fa-user"></i>

                                <h3 class="box-title">Create Users</h3>


                            </div>
                            <div class="box-body">
                                <div id="interactive">
                                    <!--Contenido-->
                                    <!-- Content Wrapper. Contains page content -->
                                    <!--

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h1 class="box-title"><button class="btn btn-primary pull-right" id="btnagregar" onclick="showformuser(true)"><i class="fa fa-plus-circle"></i> Add User</button></h1>
                                        </div>
                                    </div>-->

                                    <!-- /.box-header -->
                                    <!-- centro -->
                                    <div class="panel-body table-responsive" id="listadoregistros">
                                        <table id="tbllistuser" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                            <th>User</th>
                                            <th>Type User</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Login</th>
                                            <th>Photo</th>
                                            <th>Status</th>
                                            <th>Option</th>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="panel-body" id="formularioregistros">
                                        <form name="formulario" id="formulario" method="POST">
                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Name(*):</label>
                                                <input type="hidden" name="iduser" id="iduser">
                                                <input type="text" class="form-control" name="name_user" id="name_user" maxlength="100" placeholder="Name User" required>
                                            </div>
                                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Type User(*):</label>
                                                <select class="form-control select-picker" name="type_user" id="type_user" required>
                                                    <option value="Inside">Inside</option>
                                                    <option value="outside">Outside</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Address:</label>
                                                <input type="text" class="form-control" name="address" id="address" placeholder="Address User" maxlength="70">
                                            </div>
                                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Phone:</label>
                                                <input type="text" class="form-control" name="phone" id="phone" maxlength="20" placeholder="Phone Number">
                                            </div>
                                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Email:</label>
                                                <input type="email" class="form-control" name="email" id="email" maxlength="50" placeholder="Email">
                                            </div>
                                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Login (*):</label>
                                                <input type="text" class="form-control" name="login" id="login" maxlength="20" placeholder="Login" required>
                                            </div>
                                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Password (*):</label>
                                                <input type="password" class="form-control" name="password" id="password" maxlength="64" placeholder="Password User" required>
                                            </div>
                                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Rols User:</label>
                                                <ul style="list-style: none;" id="rols">


                                                </ul>
                                            </div>

                                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Photo:</label>
                                                <input type="file" class="form-control" name="photo" id="photo">
                                                <input type="hidden" name="currentphoto" id="currentphoto">
                                                <img src="" width="150px" height="120px" id="showphoto">
                                            </div>
                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                                                <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                                            </div>
                                        </form>
                                    </div>



                                </div>
                            </div>
                            <!-- /.box-body-->
                        </div>
                        <!-- /.box -->

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </section><!-- /.content -->

        </div><!-- /.content-wrapper -->
        <!--Fin-Contenido-->
    <?php
    } else
    {
        require '../noacceso.php';
    }
    require '../layouts/footer.php';
    ?>

    <script type="text/javascript" src="../scripts/user.js"></script>

<?php
}
ob_end_flush();
?>