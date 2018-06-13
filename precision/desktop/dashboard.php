
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
    if($_SESSION['desktop']==1)
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
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <i class="fa fa-bar-chart-o"></i>

                                <h3 class="box-title">Interactive Area Chart</h3>

                                <div class="box-tools pull-right">
                                    Real time
                                    <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                                        <button type="button" class="btn btn-default btn-xs active" data-toggle="on">On</button>
                                        <button type="button" class="btn btn-default btn-xs" data-toggle="off">Off</button>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div id="interactive" style="height: 300px;"></div>
                            </div>
                            <!-- /.box-body-->
                        </div>
                        <!-- /.box -->

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-md-6">
                        <!-- Line chart -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <i class="fa fa-bar-chart-o"></i>

                                <h3 class="box-title">Line Chart</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div id="line-chart" style="height: 175px;"></div>
                            </div>
                            <!-- /.box-body-->
                        </div>
                        <!-- /.box -->

                        <!-- Area chart -->


                    </div>
                    <!-- /.col -->

                    <div class="col-md-6">
                        <!-- Bar chart -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <i class="fa fa-bar-chart-o"></i>

                                <h3 class="box-title">Bar Chart</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div id="bar-chart" style="height: 175px;"></div>
                            </div>
                            <!-- /.box-body-->
                        </div>
                        <!-- /.box -->


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

    <script type="text/javascript" src="../scripts/status.js"></script>

<?php
}
ob_end_flush();
?>