<?php 
namespace view;
include_once "../conf/autoload.php";
	\conf\Autoload::run();
	
	session_start();
	//isset($_SESSION['usuario'])
	if(isset($_SESSION['usuario'])){
		$con = new \model\conexion();
		$user = new \model\usuarios($con);
		$toner = new \model\toner($con);
		$surtimiento = new \model\surtimiento($con);

		$datos = $surtimiento->consultarDetalle();

		$toners = $toner->tonerSinExistencia();
		
		$permisos = $user->mostrarPermisosUser($_SESSION['usuario']);
		$p = array();
		while($dp = $permisos->fetch_assoc()){
			$p[$dp['CLAVE']] = $dp['DESCRIPCION'];
		}
		$_SESSION['permisos'] = $p;

		include_once('../layout/principal.php');
	}else{
		require_once("../layout/login_2.php");
	}

 ?>