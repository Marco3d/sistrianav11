<?php
	require_once '../class/subdp.php';
	$obj = new Subdp();
	$obj->delete($_GET["id"]);
?>