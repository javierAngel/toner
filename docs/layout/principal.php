<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Tomimsa</title>
  <link rel="shortcut icon" href="https://www.sumimsa.com.mx/img/favicon.ico">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

   <!--Font Awesome Icons -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="../../plugins/fullcalendar/main.min.css">
  <link rel="stylesheet" href="../../plugins/fullcalendar-daygrid/main.min.css">
  <link rel="stylesheet" href="../../plugins/fullcalendar-timegrid/main.min.css">
  <link rel="stylesheet" href="../../plugins/fullcalendar-bootstrap/main.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse" id="body">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a style="cursor: pointer;" onclick="recargar();" class="nav-link">Home</a>
      </li>
     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="btn btn-info btn-sm" onclick="logout();">Cerrar Sesion</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a  onclick="recargar();" style="cursor: pointer;" class="brand-link">
      <img src="../img/logoIRAN.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!--img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"-->
        </div>
        <div class="info">
          <a href="#" class="d-block">Bienvenido <?php echo $_SESSION['nombreUsuario'] ?></a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <?php if($_SESSION['permisos']['US-PE'] != null){ ?>
          <!--items usuarios-->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Usuarios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if($_SESSION['permisos']['US-PE-1'] != null){ ?>
              <li class="nav-item">
                <a onclick="ajax_global('../view/usuarios.php','contenido');" style="cursor: pointer;" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                    <p>Ver Usuarios</p>
                </a>
              </li>
              <?php } ?>
              <?php if($_SESSION['permisos']['US-PE-2'] != null){ ?>
              <li class="nav-item">
                <a onclick="ajax_global('../view/permisos.php','contenido');" style="cursor: pointer;" class="nav-link">
                  <i class="nav-icon fas fa-ruler"></i>
                  <p>Ver Permisos</p>
                </a>
              </li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
			<!--fin items usuarios-->
      <!--items Almacen-->
          <?php if ($_SESSION['permisos']['ALM'] != null) { ?>
          <li class="nav-item">
            <a onclick="ajax_global('../view/almacen.php','contenido');" style="cursor: pointer;" class="nav-link">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Almacenes
              </p>
            </a>
          </li>
        <?php } ?>
        <!--fin items Almacen-->
        <!--items Toners-->
          <?php if ($_SESSION['permisos']['TON'] != null) { ?>
          <li class="nav-item">
            <a onclick="ajax_global('../view/toner.php','contenido');" style="cursor: pointer;" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Toners
              </p>
            </a>
          </li>
        <?php } ?>
        <!--fin items Toners-->
        <!--items Detalle Surtimiento-->
          <?php if ($_SESSION['permisos']['DET-SURT'] != null) { ?>
          <li class="nav-item">
            <a onclick="ajax_global('../view/surtimiento.php','contenido');" style="cursor: pointer;" class="nav-link">
              <i class="nav-icon fas fa-truck-loading"></i>
              <p>
                Detalle de Surtimiento
              </p>
            </a>
          </li>
        <?php } ?>
        <!--fin items Detalle Surtimiento-->
        <!--items Detalle Surtimiento-->
          <?php if ($_SESSION['permisos']['IMP'] != null) { ?>
          <li class="nav-item">
            <a onclick="ajax_global('../view/impresoras.php','contenido');" style="cursor: pointer;" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Impresoras
              </p>
            </a>
          </li>
        <?php } ?>
        <!--fin items Detalle Surtimiento-->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


</div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  	<section class="content" id="contenido">
  		<!-- Content Header (Page header) -->
		    <div class="content-header">
		      <div class="container-fluid">
		        <div class="row mb-2">
		          <div class="col-sm-6">
		            <h1 class="m-0 text-dark">Información General</h1>
		          </div><!-- /.col -->
		          <div class="col-sm-6">
		            <ol class="breadcrumb float-sm-right">
		              <li class="breadcrumb-item"><a href="#">Home</a></li>
		              <li class="breadcrumb-item active"><a data-toggle="modal" data-target="#" style="cursor: pointer;" ><span class='badge bg-blue'>Principal</span></a></li>
		            </ol>
		          </div><!-- /.col -->
		        </div><!-- /.row -->
		      </div><!-- /.container-fluid -->
		    </div>
		    <!-- /.content-header -->

		    <!-- Main content -->
		    <section class="content">
		      <div class="container-fluid">
		        <!-- Info boxes -->
		        <div class="row">
		          
		         
		          <!-- /.col -->

		          <!-- fix for small devices only -->
		          <div class="clearfix hidden-md-up"></div>

		         
		        <!-- /.row -->

		        <!-- /.row -->
		      </div><!--/. container-fluid -->
		    </section>
		    <!-- /.content -->
		    <section class="content">
          <div class="row">
            <div class="col-sm-6">
              <div class="col">
                <div class="card">
                  <div class="card-header">
                    <div class="col" style="float: left;">
                      <h3 class="card-title">Surtimiento</h3>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="col-sm-12">
                      <div class="row">
                        <div class="col-8 col-sm-4">
                          <div class="form-group">
                            <label for="selectFromControlSelect">Almacen: </label>
                              <select id="almacen" class="form-control">
                                <option value="0">Seleccionar</option>
                              </select>
                          </div>
                        </div>
                        <div class="col-8 col-sm-4">
                          <div class="form-group" id="tonerBK">
                            <label for="selectFromControlSelect">Toner: </label>
                              <input type="text" class="form-control " id="toner" disabled="true">
                              <input type="hidden" id="tonerHidden">
                              <input type="hidden" id="tonerColorHidden" value="0">
                          </div>
                          <div class="form-group" id="tonerColor" hidden="true">
                            <label for="selectFromControlSelect">Toner de Color: </label>
                              <select id="tonerColorSelect" class="form-control">
                                <option value="0">Seleccionar</option>
                              </select>
                          </div>
                          <div class="form-group" id="accesorioImpresora" hidden="true">
                            <label for="selectFromControlSelect">Accesorio: </label>
                              <select id="accesorioImpresoraSelect" class="form-control">
                                <option value="0">Seleccionar</option>
                              </select>
                          </div>
                        </div>
                        <div class="col-8 col-sm-4">
                          <div class="form-group">
                            <label for="selectFromControlSelect">Fecha de Surtimiento: </label>
                              <input type="date" class="form-control " id="fechaSurt">
                          </div>
                        </div>
                        <div class="col-8 col-sm-3">
                          <button class="btn btn-info" onclick="guardarSurtimiento()" id="btnGuardar">Guardar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.col -->

              <div class="col">
                <div class="card">
                  <div class="card-header">
                    <div class="col" style="float: right;">
                      <h3 class="card-title">Detalle Surtimiento</h3>
                    </div>
                  </div>
                  <div class="card-body">
                    <table data-filter-control="true" data-show-search-clear-button="true" id="surt" class="table table-bordered table-striped table-filter">
                        <thead>
                        <tr>
                          <th data-field="nombre" data-filter-control="input">Fecha</th>
                          <th data-field="toner" data-filter-control="input">Almacen</th>
                          <th data-field="descripcion" data-filter-control="input">Persona Encargada</th>
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
                          <?php while($re = mysqli_fetch_assoc($datos)){ ?>
                              <tr role="row" class="odd">
                                <td><?php echo ($re['FECHA']); ?></td>
                                <td><?php echo($re['ALMACENS']) ?></td>
                                <td><?php echo($re['PERSONA']) ?></td>
                              </tr>
                              <?php } ?>
                        <?php } ?>
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>

              <div class="col">
                <div class="card">
                  <div class="card-header">
                    <div class="col" style="float: right;">
                      <h3 class="card-title">Toners sin Existencia en almacen</h3>
                    </div>
                  </div>
                  <div class="card-body">
                    <table data-filter-control="true" data-show-search-clear-button="true" id="toners" class="table table-bordered table-striped table-filter">
                        <thead>
                        <tr>
                          <th data-field="nombre" data-filter-control="input">Nombre</th>
                          <th data-field="toner" data-filter-control="input">Modelo</th>
                          <th data-field="descripcion" data-filter-control="input">Descripción</th>
                          <th data-field="existencia" data-filter-control="input">Existencia</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (empty($toner)) {?>
                          <tr role="row" class="odd">
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
                                    <?php  echo('<span class="badge badge-danger" style="cursor: pointer;">'.$results['EXISTENCIA'].'</span>');  ?>
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
            <div class="col-sm-6">
              <div class="card">
                <div class="card-header">
                  <div class="col" style="float: left;">
                    <h3 class="card-title">Existencia</h3>
                  </div>
                </div>
                <div class="card-body">
                  <div id="piechart"></div>
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <div class="col" style="float: left;">
                    <h3 class="card-title">Toners Entregados Mensual</h3>
                  </div>
                </div>
                <div class="card-body">
                  <div id="piechart1"></div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.row -->
        </section>
  	</section>
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; AJIC</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
    </div>
  </footer>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="../../dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="../../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../../plugins/raphael/raphael.min.js"></script>
<script src="../../plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../../plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->

<script src="../../docs/js/funciones.js?3"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.3.1/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.3.0/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4/locales-all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@4.3.0/main.min.js"></script>
<script src="../../plugins/fullcalendar-interaction/main.min.js"></script>
<script src="../../plugins/fullcalendar-bootstrap/main.min.js"></script>

<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/extensions/filter-control/bootstrap-table-filter-control.min.js"></script>
<script>
function agregarProducto() {
	if ($('#inputSelect').val()=="" || $('#cantidad').val()=="") {
		Swal.fire(
	  'Especifique el Producto',
	  'Asegurese de seleccionar un Producto en la lista',
	  'error'
	)
	}else{
		var id,cantidad;
  	id='"'+$('#inputSelect').val()+'"';
  	cantidad=$('#cantidad').val();
    $.ajax({
      url: '../controller/inventarioProductos.php',
      type: 'POST',
      dataType: 'JSON',
      data: {
        accion: 'consultProducto',
        idProducto: id
      },
    })
    .done(function(data) {
      // console.log(parseInt(data[3])<parseInt(cantidad));
      if (parseInt(data[3])<parseInt(cantidad)) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Revise la existencia del Producto',
        });
      }else{
        var temp=cantidad*data[2];
        $('#row').append("<div class='col-8 col-sm-1 "+data[0]+"' style='margin-right: 10px;'><span class='badge badge-success' onclick='eliminarProducto("+data[0]+")' style='cursor: pointer; font-size:15px;'>"+cantidad+" "+data[1]+" $"+temp+" "+data[0]+"</span></div>");
        // console.log(temp);
        var total=parseFloat($('#total').val());
        total+=temp;
        $('#total').val(total);
        $('#inputSelect').val("");
        $('#cantidad').val("");
      }
    })
    .fail(function() {
      console.log("error");
    });
	}
}
function eliminarProducto(id) {
  $('.'+id+' span').each(function(){
    var temp=$(this).text().split(" "), total;
    temp=parseFloat(temp[2].substring(1));
    total=$('#total').val()-temp;
    $('#total').val(total);
    $("div").remove("."+id);
  });
}
var idleTime = 0;
$(document).ready(function () {
    //Increment the idle time counter every minute.
    var idleInterval = setInterval(timerIncrement, 60000); // 1 minute

    //Zero the idle timer on mouse movement.
    $(this).mousemove(function (e) {
        idleTime = 0;
    });
    $(this).keypress(function (e) {
        idleTime = 0;
    });
    function almacen(){
      $.ajax({
        url: '../controller/almacen.php',
        type: 'POST',
        dataType: 'JSON',
        data: {
          accion: 'consultAlm'
        },
      })
      .done(function(data) {
        //console.log(data);
        $('#almacen').empty();
        $('#almacen').append("<option value='0'>Seleccionar</option>");
        $.each(data, function( index, value ) {
              $('#almacen').append("<option value='" + index + "'" + ">" + value +"</option>");
        });
      })
      .fail(function() {
        Swal.fire(
            'Error!',
            'Intente de nuevo',
            'error'
          );
      });
      
    }

    function toner(){
      $.ajax({
        url: '../controller/toner.php',
        type: 'POST',
        dataType: 'JSON',
        data: {
          accion: 'consultTon'
        },
      })
      .done(function(data) {
        //console.log(data);
        $('#toner').empty();
        $('#toner').append("<option value='0'>Seleccionar</option>");
        $.each(data, function( index, value ) {
              $('#toner').append("<option value='" + index + "'" + ">" + value +"</option>");
        });
      })
      .fail(function() {
        Swal.fire(
            'Error!',
            'Intente de nuevo',
            'error'
          );
      });
      
    }

    toner();
    almacen();

     $('#almacen').on('change',function(){
      listSurtimiento($('#almacen').val());
    });

     function listSurtimiento(id) {
        if(id==0){
          $('#toner').val("");
          $('#tonerHidden').val("");
        }else{
          $.ajax({
            url: '../controller/almacen.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
              accion: 'listSurtimientos',
              idAlm: id
            },
          })
          .done(function(data) {
           	// console.log(data);
            if (data==null) {
              Swal.fire(
                'Error!',
                'El Toner no tiene Existencia',
                'error'
              );
            }if (data.length>=3){
              $('#tonerBK').attr('hidden', 'true');
              $('#accesorioImpresora').attr('hidden', 'true');
              $('#tonerColor').removeAttr('hidden');
              $('#tonerColorSelect').empty();
              $('#tonerColorSelect').append('<option value="0">Seleccionar</option>');
              $.each(data, function( index, value ) {
                $('#tonerColorSelect').append("<option value='" + value.ID + "'" + ">" + value.NOMBRE +"</option>");
              });
              $('#tonerColorHidden').val(1);
            }else if(data.length==1){
              $('#toner').val(data[0]['NOMBRE']);
              $('#tonerHidden').val(data[0]['ID']);
              $('#tonerBK').removeAttr('hidden');
              $('#tonerColor').attr('hidden', 'true');
              $('#accesorioImpresora').attr('hidden', 'true');
              $('#tonerColorHidden').val(0);
            }else if(data.length==2){
              $('#tonerBK').attr('hidden', 'true');
              $('#tonerColor').attr('hidden', 'true');
              $('#accesorioImpresora').removeAttr('hidden');
              $('#accesorioImpresoraSelect').empty();
              $('#accesorioImpresoraSelect').append('<option value="0">Seleccionar</option>');
              $.each(data, function( index, value ) {
                $('#accesorioImpresoraSelect').append("<option value='" + value.ID + "'" + ">" + value.NOMBRE +"</option>");
              });
              $('#tonerColorHidden').val(2);
            }else{
            	$('#tonerBK').removeAttr('hidden');
            	$('#tonerColor').attr('hidden', 'true');
            	$('#accesorioImpresora').attr('hidden', 'true');
            	$('#toner').val("SIN EXISTENCIA");
              	$('#tonerHidden').val("");
            }
          })
          .fail(function() {
            console.log("error");
          });
        }       
     }
});

function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime > 14) { // 15 minutes
        window.location.assign("../controller/logout.php?opcion=1");
    }
}

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Language', 'Rating'],
      <?php
      if(TRUE){
        include_once "../conf/autoload.php";
          \conf\Autoload::run();
        $con = new \model\conexion();
        $toner = new \model\toner($con);

        $toners = $toner->toners();
          while($row = $toners->fetch_assoc()){
            echo "['".$row['NOMBRE']."', ".$row['EXISTENCIA']."],";
          }
      }
      ?>
    ]);
    
    var options = {
        title: 'Existencia de Toner',
        width: 700,
        height: 500,
        pieSliceText: 'value',
    };
    
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);

    var datas = google.visualization.arrayToDataTable([
      ['Language', 'Rating'],
      <?php
      if(TRUE){
        include_once "../conf/autoload.php";
          \conf\Autoload::run();
        $con = new \model\conexion();
        $toner = new \model\toner($con);

        $toners = $toner->cantidadTonersEntregados();
          while($row = $toners->fetch_assoc()){
            echo "['".$row['ALMACENS']."', ".$row['CANTIDAD']."],";
          }
      }
      ?>
    ]);
    
    var option = {
        title: 'Toners Entregados en este mes',
        width: 700,
        height: 500,
        pieSliceText: 'value',
    };

    var charts = new google.visualization.PieChart(document.getElementById('piechart1'));
    charts.draw(datas, option);
}
$(function() {
    $('#toners').bootstrapTable({
      "pagination": true
    });
    $('#surt').bootstrapTable({
      "pagination": true
    });
  });
</script>
</body>
</html>
