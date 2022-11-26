<?php include "Views/Templates/header.php"; ?>
<!--Incluimos la Vista Header-->

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><strong>Usuarios</strong></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#"><strong>Home</strong></a></li>
          <li class="breadcrumb-item active"><strong>Usuarios</strong></li>
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
          <div class="card-header">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">Tabla de Usuarios</h3>
              <button class="btn btn-dark btn-sm float-end" type="button" onclick="frmUsuario();" title="Nuevo Registro">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table id="tblUsuarios" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Usuario</th>
                  <th>Nombre</th>
                  <th>Caja</th>
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
  </div>
  <!-- /.container-fluid -->
</div>
<!-- /.content -->
<!-- /.modal Para Registrar o Actualizar Usuario-->
<div class="modal fade" id="nuevo_usuario">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #030215">
        <h4 class="modal-title" style="color:white" id="title_nuevo_usuario">Nuevo Usuario</h4>
        <button type="button" class="close" data-dismiss="modal" style="color: white" aria-label="Close" onclick="cerrarModalUsuario();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="frmUsuario">
          <div class="form-group">
            <input type="hidden" id="id_empleado" name="id_empleado">
            <label for="num_empleado">Numero de Empleado</label>
            <input type="number" class="form-control" id="num_empleado" name="num_empleado" placeholder="Numero de Empleado">
          </div>
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" style="text-transform: uppercase;" placeholder="...">
          </div>
          <div class="row" id="claves">
            <div class="col-6">
              <div class="form-group">
                <label for="clave">Clave</label>
                <input type="password" class="form-control" id="clave" name="clave" placeholder="...">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="confirmar">Confirmar</label>
                <input type="password" class="form-control" id="confirmar" name="confirmar" placeholder="...">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="confirmar">Caja</label>
            <select id="caja_id" class="form-control" name="caja_id">
              <?php foreach($data['cajas'] as $row) {?>
              <option value="<?php echo $row['id']?>"><?php echo $row['caja']?></option>
              <?php }?>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cerrarModalUsuario();">Close</button>
        <button type="button" class="btn btn-primary" style="background: #030215" id="btn_nuevo_usuario" onclick="registrarUser(event)">Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php include "Views/Templates/footer.php"; ?>
<!--Incluimos la Vista Footer-->