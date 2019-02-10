<?php 
	require_once("..".DIRECTORY_SEPARATOR."cdn".DIRECTORY_SEPARATOR."config.php");
	require_once(MAIN.DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."Router".DIRECTORY_SEPARATOR."Router.php");
	require_once(MAIN.DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."Database".DIRECTORY_SEPARATOR."DB.php");

	session_name(SESSION_NAME);
	session_start();

	Router::setGet($_GET);
	$_SESSION['logged'] = (isset($_SESSION['logged'])) ? $_SESSION['logged'] : false;

	if ($_SESSION['logged']) {
		include "painel.php";
	}
	else {
		include HOMEPAGE;
	}
?>