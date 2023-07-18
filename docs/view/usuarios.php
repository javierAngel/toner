<?php
namespace view;
include_once "../conf/autoload.php";
	\conf\Autoload::run();

session_start();
	//isset($_SESSION['usuario'])
	if(isset($_SESSION['usuario'])){
		$con = new \model\conexion();
		$usuario = new \model\usuarios($con);

		$datos = $usuario->mostrarUser();

		include_once('../layout/usuarios.php');
	}else{
		require_once("../layout/login_2.php");
	}

 ?>