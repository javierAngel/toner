<?php
namespace view;
include_once "../conf/autoload.php";
	\conf\Autoload::run();

session_start();
	//isset($_SESSION['usuario'])
	if(isset($_SESSION['usuario'])){
		$con = new \model\conexion();
		$surtimiento = new \model\surtimiento($con);

		$datos = $surtimiento->consultarDetalle();

		include_once('../layout/surtimiento.php');
	}else{
		require_once("../layout/login_2.php");
	}

 ?>