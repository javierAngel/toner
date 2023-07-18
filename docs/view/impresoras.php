<?php
namespace view;
include_once "../conf/autoload.php";
	\conf\Autoload::run();

session_start();
	//isset($_SESSION['usuario'])
	if(isset($_SESSION['usuario'])){
		$con = new \model\conexion();
		$impresora = new \model\impresoras($con);

		$datos = $impresora->consultarImpresorasToner();

		$datosColor = $impresora->consultarImpresorasColor();

		$datosColorToner = $impresora->consultarImpresorasColorToner();

		include_once('../layout/impresoras.php');
	}else{
		require_once("../layout/login_2.php");
	}

 ?>