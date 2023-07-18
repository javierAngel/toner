<?php 	

namespace view;

	include_once "docs/conf/autoload.php";
	\conf\Autoload::run();
	
	session_start();
	//isset($_SESSION['usuario'])
	if(isset($_SESSION['usuario'])){
		header("Location: docs/view/principal.php");
	}else{
		require_once("docs/layout/login.php");
	}

?>