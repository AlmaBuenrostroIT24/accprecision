
<?php



require '../layouts/header.php';


?>
        <!--Contenido-->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper"  >
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12" style="font-family: arial, sans-serif">
                        <div class="box" >
                            <div class="box-header with-border">
                                <h1 class="box-title" style="font-family: arial, sans-serif" >Rols for Users</h1>
                                <div class="box-tools pull-right">
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <!-- centro -->
                            <div class="panel-body table-responsive" id="listingregistersrols">
                                <table id="tbllistrols" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <th>Name Rol</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <th>Name Rol</th>
                                    </tfoot>
                                </table>
                            </div>

                            <!--Fin centro -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </section><!-- /.content -->

        </div><!-- /.content-wrapper -->
        <!--Fin-Contenido-->
    <?php

    require '../layouts/footer.php';
    ?>
    <script type="text/javascript" src="../scripts/rols.js"></script>
