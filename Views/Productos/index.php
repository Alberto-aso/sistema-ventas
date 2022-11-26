<?php include "Views/Templates/header.php"; ?>
<!--Incluimos la Vista Header-->

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><strong>Productos</strong></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#"><strong>Home</strong></a></li>
          <li class="breadcrumb-item active"><strong>Productos</strong></li>
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
              <h3 class="card-title">Tabla de Productos</h3>
              <button class="btn btn-dark btn-sm float-end" type="button" onclick="frmProducto();" title="Nuevo Registro">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table id="tblProductos" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Descripcion</th>
                  <th>Compra</th>
                  <th>Venta</th>
                  <th>Cantidad</th>
                  <th>Medida</th>
                  <th>Categoria</th>
                  <th>Estado</th>
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
<div class="modal fade" id="nuevo_producto">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background: #030215">
        <h4 class="modal-title" style="color:white" id="title_nuevo_producto">Nuevo Producto</h4>
        <button type="button" class="close" data-dismiss="modal" style="color: white" aria-label="Close" onclick="cerrarModalProducto();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="frmProductos">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="hidden" id="id_producto" name="id_producto">
                <label for="codigo">Codigo</label>
                <input type="text" class="form-control" id="codigo" name="codigo" style="text-transform: uppercase;" placeholder="Codigo">
              </div>
              <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" style="text-transform: uppercase;" placeholder="...">
              </div>
              <div class="form-group">
                <label for="id_categoria">Categoria</label>
                <select class="form-control" name="id_categoria" id="id_categoria">
                  <?php foreach ($data['categorias'] as $row) { ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" min="0" name="cantidad" placeholder="0">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="precio_compra">Precio Compra</label>
                <input type="number" class="form-control" id="precio_compra" name="precio_compra" style="text-transform: uppercase;" placeholder="0">
              </div>
              <div class="form-group">
                <label for="precio_venta">Precio Venta</label>
                <input type="number" class="form-control" id="precio_venta" name="precio_venta" placeholder="0">
              </div>
              <div class="form-group">
                <label for="id_medida">Medida</label>
                <select class="form-control" name="id_medida" id="id_medida">
                  <?php foreach ($data['medidad'] as $row) { ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <div class="form-group">
                  <label for="estado">Estado</label>
                  <select id="estado" class="form-control" name="estado" disabled>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cerrarModalProducto();">Close</button>
        <button type="button" class="btn btn-primary" style="background: #030215" id="btn_nuevo_producto" onclick="registrarProducto(event)">Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php include "Views/Templates/footer.php"; ?>
<!--Incluimos la Vista Footer-->