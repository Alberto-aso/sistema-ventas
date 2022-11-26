<?php include "Views/Templates/header.php"; ?>
<!--Incluimos la Vista Header-->

<!--Herader del contenedor de la pagina actual-->
<!---------------------------------------------->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><strong>Clientes</strong></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#"><strong>Home</strong></a></li>
          <li class="breadcrumb-item active"><strong>Clientes</strong></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!---------------------------------------------->
<!---------------------------------------------->

<!--Inicio del contenedor principal de la pagina actual-->
<!---------------------------------------------->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">Clientes</h3>
              <button class="btn btn-dark btn-sm float-end" type="button" onclick="frmClientes();" title="Nuevo Registro">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table id="tblClientes" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>INE</th>
                  <th>Nombre</th>
                  <th>Direccion</th>
                  <th>Telefono</th>
                  <th>Activo</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  <!-- /.modal Para Registrar o Actualizar Usuario-->
<!---------------------------------------------->
    <div class="modal fade" id="nuevo_cliente">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" style="background: #030215">
            <h4 class="modal-title" style="color:white" id="title_nuevo_cliente">Nuevo Cliente</h4>
            <button type="button" class="close" data-dismiss="modal" style="color: white" aria-label="Close" onclick="cerrarModalCliente();">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" id="frmCliente">
              <div class="form-group">
                <input type="hidden" id="id_cliente" name="id_cliente">
                <label for="ine">INE</label>
                <input type="text" class="form-control" id="ine" name="ine" style="text-transform: uppercase;" placeholder="INE">
              </div>
              <div class="form-group">
                <label for="nombre_cliente">Nombre</label>
                <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" style="text-transform: uppercase;" placeholder="...">
              </div>
              <div class="form-group">
                <label for="direccion_cliente">Direccion</label>
                <input type="text" class="form-control" id="direccion_cliente" name="direccion_cliente" style="text-transform: uppercase;" placeholder="...">
              </div>
              <div class="form-group">
                <label for="telefono_cliente">telefono</label>
                <input type="number" class="form-control" id="telefono_cliente" name="telefono_cliente" style="text-transform: uppercase;" placeholder="...">
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cerrarModalCliente();">Close</button>
            <button type="button" class="btn btn-primary" style="background: #030215" id="btn_nuevo_cliente" onclick="registrarCliente(event)">Save</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <?php include "Views/Templates/footer.php"; ?>
    <!--Incluimos la Vista Footer-->
