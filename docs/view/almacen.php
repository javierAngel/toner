<?php
namespace view;
include_once "../conf/autoload.php";
	\conf\Autoload::run();

session_start();
	//isset($_SESSION['usuario'])
	if(isset($_SESSION['usuario'])){
		$con = new \model\conexion();
		$almacen = new \model\almacen($con);

		$datos = $almacen->almacenes();

		include_once('../layout/almacen.php');
	}else{
		require_once("../layout/login_2.php");
	}

 ?>