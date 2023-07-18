<?php 

	include_once "../conf/autoload.php";

	\conf\Autoload::run();
	$con = new \model\conexion();



	$surtimiento = new \model\surtimiento($con);

	$rs = $surtimiento->surtimientoPDF($_GET['id']);

	$p = mysqli_fetch_assoc($rs);

		$pdf="<!DOCTYPE html>

		<html>

		<head>

			<meta charset='utf-8'>

			<meta http-equiv='X-UA-Compatible' content='IE=edge'>

			<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

			<title>Tuminsa Detalle Surtimiento</title>

			<link rel='stylesheet' href='../layout/css/bootstrap.css'>
			<style type='text/css'> thead:before, thead:after { display: none; } tbody:before, tbody:after { display: none; } </style>

		</head>

		<body style='margin-left: 2cm; margin-right: 2cm; margin-bottom: 2.54cm; margin-top: 1.5cm;'>

			<div class='conteiner col-xs-12' style='font-size: 10px;'>

				<div>
					<table class='table table-bordered table-striped table-filter'>
						<thead>
							<tr>
								<th class='text-center' style='width: 100px;'><img src='../img/logo.png' style='width: 150px;'></th>
								<th class='text-center' style='font-size: 18px;'>SUMIMSA<br>VALE DE SURTIMIENTO<br>Departamento de Sistemas</th>
								<th class='text-center' style='width: 100px;'><img src='../img/icono.png' style='width: 70px;'></th>
							</tr>
						</thead>
					</table>
				</div>

				<div>
					<p class='text-right' style='font-size: 14px; margin-bottom: 0px; margin-top: 5px;'>Fecha: ".$p['FECHA']."</p>

				</div><br><br>
				<div>
					<p class='text-justify' style='font-size: 15px; margin-bottom: 0px; margin-top: 5px;'>La ".$p['ALMACENS'].", manifiesta que para el debido cumplimiento de las funciones que tienen enconmendadas la Empresa: Suministros Marinos e Industriales de México, S.A. de C.V., sele proporcia el día ".$p['FECHA'].", el siguiente equipo de trabajo, para ser usado única y exclusivamente con fines laborales.</p><br><br>
					<p style='font-size: 15px; margin-bottom: 0px; margin-top: 5px;'><b>Entiendo que somos responsables del equipo descrito como sigue, mismo que me proporcionó suministros Marinos e Industriales de México, S.A. DE C.V.</b></p>
					<br>
					<p style='font-size: 13px; margin-bottom: 0px; margin-top: 5px;'><b>Descripción del Equipo</b></p>
					<p style='font-size: 13px; margin-bottom: 0px; margin-top: 5px;'>Descripción de la impresora: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>".$p['IMPRESORA']."</u></p>
					<p style='font-size: 13px; margin-bottom: 0px; margin-top: 5px;'>BD/Localización/Equipo: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>".$p['ALMACENS']."</u></p>
					<p style='font-size: 13px; margin-bottom: 0px; margin-top: 5px;'>Modelo del Toner: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>".$p['MODELO']."</u></p>
				</div>
				<br><br>
				<div>
					<p style='font-size: 13px; margin-bottom: 0px; margin-top: 5px;'><b>Caracteristicas del Equipo</b></p><br>
					<p><b>______________________________________________________________________________________________________________</b></p>
					<p><b>______________________________________________________________________________________________________________</b></p>
				</div>
				<br><br>
				<div>
					<p class='text-justify' style='font-size: 13px; margin-bottom: 0px; margin-top: 5px;'>El usuario se obliga a utilizar el equipo de manera adecuada, además deberá reportar a la administracion de la 'La Empresa' cualquier animalía o dañoque observe en su equipo. Cuando el equipo se dañe por causas imputables al usuario generadas por su uso inadecuado, el costo de reposición o las reparaciones respectivas serán cubiertas por el usuario.</p><br><br>
				</div>
				<br><br><br><br>
				<div>
					<p style='float: left;'><b>________________________________________</b></p><p style='margin-left: 400px;'><b>________________________________________</b></p>
					<p style='float: left; margin-left: 95px;'><b>".$p['ALMACENNOMBRE']."</b></p><p style='margin-left: 440px;'><b>".$p['USUARIO']."</b></p>
				</div>
				<div>
				</div>
			</div>

		</body>

		</html>

		";

require_once ('../lib/dompdf/dompdf_config.inc.php');



  $dompdf = new DOMPDF();

  $dompdf->set_paper('a4', 'portrait');

  $dompdf->set_option('enable_html5_parser', TRUE);

  $dompdf->load_html($pdf);

  $dompdf->render();

  $pdf      = $dompdf->output();

  $filename = 'Detalle Surtimiento';

  $dompdf->stream($filename . ".pdf", array('Attachment' => 0));



?>