<?php
	require_once '../class/subactas.php';
	$obj = new Subactas();
	$obj->delete($_GET["id"]);
?>