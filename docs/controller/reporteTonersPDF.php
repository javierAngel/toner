<?php 
include_once "../conf/autoload.php";

\conf\Autoload::run();



$con = new \model\conexion();
$reporte = new \model\surtimiento($con);

$inicio=$_GET['FI'];
$fin=$_GET['FF'];

$rs = $reporte->reporteTonersPDF($inicio,$fin,$_GET['almacen'],$_GET['toner']);

if ($inicio=="") {
	$inicio=strftime("%d de %B del %Y");
}

if ($fin=="") {
	$fin=strftime("%d de %B del %Y");
}
session_start();

setlocale(LC_TIME,"es_ES");

$pdf="<html>

		<head>
			<title>Toner Entregados</title>
			<link rel='stylesheet' href='../layout/css/bootstrap.css'>
			<style type='text/css'> thead:before, thead:after { display: none; } tbody:before, tbody:after { display: none; } </style>

		</head>

		<body style='margin-left: 1.5cm; margin-right: 30px; margin-bottom: 0.5cm; margin-top: 0.5cm;'>
			<div>
					<table class='table table-bordered table-striped table-filter'>
						<thead>
							<tr>
								<th class='text-center' style='width: 100px;'><img src='../img/logo.png' style='width: 150px;'></th>
								<th class='text-center' style='font-size: 18px;'>SUMIMSA<br>Reporte General de Toners Entregados<br>Departamento de Sistemas</th>
								<th class='text-center' style='width: 100px;'><img src='../img/icono.png' style='width: 70px;'></th>
							</tr>
						</thead>
					</table>
				<p class='text-right' style='font-size: 15px;'>Fecha de Emisión: ".strftime("%d de %B del %Y")."</p>
			</div>
			<div>
				<p class='text-left' style='font-size: 15px; float: left;'>Fecha de Inicio: $inicio</p>
				<p class='text-right' style='font-size: 15px;'>Fecha de Fin: $fin</p>
			</div>
			<table style='margin: auto;' width='100%' cellpadding='2' class='table table-bordered'>
				<tr>
					<th>Folio interno</th>
					<th>Almacen</th>
					<th>Usuario</th>
					<th>Toner</th>
					<th>Cantidad</th>
					<th>Fecha de Entrega</th>
				</tr>";
				$total=0;
while ($r = mysqli_fetch_assoc($rs)) {
	$total+=$r['CANTIDAD'];
	$tem=$r['CANTIDAD'];
	$pdf.="<tr>
						<td>".$r['ID_SURTIMIENTO']."</td>
						<td>".$r['ALMACENS']."</td>
						<td>".$r['PERSONA']."</td>
						<td>".$r['TONERS']."</td>
						<td>".$tem."</td>
						<td>".$r['FECHA']."</td>
				 </tr>";
}

		$pdf.="
			<tr>
				<td>--</td>
				<td>--</td>
				<td>--</td>
				<td>--</td>
				<td>--</td>
				<td>--</td>
			</tr>
			<tr>
				<td></td>
				<th></th>
				<td>--</td>
				<th>Total de Toners</th>
				<td>$total</td>
				<td>--</td>
			</tr>
			</table>
			<p class='text-center' style='font-size: 15px;'>Verificado por</p>
			<br>
			<hr size='5' width='40%' style='color: red;'>
			<p class='text-center' style='font-size: 15px;'>".$_SESSION['nombreUsuario']." ".$_SESSION['apellidosUsuario']."</p>
		</body>

		</html>

		";
// require_once ('../lib/dompdf/dompdf_config.inc.php');

//   $dompdf = new DOMPDF();

//   $dompdf->set_paper('A4', 'portrait');

//   $dompdf->set_option('enable_html5_parser', TRUE);

//   $dompdf->load_html($pdf);

//   $dompdf->render();

//   $pdf      = $dompdf->output();

//   $filename = 'ReporteToners'.strftime("%d de %B del %Y");

//   $dompdf->stream($filename . ".pdf", array('Attachment' => 0));

echo $pdf;
 ?>