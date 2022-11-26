<?php include "Views/Templates/header.php"; ?>
<!--Incluimos la Vista Header-->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><strong>Control de Catalogos</strong></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><strong>Home</strong></a></li>
                    <li class="breadcrumb-item active"><strong>Catalogos</strong></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
                            <!-------------------------------------------------------------------------- TABLA CAJAS -------------------------------------------------------------------->
                            <div class="col-md-4">
                                <div class="card border-primary mb-3" style="width: 100%;">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-6">
                                                <strong>CAJAS</strong>
                                            </div>
                                            <div class="col-6">
                                                <button class="btn btn-outline-primary btn-sm" style="float: right;" type="button" onclick="frmCaja();"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">Tabla de Caja.</p>
                                    </div>
                                </div>

                                <hr>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="tblCaja" style="width: 100%;margin-top: 5px;">
                                        <thead style="background: #18212A; color: white;">
                                            <tr>
                                                <th>Caja</th>
                                                <th>Activo</th>
                                                <th style="min-width: 50px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody style="font-size: 10px;">
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-------------------------------------------------------------------------- TABLA CAJAS -------------------------------------------------------------------->
                            <!----------------------------------------------------------------------------------------------------------------------------------------------------------------->

                            <!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
                            <!-------------------------------------------------------------------------- TABLA MEDIDAS ------------------------------------------------------------------>
                            <div class="col-md-4">
                                <div class="card border-primary mb-3" style="width: 100%;">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-6">
                                                <strong>CATEGORIAS</strong>
                                            </div>
                                            <div class="col-6">
                                                <button class="btn btn-outline-primary btn-sm" style="float: right;" type="button" onclick="frmCategoria();"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">Tabla de Categorias</p>
                                    </div>
                                </div>

                                <hr>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="tblCategoria" style="width: 100%;margin-top: 5px;">
                                        <thead style="background: #18212A; color: white;">
                                            <tr>
                                                <th>Categoria</th>
                                                <th>Activo</th>
                                                <th style="min-width: 50px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody style="font-size: 10px;">
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-------------------------------------------------------------------------- TABLA CATEGORIA -------------------------------------------------------------------->
                            <!------------------------------------------------------------------------------------------------------------------------------------------------------------------>


                            <!------------------------------------------------------------------------------------------------------------------------------------------------------------------>
                            <!---------------------------------------------------------------------------- TABLA MEDIDA --------------------------------------------------------------------->
                            <div class="col-md-4">
                                <div class="card border-primary mb-3" style="width: 100%;">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-6">
                                                <strong>MEDIDA</strong>
                                            </div>
                                            <div class="col-6">
                                                <button class="btn btn-outline-primary btn-sm" style="float: right;" type="button" onclick="frmMedida();"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">Tabla de Medidas</p>
                                    </div>
                                </div>

                                <hr>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="tblMedida" style="width: 100%;margin-top: 5px;">
                                        <thead style="background: #18212A; color: white;">
                                            <tr>
                                                <th>Medida</th>
                                                <th>Activo</th>
                                                <th style="min-width: 50px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody style="font-size: 10px;">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!---------------------------------------------------------------------------- TABLA MEDIDA -------------------------------------------------------------------->
                            <!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>

<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------- modal caja --------------------------------------------------------------------->
<div id="nuevo_caja" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #18212a;">
                <h5 class="modal-title" id="title_caja" id="my-modal-title" style="color: white;">Nueva Caja</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: white" aria-label="close" onclick="cerrarModalCaja();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmCaja">
                    <div class="tab-content" id="pills-tabcontent">
                        <div class="tab-pane fade show active" id="pills-general" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div id="info-general">
                                <div class="form-group m-2">
                                    <input type="hidden" id="id_caja" name="id_caja">
                                    <label for="nombre_caja">Nombre Caja</label>
                                    <input id="nombre_caja" class="form-control" type="text" name="nombre_caja" placeholder="Nombre Caja">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="text-center">
                        <button class="btn btn-primary" style="margin-right: 10px;" id="btnAccion_caja" type="button" onclick="registrarCaja(event)">Registrar</button>
                        <button class="btn btn-danger" data-dismiss="modal" aria-label="close" type="button" onclick="cerrarModalCaja();">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--------------------------------------------------------------------------- modal Caja --------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->

<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------- MODAL Categoria ------------------------------------------------------------------->
<div id="nuevo_categoria" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #18212A;">
                <h5 class="modal-title" id="title_categoria" id="my-modal-title" style="color: white;">Nuevo Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: white" aria-label="close" onclick="cerrarModalCategoria();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="frmCategoria">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-general" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div id="info-general">
                                <div class="form-group m-2">
                                    <input type="hidden" id="id_categoria" name="id_categoria">
                                    <label for="nombre_categoria">Nombre Categoria</label>
                                    <input id="nombre_categoria" class="form-control" type="text" name="nombre_categoria" placeholder="Nombre Categoria">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="text-center">
                        <button class="btn btn-primary" style="margin-right: 10px;" id="btnAccion_categoria" type="button" onclick="registrarCategoria(event)">Registrar</button>
                        <button class="btn btn-danger" data-dismiss="modal" aria-label="Close" type="button" onclick="cerrarModalCategoria();">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!------------------------------------------------------------------------- MODAL CATEGORIA ------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->


<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------- MODAL MEDIDA --------------------------------------------------------------------->
<div id="nuevo_medida" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #18212A;">
                <h5 class="modal-title" id="title_medida" id="my-modal-title" style="color: white;">Nueva Medida</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: white" aria-label="close" onclick="cerrarModalMedida();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="frmMedida">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-general" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div id="info-general">
                                <div class="form-group m-2">
                                    <input type="hidden" id="id_medida" name="id_medida">
                                    <label for="nombre_medida">Nombre Medida</label>
                                    <input id="nombre_medida" class="form-control" type="text" name="nombre_medida" placeholder="Nombre Medida">
                                </div>
                                <div class="form-group m-2">
                                    <label for="nombre_corto">Nombre Corti</label>
                                    <input id="nombre_corto" class="form-control" type="text" name="nombre_corto" placeholder="Nombre Corto">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="text-center">
                        <button class="btn btn-primary" style="margin-right: 10px;" id="btnAccion_medida" type="button" onclick="registrarMedida(event)">Registrar</button>
                        <button class="btn btn-danger" data-dismiss="modal" aria-label="Close" type="button" onclick="cerrarModalMedida();">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--------------------------------------------------------------------------  MODAL GERENCIAS --------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->


<?php include "Views/Templates/footer.php"; ?>
<!--Incluimos la Vista Footer-->