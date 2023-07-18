<?php 

$opcion = $_GET['opcion'];

session_start();
session_destroy();

if ($opcion==1) {
	require_once("../layout/login_2.php");
}
 ?>