<?php 	

namespace view;

	include_once "../conf/autoload.php";
	\conf\Autoload::run();
	
	session_start();
	//isset($_SESSION['usuario'])
	if(isset($_SESSION['usuario'])){
		header("Location: principal.php");
	}else{
		require_once("../layout/login_2.php");
	}

?>