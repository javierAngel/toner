<br><br><!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <!-- /.col -->
          <div class="col-sm-6">
            <?php if($_SESSION['permisos']['IMP-1-1'] != null){ ?>
              <button class="btn btn-primary" data-toggle="modal" data-target="#addImpresoraModal">Agregar Impresora</button>
            <?php } ?>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><span class='badge bg-blue'>Impresoras</span></li>
            </ol>
          </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
<!-- /.content-header -->

<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="col" style="float:left;">
            <h3 class="card-title">Impresoras</h3>
          </div>
        </div>
        <div class="card-body">
          <table data-filter-control="true" data-show-search-clear-button="true" id="infoImpresora" class="table table-bordered table-striped table-filter">
            <thead>
              <tr>
                <th data-field="nombre" data-filter-control="input">Nombre</th>
                <th data-field="modelo" data-filter-control="input">Modelo</th>
                <th data-field="toners" data-filter-control="input">Toner</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($datos)) { ?>
                <tr role="row" class="odd">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              <?php }else{ ?>
                <?php while($impresora = mysqli_fetch_assoc($datos)){ ?>
                  <tr role="row" class="odd">
                    <td><?php echo($impresora['NOMBRE'])?></td>
                    <td><?php echo($impresora['MODELO']) ?></td>
                    <td><?php if($impresora['EXISTENCIA']>0){ echo ('<span class="badge badge-success" style="cursor: default;">'.$impresora['TONERS'].'</span>'); }else{ echo ('<span class="badge badge-danger" style="cursor: default;">'.$impresora['TONERS'].'</span>'); }?></td>
                    <td align="center"><?php if ($_SESSION['permisos']['IMP-1-2']) { ?>
                      <a title="Editar Información" onclick="editImpresora(<?php echo $impresora['ID_IMPRESORA'] ?>);" style="cursor: pointer;">
                        <i class="fa fa-edit"></i>Editar</a>
                   <?php } ?></td>
                  </tr>
                <?php } ?>
                <?php
                  $impresoraColor = array();
                  $toner = array();
                  while ($rs = mysqli_fetch_assoc($datosColor)) {
                    #IMPRESORA
                      $r = array();
                      array_push($r, $rs['ID_IMPRESORA']);
                      array_push($r, $rs['NOMBRE']);
                      array_push($r, $rs['MODELO']);

                      array_push($impresoraColor, $r);
                    }

                    while ($rs = mysqli_fetch_assoc($datosColorToner)) {
                       # Toners
                      $r = array();
                      array_push($r, $rs['ID_IMPRESORA']);
                      array_push($r, $rs['TONERS']);
                      array_push($r, $rs['EXISTENCIA']);
                      array_push($r, $rs['ID_TONER']);
                      
                      array_push($toner, $r);
                     }
                     foreach ($impresoraColor as $j) {?>
                        <tr role="row" class="odd">
                          <td><?php echo($j[1])?></td>
                          <td><?php echo($j[2]) ?></td>
                          <td>
                          <?php foreach ($toner as $t) {?>
                              <?php 
                                if ($j[0]==$t[0]) { ?>
                                    <?php if($t[2]>0){ echo ('<span class="badge badge-success" style="cursor: pointer;" onclick="eliminarTonImp('.$j[0].','.$t[3].')">'.$t[1].'</span>'); }else{ echo ('<span class="badge badge-danger" style="cursor: pointer;" onclick="eliminarTonImp('.$j[0].','.$t[3].')">'.$t[1].'</span>'); }?>
                                <?php }
                               ?>
                            <?php } ?>
                            </td>
                            <td align="center"><?php if ($_SESSION['permisos']['IMP-1-2']) { ?>
                            <a title="Editar Información" onclick="editImpresora(<?php echo $j[0] ?>);" style="cursor: pointer;">
                              <i class="fa fa-edit"></i>Editar</a>
                                                <?php } ?></td>
                        </tr>
                    <?php }?>

                     
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<div id="addImpresoraModal" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content border-primary">
      <div class="modal-header">
        <h3>Impresoras</h3>
        <button id="closeButton" onclick="limpiarModal('impresora');" type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body bg-primary border-primary">
        <div class="col-sm-12">
          <div class="row">
            <div class="col-8 col-sm-6">
              <label for="nombreLabel">Nombre de la Impresora: </label>
              <input type="text" class="form-control " id="nombre" placeholder="Escriba el nombre de la impresora">
            </div>
            <div class="col-8 col-sm-6">
              <label for="nombreLabel">Modelo: </label>
              <input type="text" class="form-control " id="modelo" placeholder="Escriba del modelo">
            </div>
            <div class="col-8 col-sm-3">
              <div class="form-group">
                <label for="selectFromControlSelect">Toner</label>
                  <select id="toner" class="form-control">
                    <option value="0">Seleccionar</option>
                  </select>
              </div>
            </div>
            <div class="col-8 col-sm-6">
              <label for="tipoImpLabel">Tipo: </label>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptionImp" id="inlineRaUserEdit" value="1">
                <label class="form-check-label" for="inlineRadi">Color</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptionImp" id="inlineRUserEdit" value="0">
                <label class="form-check-label" for="inlineRad">Blanco y Negro</label>
              </div>
            </div>
            <div class="col-8 col-sm-1">
              <a style="cursor: pointer;" onclick="agregarTonImp()" class="nav-link" hidden="true" id="iconAgregar">
                <i class="nav-icon fas fa-plus-circle fa-2x"></i>
              </a>
            </div>
            <input type="hidden" id="multicolor" value="0">
            <div class="col-8 col-sm-12" id="contenToners">
              
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer" id="modal-footer">
        <button id="btnImpresora" onclick="addImpresora();" type="button" class="btn btn-default">Agregar Impresora</button>
        <button onclick="limpiarModal('impresora');" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(function(){
    $('#infoImpresora').bootstrapTable({
      "pagination": true
    });
  });

  $(document).ready(function() {
    function listToners() {
      $.ajax({
        url: '../controller/impresoras.php',
        type: 'POST',
        dataType: 'JSON',
        data: {
          accion: 'llenarlistT'
        },
      })
      .done(function(data) {
        // console.log(data);
        $('#toner').empty();
        $('#toner').append("<option value='0'>Seleccionar</option>");

        $.each(data, function( index, value ) {
              $('#toner').append("<option value='" + index + "'" + ">" + value +"</option>");
        });
      })
      .fail(function() {
        $('#toner').empty();
        $('#toner').append("<option value='0'>Sin datos/Error</option>");
      });
      
    }

    listToners();
  });
</script>