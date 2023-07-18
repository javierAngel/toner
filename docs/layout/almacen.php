<br><br><!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <!-- /.col -->
          <div class="col-sm-6">
            <?php if($_SESSION['permisos']['ALM-1'] != null){ ?>
              <button class="btn btn-primary" data-toggle="modal" data-target="#addAlmacenModal">Agregar Almacen</button>
            <?php } ?>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><span class='badge bg-blue'>Almacenes</span></li>
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
            <h3 class="card-title">Almacenes</h3>
          </div>
        </div>
        <div class="card-body">
          <table data-filter-control="true" data-show-search-clear-button="true" id="infoAlmacen" class="table table-bordered table-striped table-filter">
            <thead>
              <tr>
                <th data-field="nombre" data-filter-control="input">Nombre</th>
                <th data-field="localizacion" data-filter-control="input">Localización</th>
                <th data-field="impresora" data-filter-control="input">Impresora Asignada</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($datos)) { ?>
                <tr role="row" class="odd">
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              <?php }else{ ?>
                <?php while($impres = mysqli_fetch_assoc($datos)){ ?>
                  <tr role="row" class="odd">
                    <td><?php echo($impres['NOMBRE'])?></td>
                    <td><?php echo($impres['LOCALIZACION']) ?></td>
                    <td><?php echo($impres['IMPRESORA']) ?></td>
                    <td align="center"><?php if ($_SESSION['permisos']['ALM-1-2']) { ?>
                      <a title="Editar Información" onclick="editAlmacen(<?php echo $impres['ID_ALMACEN'] ?>);" style="cursor: pointer;">
                        <i class="fa fa-edit"></i>Editar</a>
                   <?php } ?></td>
                  </tr>
                <?php } ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<div id="addAlmacenModal" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content border-primary">
      <div class="modal-header">
        <h3>Almacen</h3>
        <button id="closeButton" onclick="limpiarModal('almacen');" type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body bg-primary border-primary">
        <div class="col-sm-12">
          <div class="row">
            <div class="col-8 col-sm-6">
              <label for="nombreLabel">Nombre del Almacen: </label>
              <input type="text" class="form-control " id="nombre" placeholder="Escriba el nombre del almacen">
            </div>
            <div class="col-8 col-sm-6">
              <label for="nombreLabel">Localización: </label>
              <input type="text" class="form-control " id="localizacion" placeholder="Escriba la localización">
            </div>
            <div class="col-8 col-sm-3">
              <div class="form-group">
                <label for="selectFromControlSelect">Impresora</label>
                  <select id="impresora" class="form-control">
                    <option value="0">Seleccionar</option>
                  </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer" id="modal-footer">
        <button id="btnAlmacen" onclick="addAlmacen();" type="button" class="btn btn-default">Agregar Almacen</button>
        <button onclick="limpiarModal('almacen');" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(function(){
    $('#infoAlmacen').bootstrapTable({
      "pagination": true
    });
  });

  $(document).ready(function() {
    function listImpresoras(id) {
      $.ajax({
        url: '../controller/impresoras.php',
        type: 'POST',
        dataType: 'JSON',
        data: {
          accion: 'llenarlistTon'
        },
      })
      .done(function(data) {
        // console.log(data);
        $('#impresora').empty();
        $('#impresora').append("<option value='0'>Seleccionar</option>");

        $.each(data, function( index, value ) {
              $('#impresora').append("<option value='" + index + "'" + ">" + value +"</option>");
        });
        $("#impresora option[value="+id+"]").attr("selected",true);
      })
      .fail(function() {
        $('#impresora').empty();
        $('#impresora').append("<option value='0'>Sin datos/Error</option>");
      });
      
    }

    listImpresoras();
  });
</script>