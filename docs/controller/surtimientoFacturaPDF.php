<?php 
include_once "../conf/autoload.php";

\conf\Autoload::run();

$con = new \model\conexion();
$factura = new \model\facturas($con);
session_start();

setlocale(LC_TIME,"es_ES");

$id = $_GET['id'];

$res = $factura->consultarFactura($id);
$res = mysqli_fetch_assoc($res);

$rs = $factura->facturasToners($id);

$pdf="<html>

		<head>
			<title>Facturas</title>
			<link rel='stylesheet' href='../layout/css/bootstrap.css'>
			<style type='text/css'> thead:before, thead:after { display: none; } tbody:before, tbody:after { display: none; } </style>

		</head>

		<body style='margin-left: 2.5cm; margin-right: 2.5cm; margin-bottom: 2.5cm; margin-top: 2.5cm;'>
			<div>
				<p class='text-center' style='font-size: 20px;'>Copia interna de Factura</p>
				<p class='text-right' style='font-size: 15px;'>Fecha de Emisión: ".$res['FECHA']."</p>
			</div>
			<div>
				<p class='text-left' style='font-size: 15px; float: left;'>Folio de la Factura: ".$res['FOLIO']."</p>
				<p class='text-right' style='font-size: 15px;'>Fecha de Factura: ".$res['FECHA_FACTURA']."</p>
			</div>
			<table style='margin: auto;' width='100%' cellpadding='2' class='table table-bordered'>
				<tr>
					<th>Toner</th>
					<th>Cantidad</th>
				</tr>";
				$total=0;
while ($r = mysqli_fetch_assoc($rs)) {
	$pdf.="<tr>
						<td>".$r['NOMBRE']."</td>
						<td>".$r['CANTIDAD']."</td>
				 </tr>";
}

		$pdf.="
			</table>
			<div>
				<p class='text-right' style='font-size: 15px;'>Subtotal: &nbsp;&nbsp;$".$res['SUBTOTAL']."</p>
				<p class='text-right' style='font-size: 15px;'>IVA: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$".$res['IVA']."</p>
				<p class='text-right' style='font-size: 15px;'>Total: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$".$res['TOTAL']."</p>
			</div>
		</body>

		</html>

		";
require_once ('../lib/dompdf/dompdf_config.inc.php');

  $dompdf = new DOMPDF();

  $dompdf->set_paper('A4', 'portrait');

  $dompdf->set_option('enable_html5_parser', TRUE);

  $dompdf->load_html($pdf);

  $dompdf->render();

  $pdf      = $dompdf->output();

  $filename = 'factura'.strftime("%d de %B del %Y");

  $dompdf->stream($filename . ".pdf", array('Attachment' => 0));


 ?>