<?php
	require_once '../class/subdoc.php';
	$obj = new Subdoc();
	$obj->delete($_GET["id"]);
?>