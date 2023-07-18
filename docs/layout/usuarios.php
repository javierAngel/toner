<br><br>
   <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <?php if($_SESSION['permisos']['US-PE-1-1'] != null){ ?>
                  <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">Agregar Usuarios</button>
                <?php } ?>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active"><span class='badge bg-blue'>
                   Usuarios</span></li>
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
          <div class="col-12">

              <div class="card-header">
                <div class="col-12" style="float: left;">
                  <h3 class="card-title">Usuarios</h3>
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
                <table data-filter-control="true" data-show-search-clear-button="true" id="infoUser" class="table table-bordered table-striped table-filter">
                  <thead>
                  <tr>
                    <th data-field="name" data-filter-control="input">Nombre y Apellidos</th>
                    <th data-field="usuario" data-filter-control="input">Usuario</th>
                    <th data-field="estado" data-filter-control="input">Estado</th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if (empty($datos)) {?>
                    <tr role="row" class="odd">
                      <td> </td>
                      <td> </td>
                      <td> </td>
                      <td> </td>
                      <td> </td>
                      <td> </td>
                    </tr>
                  <?php }else{ ?>
              <?php while($user = mysqli_fetch_assoc($datos)){ ?>
                        <tr role="row" class="odd">
                            <td><?php echo($user['NOMBRE'].' '.$user['APELLIDO_PAT'].' '.$user['APELLIDO_MAT']) ?></td>
                            <td><?php echo($user['EMAIL']) ?></td>
                            <td><?php if($_SESSION['permisos']['US-PE-1-4'] != null){ ?>
                              <?php switch ($user['ESTADO']) {
                              case 0:
                                echo "<span onclick='cambiarEstadoUser(".$user['ID_USUARIO'].",1);' style='cursor: pointer;' class='badge bg-red'>Desactivado</span>";
                                break;
                              case 1:
                                echo "<span onclick='cambiarEstadoUser(".$user['ID_USUARIO'].",0);' style='cursor: pointer;' class='badge bg-green'>Activo</span>";
                                break;
                            }?><?php } ?></td>
                            <td align="center">
                              <?php if($_SESSION['permisos']['US-PE-1-2'] != null){ ?>
                            <a title="Agregar Permisos" onclick="modificarPermisos(<?php echo $user['ID_USUARIO'] ?>);" style="cursor: pointer;">
                            <i class="fa fa-plus"></i>Agregar</a>
                          <?php } ?>
                            </td>
                            <td align="center">
                            <?php if($_SESSION['permisos']['US-PE-1-3'] != null){ ?>
                            <a title="Editar Información" onclick="modificarUser(<?php echo $user['ID_USUARIO'] ?>);" style="cursor: pointer;">
                            <i class="fa fa-edit"></i>Editar</a>
                            <?php } ?>
                            </td>
                            <td align="center">
                            <?php if($_SESSION['permisos']['US-PE-1-5'] != null){ ?>
                              <a title="Editar Contraseña" onclick="modificarPass(<?php echo $user['ID_USUARIO'] ?>);" style="cursor: pointer;">
                            <i class="fa fa-paper-plane"></i>Editar Contraseña</a>
                            <?php } ?></td>
                        </tr>
                        <?php } ?>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>Nombre y Apellidos</th>
                      <th>Usuario</th>
                      <th>Tipo</th>
                      <th>Estado</th>
                      <th></th>
                      <th></th>
                    </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
        </div>
        </div>
          <!-- /.card -->
          
          <!-- /.card -->
      </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
        
      <div id="editUserModal" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg">

          <!-- Modal content-->
          <div class="modal-content border-primary">
            <div class="modal-header">
              <h3>Modificar Usuario</h3>
              <button id="closeButton" type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body bg-primary border-primary">
                <div class="col-sm-12">
                <div class="row">
                    <div class="col-8 col-sm-6">
                      <input type="hidden" id="tipoUser" value=<?php echo $_SESSION['tipoUser']; ?>>
                        <label for="nombreLabel">Nombre: </label>
                        <input type="text" class="form-control" id="nombreInputUserEdit" onkeypress="txNombres();" placeholder="Escriba el Nombre"> 
                    </div>
                    <div class="col-8 col-sm-6">
                        <label for="nombreLabel">Apellido Paterno: </label>
                        <input type="text" class="form-control" id="apellidoPaternoInputUserEdit" onkeypress="txNombres();" placeholder="Escriba el Apellido Paterno">
                    </div>
                    <div class="col-8 col-sm-6">
                        <label for="nombreLabel">Apellido Materno: </label>
                        <input type="text" class="form-control" id="apellidoMaternoInputUserEdit" onkeypress="txNombres();" placeholder="Escriba el Apellido Materno">
                    </div>
                    <div class="col-8 col-sm-6">
                        <label for="nombreLabel">Correo: </label>
                    <input type="text" class="form-control " id="correoUserEdit" placeholder="Escriba un correo">
                    </div>
                    <div class="col-8 col-sm-6">
                        <label for="generoLabel">Genero: </label>
                        <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptioUserEdit" id="inlineRaUserEdit" value="0">
                    <label class="form-check-label" for="inlineRadi">Masculino</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptioUserEdit" id="inlineRUserEdit" value="1">
                    <label class="form-check-label" for="inlineRad">Femenino</label>
                  </div>
                    </div>
            </div>
                </div>
            </div>
            <div class="modal-footer" id="modal-footer">
              <button id="btnEditUser" type="button" class="btn btn-default">Editar Usuario</button>
              <button onclick="limpiarModal('userEdit');" id="btncancel" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          </div>
        </div>


      <div id="addUserModal" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg">

          <!-- Modal content-->
          <div class="modal-content border-primary">
            <div class="modal-header">
              <h3>Agregar Usuario</h3>
              <button id="closeButton" type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body bg-primary border-primary">
                <div class="col-sm-12">
                <div class="row">
                    <div class="col-8 col-sm-6">
                        <label for="nombreLabel">Nombre: </label>
                        <input type="text" class="form-control" id="nombreInputUser" onkeypress="txNombres();" placeholder="Escriba el Nombre"> 
                    </div>
                    <div class="col-8 col-sm-6">
                        <label for="nombreLabel">Apellido Paterno: </label>
                        <input type="text" class="form-control" id="apellidoPaternoInputUser" onkeypress="txNombres();" placeholder="Escriba el Apellido Paterno">
                    </div>
                    <div class="col-8 col-sm-6">
                        <label for="nombreLabel">Apellido Materno: </label>
                        <input type="text" class="form-control" id="apellidoMaternoInputUser" onkeypress="txNombres();" placeholder="Escriba el Apellido Materno">
                    </div>
                    <div class="col-8 col-sm-6">
                        <label for="nombreLabel">Usuario: </label>
                    <input type="text" class="form-control " id="correoUser" placeholder="Escriba un usuario">
                    </div>
                    <div class="col-8 col-sm-6">
                        <label for="nombreLabel">Contraseña: </label>
                    <input type="password" class="form-control " id="passUser" placeholder="Escriba su contraseña">
                    </div>
                    <div class="col-8 col-sm-6">
                        <label for="nombreLabel">Confirmar Contraseña: </label>
                    <input type="password" class="form-control " id="passUserConfi">
                    </div>
                    <div class="col-8 col-sm-6">
                        <label for="generoLabel">Genero: </label>
                        <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptioUser" id="inlineRaUser" value="0">
                    <label class="form-check-label" for="inlineRadi">Masculino</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptioUser" id="inlineRUser" value="1">
                    <label class="form-check-label" for="inlineRad">Femenino</label>
                  </div>
                    </div>
                  </div>
                  </div>
                    </div>               
            <div class="modal-footer" id="modal-footer">
              <button id="buttonAddUser" onclick="addUser(1);" type="button" class="btn btn-default">Guardar Usuario</button>
              <button onclick="limpiarModal('user');" id="btncancel" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          </div>
        </div>
 
  <div id="cambioPass" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg">

          <!-- Modal content-->
          <div class="modal-content border-primary">
            <div class="modal-header">
              <h3>Cambiar Contraseña</h3>
              <button id="closeButton" type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body bg-primary border-primary">
                <div class="col-sm-12">
                <div class="row">
                    <div class="col-8 col-sm-6">
                        <label for="nombreLabel">Nueva Contraseña: </label>
                    <input type="password" class="form-control " id="passUserCambio" placeholder="Escriba su contraseña">
                    </div>
                    <div class="col-8 col-sm-6">
                        <label for="nombreLabel">Confirmar Contraseña: </label>
                    <input type="password" class="form-control " id="passUserConfiCambio">
                    </div>
                    </div>
                </div>
            </div>
          
                
            <div class="modal-footer" id="modal-footer">
              <button id="btnCambioPass" type="button" class="btn btn-default">Cambiar Contraseña</button>
              <button onclick="limpiarModal('cambio');" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          </div>
        </div>
<div id="addTipoModal" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg">
  <!-- Modal content-->
    <div class="modal-content border-primary">
      <div class="modal-header">
        <h3>Tipo User</h3>
        <button id="closeButton" type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body bg-primary border-primary">
        <div class="col-sm-12">
          <div class="row">
              <div class="col-8 col-sm-6">
                <label for="nombreLabel">Nombre de tipo user: </label>
                <input type="text" class="form-control " id="tipoUserText" placeholder="Escriba un nombre">
              </div>
          </div>
        </div>
      </div>
          
                
      <div class="modal-footer" id="modal-footer">
        <button id="btnTipoUser" onclick="guardarTipoUser();" type="button" class="btn btn-default">Guardar Tipo User</button>
        <button onclick="limpiarModal('tipoUser');" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="modalPermisos" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg">

          <!-- Modal content-->
          <div class="modal-content border-primary">
            <div class="modal-header">
              <h3>Agregar Usuario Permisos</h3>
              <button id="closeButton" type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body bg-primary border-primary">
              <div class="col-sm-12">
                <div class="row">
                    <div class="col-8 col-sm-4">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkPermiso1" value="1">
                        <label class="form-check-label" for="inlineCheckbox1">Usuarios y Permisos</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkPermiso2" value="2">
                        <label class="form-check-label" for="inlineCheckbox2">Ver Usuarios</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkPermiso3" value="3">
                        <label class="form-check-label" for="inlineCheckbox3">Agregar Usuarios</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkPermiso4" value="4">
                        <label class="form-check-label" for="inlineCheckbox4">Agregar Permisos</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkPermiso5" value="5">
                        <label class="form-check-label" for="inlineCheckbox5">Editar Usuarios</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkPermiso6" value="6">
                        <label class="form-check-label" for="inlineCheckbox6">Desactivar/Activar Usuario</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkPermiso7" value="7">
                        <label class="form-check-label" for="inlineCheckbox7">Enviar/Cambiar Contraseña</label>
                      </div>
                    </div>
                    <div class="col-8 col-sm-4">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkPermiso8" value="8">
                        <label class="form-check-label" for="checkPermiso8">Permisos</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkPermiso9" value="9">
                        <label class="form-check-label" for="checkPermiso9">Agregar Permisos</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkPermiso10" value="10">
                        <label class="form-check-label" for="checkPermiso10">Editar Permisos</label>
                      </div>
                    </div>
                    <div class="col-8 col-sm-4">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkPermiso14" value="14">
                        <label class="form-check-label" for="checkPermiso14">Almacenes</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkPermiso15" value="15">
                        <label class="form-check-label" for="checkPermiso15">Agregar Almacenes</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkPermiso16" value="16">
                        <label class="form-check-label" for="checkPermiso16">Editar Almacen</label>
                      </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-8 col-sm-4">
                      <div class="form-check form-check-inline">
                        
                      </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-8 col-sm-4">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkPermiso20" value="20">
                        <label class="form-check-label" for="checkPermiso20">Toners</label>
                      </div><br>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkPermiso21" value="21">
                        <label class="form-check-label" for="checkPermiso21">Agregar Toner</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkPermiso22" value="22">
                        <label class="form-check-label" for="checkPermiso22">Agregar Existencia</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkPermiso23" value="23">
                        <label class="form-check-label" for="checkPermiso23">Editar Toner</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkPermiso26" value="26">
                        <label class="form-check-label" for="checkPermiso26">Detalle Surtimiento</label>
                      </div>
                    </div>
                    <div class="col-8 col-sm-4">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkPermiso32" value="32">
                        <label class="form-check-label" for="checkPermiso32">Impresoras</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkPermiso33" value="33">
                        <label class="form-check-label" for="checkPermiso33">Agregar Impresoras</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkPermiso34" value="34">
                        <label class="form-check-label" for="checkPermiso34">Editar Impresora</label>
                      </div>
                    </div>
                </div>
              </div>
            </div>
                
            <div class="modal-footer" id="modal-footer">
              <button id="btnAddPermisoUser" type="button" class="btn btn-default">Asignar Permisos</button>
              <button onclick="limpiarModal('usuarioPermiso');" id="btncancel" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          </div>
        </div>

  </div>
</div>
<script>
  $(function() {
    $('#infoUser').bootstrapTable({
      "pagination": true
    });
  });
  // $(document).ready(function() {});
   
</script>