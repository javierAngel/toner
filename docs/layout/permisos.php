<br><br>      <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <?php if($_SESSION['permisos']['US-PE-2-1'] != null){ ?>
                  <button class="btn btn-primary" data-toggle="modal" data-target="#addPermisoModal">Agregar Permisos</button>
                <?php } ?>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active"><span class='badge bg-blue'>Permisos</span></li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- /.content -->
        <section class="content">
      <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
              <div class="col" style="float: left;">
                <h3 class="card-title">Permisos</h3>
              </div>
              <!--div style="float: right;">
                <div class="col-12">
                  <button type="button" class="btn btn-success btn-filter" data-target="positivo">Positivos</button>
                  <button type="button" class="btn btn-warning btn-filter" data-target="sospechoso">Sospechosos</button>
                  <button type="button" class="btn btn-danger btn-filter" data-target="negativo">Negativos</button>
                  <button type="button" class="btn btn-default btn-filter" data-target="all">Todos</button>
                </div>
              </div -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table data-filter-control="true" data-show-search-clear-button="true" id="infoPermiso" class="table table-bordered table-striped table-filter">
                <thead>
                <tr>
                  <th data-field="clave" data-filter-control="input">Clave</th>
                  <th data-field="descripcion" data-filter-control="input">Descripción</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($datos)) {?>
                  <tr role="row" class="odd">
                    <td> </td>
                    <td> </td>
                    <td> </td>
                  </tr>
                <?php }else{ ?>
          <?php while($permiso = mysqli_fetch_assoc($datos)){ ?>
                    <tr role="row" class="odd">
                        <td><?php echo($permiso['CLAVE']) ?></td>
                        <td><?php echo($permiso['DESCRIPCION']) ?></td>
                         <td align="center">
                        <?php if($_SESSION['permisos']['US-PE-2-2'] != null){ ?>
                        <a title="Editar Información" onclick="editPermiso(<?php echo $permiso['ID_PERMISO'] ?>);" style="cursor: pointer;">
                        <i class="fa fa-edit"></i>Editar</a>
                        <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Clave</th>
                  <th>Descripción</th>
                  <th></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

<div id="addPermisoModal" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg">

          <!-- Modal content-->
          <div class="modal-content border-primary">
            <div class="modal-header">
              <h3>Permisos</h3>
              <button id="closeButton" onclick="limpiarModal('permiso');" type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body bg-primary border-primary">
                <div class="col-sm-12">
                <div class="row">
                    <div class="col-8 col-sm-6">
                        <label for="nombreLabel">Clave: </label>
                    <input type="text" class="form-control " id="clave" placeholder="Escriba la Clave">
                    </div>
                    <div class="col-8 col-sm-6">
                        <label for="nombreLabel">Descripción: </label>
                    <input type="text" class="form-control " id="descripcion" placeholder="Escriba la descripción">
                    </div>
                    </div>
                </div>
            </div>
          
                
            <div class="modal-footer" id="modal-footer">
              <button id="btnPermiso" onclick="addPermiso();" type="button" class="btn btn-default">Agregar Permiso</button>
              <button onclick="limpiarModal('permiso');" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          </div>
        </div>

<script>
  $(function() {
    $('#infoPermiso').bootstrapTable({
      "pagination": true
    });
  });
</script>