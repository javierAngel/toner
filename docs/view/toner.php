<?php
namespace view;
include_once "../conf/autoload.php";
	\conf\Autoload::run();

session_start();
	//isset($_SESSION['usuario'])
	if(isset($_SESSION['usuario'])){
		$con = new \model\conexion();
		$toner = new \model\toner($con);
		$factura = new \model\facturas($con);

		$toners = $toner->toners();
		$datosToner = $toner->detalleToner();
		$facturas = $factura->detalle();

		include_once('../layout/toner.php');
	}else{
		require_once("../layout/login_2.php");
	}

 ?>