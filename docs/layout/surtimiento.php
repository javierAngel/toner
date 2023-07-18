<br><br><!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <!-- /.col -->
          <div class="col-sm-6">
            <button class="btn btn-primary" data-toggle="modal" data-target="#reporteModal">Generar Reporte</button>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><span class='badge bg-blue'>Detalle Surtimiento</span></li>
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
            <h3 class="card-title">Detalle Surtimiento</h3>
          </div>
        </div>
        <div class="card-body">
          <table data-filter-control="true" data-show-search-clear-button="true" id="infoDetSurt" class="table table-bordered table-striped table-filter">
            <thead>
              <tr>
                <th data-field="id" data-filter-control="input">ID</th>
                <th data-field="fecha" data-filter-control="input">Fecha Surtimiento</th>
                <th data-field="toner" data-filter-control="input">Toner</th>
                <th data-field="cantidad" data-filter-control="input">Cantidad Surtida</th>
                <th data-field="almacen" data-filter-control="input">Almacen</th>
                <th data-field="responsable" data-filter-control="input">Responsable</th>
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
                <?php while($detSurt = mysqli_fetch_assoc($datos)){ ?>
                  <tr role="row" class="odd">
                    <td><?php $idSurtimiento=$detSurt['ID_SURTIMIENTO']; echo($idSurtimiento) ?></td>
                    <td><?php echo($detSurt['FECHA']) ?></td>
                    <td><?php echo($detSurt['TONERS']) ?></td>
                    <td><?php echo($detSurt['CANTIDAD']) ?></td>
                    <td><?php echo($detSurt['ALMACENS']) ?></td>
                    <td><?php echo($detSurt['PERSONA']) ?></td>
                    <td><a title="Editar Información" onclick="abrirPDF(<?php echo $idSurtimiento; ?>);" style="cursor: pointer;">
                                  <i class="fas fa-external-link-alt"></i>Abrir</a></td>
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

<div id="reporteModal" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content border-primary">
      <div class="modal-header">
        <h3>Generar Reporte de Pagos</h3>
        <button id="closeButton" type="button" class="close" data-dismiss="modal" onclick="limpiarModal('reporte');">&times;</button>
      </div>
      <div class="modal-body bg-primary border-primary">
        <div class="col-sm-12">
          <div class="row">
            <div class="col-8 col-sm-6">
              <label for="nombreLabel">Fecha Inicio: </label>
              <input type="date" class="form-control" id="fechaInicio">
            </div>
            <div class="col-8 col-sm-6">
              <label for="nombreLabel">Fecha Fin: </label>
              <input type="date" class="form-control" id="fechaFin">
            </div>
             <div class="col-8 col-sm-6">
              <div class="form-group">
                <label for="exampleFormControlSelect">Almacen</label>
                  <select class="form-control" id="almacenes">
                    <option value="0">seleccionar</option>
                  </select>
              </div>
            </div>
            <div class="col-8 col-sm-6">
              <div class="form-group">
                <label for="exampleFormControlSelect">Toners</label>
                  <select class="form-control" id="toners">
                    <option value="0">seleccionar</option>
                  </select>
              </div>
            </div>
          </div>
        </div>
      </div>
          
                
      <div class="modal-footer" id="modal-footer">
        <button id="btnReporte" type="button" class="btn btn-default" onclick="reporteToners()">Generar Reporte</button>
        <button onclick="limpiarModal('reporte');" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(function(){
    $('#infoDetSurt').bootstrapTable({
      "pagination": true
    });
  });

  $(document).ready(function() {
    function listSurtAlm() {
      $.ajax({
        url: '../controller/almacen.php',
        type: 'POST',
        dataType: 'JSON',
        data: {
          accion: 'consultAlm'
        },
      })
      .done(function(data) {
        // console.log(data);
        $('#almacenes').empty();
        $('#almacenes').append("<option value='0'>Seleccionar</option>");

        $.each(data, function( index, value ) {
              $('#almacenes').append("<option value='" + index + "'" + ">" + value +"</option>");
        });
      })
      .fail(function() {
        $('#almacenes').empty();
        $('#almacenes').append("<option value='0'>Sin datos/Error Interno</option>");
        console.log("error");
      });
    }

    listSurtAlm();

    function listSurtTon() {
       $.ajax({
        url: '../controller/toner.php',
        type: 'POST',
        dataType: 'JSON',
        data: {
          accion: 'consultTonList'
        },
      })
      .done(function(data) {
        // console.log(data);
        $('#toners').empty();
        $('#toners').append("<option value='0'>Seleccionar</option>");

        $.each(data, function( index, value ) {
              $('#toners').append("<option value='" + index + "'" + ">" + value +"</option>");
        });
      })
      .fail(function() {
        $('#toners').empty();
        $('#toners').append("<option value='0'>Sin datos/Error Interno</option>");
        console.log("error");
      });
    }
    listSurtTon();
  });
   function listSurtAlm() {
      $.ajax({
        url: '../controller/almacen.php',
        type: 'POST',
        dataType: 'JSON',
        data: {
          accion: 'consultAlm'
        },
      })
      .done(function(data) {
        // console.log(data);
        $('#almacenes').empty();
        $('#almacenes').append("<option value='0'>Seleccionar</option>");

        $.each(data, function( index, value ) {
              $('#almacenes').append("<option value='" + index + "'" + ">" + value +"</option>");
        });
      })
      .fail(function() {
        $('#almacenes').empty();
        $('#almacenes').append("<option value='0'>Sin datos/Error Interno</option>");
        console.log("error");
      });
    }

    function listSurtTon() {
       $.ajax({
        url: '../controller/toner.php',
        type: 'POST',
        dataType: 'JSON',
        data: {
          accion: 'consultTonList'
        },
      })
      .done(function(data) {
        // console.log(data);
        $('#toners').empty();
        $('#toners').append("<option value='0'>Seleccionar</option>");

        $.each(data, function( index, value ) {
              $('#toners').append("<option value='" + index + "'" + ">" + value +"</option>");
        });
      })
      .fail(function() {
        $('#toners').empty();
        $('#toners').append("<option value='0'>Sin datos/Error Interno</option>");
        console.log("error");
      });
    }
</script>