<?php
namespace view;
include_once "../conf/autoload.php";
	\conf\Autoload::run();

session_start();
	//isset($_SESSION['usuario'])
	if(isset($_SESSION['usuario'])){
		$con = new \model\conexion();
		$permisos = new \model\permisos($con);

		$datos = $permisos->consultarPermisos();

		include_once('../layout/permisos.php');
	}else{
		require_once("../layout/login_2.php");
	}

 ?>