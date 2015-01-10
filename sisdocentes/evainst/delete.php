<?php
	require_once '../class/subei.php';
	$obj = new Subei();
	$obj->delete($_GET["id"]);
?>