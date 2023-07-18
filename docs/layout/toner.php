<br><br><!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
            	<div class="col-sm-6">
                <?php if($_SESSION['permisos']['TON-1-1'] != null){ ?>
                  <button class="btn btn-info" data-toggle="modal" data-target="#addTonerModal">Agregar Toner</button>
                  <button class="btn btn-info" onclick="window.open('../controller/reporteExistenciaPDF.php');">Reporte Existencia</button>
                <?php } ?>
              </div>
              <!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active"><span class='badge bg-blue'>Toner</span></li>
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
	            <!-- /.card-body -->
	            <ul class="nav nav-tabs" id="myTab" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Toner</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Existencia Agregada a Toner</a>
				  </li>
          <li class="nav-item">
            <a class="nav-link" id="factura-tab" data-toggle="tab" href="#factura" role="tab" aria-controls="profile" aria-selected="false">Facturas</a>
          </li>
				</ul>
				<div class="tab-content" id="myTabContent">
				  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
	                  <div class="card-header">
	                    <div class="col" style="float: left;">
	                      <h3 class="card-title">Toner</h3>
	                    </div>
	                  </div>
	                  <!-- /.card-header -->
	                  <div class="card-body">
	                  	<button class="btn btn-info" data-toggle="modal" data-target="#addFacturaModal">Agregar Factura</button>
	                  	<table data-filter-control="true" data-show-search-clear-button="true" id="toners" class="table table-bordered table-striped table-filter">
				                <thead>
				                <tr>
				                  <th data-field="nombre" data-filter-control="input">Nombre</th>
				                  <th data-field="modelo" data-filter-control="input">Modelo</th>
				                  <th data-field="descripcion" data-filter-control="input">Descripción</th>
				                  <th data-field="existencia" data-filter-control="input">Existencia</th>
				                  <th></th>
				                </tr>
				                </thead>
				                <tbody>
				                <?php if (empty($toner)) {?>
				                  <tr role="row" class="odd">
				                    <td> </td>
				                    <td> </td>
				                    <td> </td>
				                    <td> </td>
				                    <td> </td>
				                  </tr>
				                <?php }else{ ?>
				          			<?php while($results = mysqli_fetch_assoc($toners)){ ?>
				                    <tr role="row" class="odd">
			                        <td><?php echo ($results['NOMBRE']); ?></td>
			                        <td><?php echo($results['MODELO']) ?></td>
			                        <td><?php echo($results['DESCRIPCION']) ?></td>
			                        <td>
			                          <?php if($_SESSION['permisos']['TON-1-2'] != null){ ?>
			                            <?php $idToner=$results['ID_TONER']; if ($results['EXISTENCIA']==0){ echo('<span class="badge badge-danger" onclick="agregarExistencia('.$idToner.')" style="cursor: pointer;">Agregar Existencia</span>'); }else{ echo('<span class="badge badge-success" onclick="agregarExistencia('.$idToner.')" style="cursor: pointer;">'.$results['EXISTENCIA'].'</span>'); } ?>
			                          <?php } ?>
			                        </td>
			                        <td>
			                        	<?php if ($_SESSION['permisos']['TON-1-3'] != null) { ?>
			                        		<a title="Editar Información" onclick="editarToner(<?php echo $idToner; ?>);" style="cursor: pointer;">
				                        	<i class="fas fa-edit"></i>Editar Toner</a>
			                        	<?php } ?>
			                    		</td>
				                    </tr>
				                    <?php } ?>
				                <?php } ?>
				                </tbody>
				              </table>
	                  </div>
	                  <!-- /.card-body -->
				  </div>
				  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
				  	<div class="card-body">
		              <table data-filter-control="true" data-show-search-clear-button="true" id="detalleToner" class="table table-bordered table-striped table-filter">
		                <thead>
		                <tr>
		                  <th data-field="fecha" data-filter-control="input">Fecha</th>
		                  <th data-field="usuario" data-filter-control="input">Usuario</th>
		                  <th data-field="toner" data-filter-control="input">Toner</th>
		                  <th data-field="existencia" data-filter-control="input">Existencia Agregada</th>
		                  <th></th>
		                </tr>
		                </thead>
		                <tbody>
		                <?php if (empty($datosToner)) {?>
		                  <tr role="row" class="odd">
		                    <td> </td>
		                    <td> </td>
		                    <td> </td>
		                    <td> </td>
		                    <td> </td>
		                  </tr>
		                <?php }else{ ?>
		          			<?php while($result = mysqli_fetch_assoc($datosToner)){ ?>
		                    <tr role="row" class="odd">
		                        <td><?php echo ($result['FECHA']); ?></td>
		                        <td><?php echo($result['NOMBRE']) ?></td>
		                        <td><?php echo($result['TONERS']) ?></td>
		                        <td><?php echo($result['EXISTENCIA_AGREGADA']) ?></td>
		                        <td>
		                          <?php if($_SESSION['permisos']['TON-1-4'] != null){ ?>
		                            <?php if ($result['ESTADO']==1) {
		                            	echo('<span class="badge badge-danger" onclick="cancelarExistencia('.$result['ID_DET_EXIS'].')" style="cursor: pointer;">Cancelar</span>');
		                            }else{ echo ('CANCELADO');} ?>
		                          <?php } ?>
			                      </td>
		                    </tr>
		                    <?php } ?>
		                <?php } ?>
		                </tbody>
		              </table>
		            </div>
				  </div>
          <div class="tab-pane fade" id="factura" role="tabpanel" aria-labelledby="factura-tab">
            <div class="card-header">
              <div class="col" style="float: left;">
                <h3 class="card-title">Facturas</h3>
              </div>
            </div>
            <div class="card-body">
              <table data-filter-control="true" data-show-search-clear-button="true" id="facturas" class="table table-bordered table-striped table-filter">
                <thead>
                <tr>
                  <th data-field="nombre" data-filter-control="input">Folio</th>
                  <th data-field="modelo" data-filter-control="input">Fecha</th>
                  <th>Detalle Sistema</th>
                  <th>PDF</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($facturas)) {?>
                  <tr role="row" class="odd">
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                  </tr>
                <?php }else{ ?>
                <?php while($resu = mysqli_fetch_assoc($facturas)){ ?>
                    <tr role="row" class="odd">
                      <td><?php $idFactura=$resu['ID_FACTURA']; echo ($resu['FOLIO']); ?></td>
                      <td><?php echo($resu['FECHA_FACTURA']) ?></td>
                      <td>
                        <a title="abrir detalle" onclick="abrirSurtimientoPDF(<?php echo $idFactura; ?>);" style="cursor: pointer;">
                          <i class="fas fa-external-link-alt"></i>Abrir
                        </a>
                      </td>
                      <td>
                        <?php if ($resu['FILE_FACTURA']=='FOUND') { ?>
                          <a title="Subir Factura" onclick="subirFactura(<?php echo $idFactura; ?>);" style="cursor: pointer;">
                            <i class="fas fa-cloud-upload-alt"></i>Subir
                          </a>
                        <?php }else{ ?>
                          <a title="abrir pdf" onclick="abrirFacturaPDF('<?php echo $resu['FILE_FACTURA']; ?>');" style="cursor: pointer;">
                            <i class="fas fa-external-link-alt"></i>
                          </a>Abrir
                        <?php } ?>
                      </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
              </table>
            </div>

          </div>
				</div>
			</div>
        </div>          
          <!-- /.card -->
     </div>
    </section>
</div>
<div id="reporteTicket" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content border-primary">
      <div class="modal-header">
        <h3>Generar Reporte de Dinero General</h3>
        <button id="closeButton" type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body bg-primary border-primary">
        <div class="col-sm-12">
          <div class="row">
            <div class="col-8 col-sm-6">
              <label for="nombreLabel">Fecha Inicio: </label>
              <input type="date" class="form-control" id="fechaInicio">
            </div>
            <div class="col-8 col-sm-6">
              <label for="nombreLabel">Hora Inicio: </label>
              <input type="time" class="form-control " id="horaInicio">
            </div>
            <div class="col-8 col-sm-6">
              <label for="nombreLabel">Fecha Fin: </label>
              <input type="date" class="form-control" id="fechaFin">
            </div>
            <div class="col-8 col-sm-6">
              <label for="nombreLabel">Hora Fin: </label>
              <input type="time" class="form-control " id="horaFin">
            </div>
          </div>
        </div>
      </div>
          
                
      <div class="modal-footer" id="modal-footer">
        <button id="btnReporte" type="button" class="btn btn-default" onclick="reporteTickets()">Generar Reporte</button>
        <button onclick="limpiarModal('reporte');" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="addTonerModal" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content border-primary">
      <div class="modal-header">
        <h3>Toners</h3>
        <button id="closeButton" onclick="limpiarModal('toner');" type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body bg-primary border-primary">
        <div class="col-sm-12">
          <div class="row">
            <div class="col-8 col-sm-4">
              <label for="nombreLabel">Nombre del Toner: </label>
              <input type="text" class="form-control " id="nombre" placeholder="Escriba el Nombre del Almacen">
            </div>
            <div class="col-8 col-sm-4">
              <label for="nombreLabel">Modelo: </label>
              <input type="text" class="form-control " id="modelo" placeholder="Escriba el Modelo">
            </div>
            <div class="col-8 col-sm-4">
              <label for="nombreLabel">Descripcion: </label>
              <input type="text" class="form-control " id="descripcion" placeholder="Escriba la Descripcioón">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer" id="modal-footer">
        <button id="btnToner" onclick="addToner();" type="button" class="btn btn-default">Agregar Toner</button>
        <button onclick="limpiarModal('toner');" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="addSalidaModal" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content border-primary">
      <div class="modal-header">
        <h3>Toners</h3>
        <button id="closeButton" onclick="limpiarModal('salida');" type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body bg-primary border-primary">
        <div class="col-sm-12">
          <div class="row">
            <div class="col-8 col-sm-10">
              <input type="hidden" id="tonerHiden">
              <label for="nombreLabel">Descripción de la Salida: </label>
              <input type="text" class="form-control " id="descripcionSalida" placeholder="Escriba Una Descripción">
            </div>
            <div class="col-8 col-sm-2">
              <label for="nombreLabel">Cantidad: </label>
              <input type="number" class="form-control " id="cantidadSalida">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer" id="modal-footer">
        <button id="btnSalida" type="button" class="btn btn-default">Agregar Salida</button>
        <button onclick="limpiarModal('salida');" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="addFacturaModal" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content border-primary">
      <div class="modal-header">
        <h3>Agregar Factura</h3>
        <button id="closeButton" onclick="limpiarModal('factura');" type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body bg-primary border-primary">
        <div class="col-sm-12">
          <div class="row">
          	<div class="col-8 col-sm-4">
              <label for="nombreLabel">Número de factura: </label>
              <input type="text" class="form-control " id="folioFactura" placeholder="Escriba el número de factura">
            </div>
            <div class="col-8 col-sm-4">
              <label for="nombreLabel">Fecha de factura: </label>
              <input type="date" class="form-control " id="fechaFac">
            </div>
            <div class="col-8 col-sm-2">
              <label for="nombreLabel">Subtotal: </label>
              <input type="text" class="form-control " id="subtotalFactura" onkeyup="calcular()" placeholder="Escriba el subtotal de la factura">
            </div>
            <div class="col-8 col-sm-2">
              <label for="nombreLabel">IVA: </label>
              <input type="text" class="form-control " id="ivaFactura" disabled="true">
            </div>
            <div class="col-8 col-sm-2">
              <label for="nombreLabel">Total: </label>
              <input type="text" class="form-control " id="totalFactura" disabled="true">
            </div>
          	<div class="col-8 col-sm-4">
              <div class="form-group">
                <label for="selectFromControlSelect">Toner</label>
                <select id="toner" class="form-control">
                  <option value="0">Seleccionar</option>
                </select>
              </div>
            </div>
            <div class="col-8 col-sm-2">
              <label for="nombreLabel">Cantidad: </label>
              <input type="number" class="form-control " id="cantidad" placeholder="Escriba la cantidad">
            </div>
            <div class="col-8 col-sm-1">
            	<a style="cursor: pointer;" onclick="agregarTon()" class="nav-link">
              	<i class="nav-icon fas fa-plus-circle fa-2x"></i>
            	</a>
            </div>
            <div class="col-8 col-sm-12" id="conten">
            	
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer" id="modal-footer">
        <button id="btnToner" onclick="addFactura();" type="button" class="btn btn-default">Agregar Factura</button>
        <button onclick="limpiarModal('factura');" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
	$(function() {
    $('#detalleToner').bootstrapTable({
      "pagination": true
    });
  });
  $(function() {
    $('#toners').bootstrapTable({
      "pagination": true
    });
  });
  $(function() {
    $('#facturas').bootstrapTable({
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