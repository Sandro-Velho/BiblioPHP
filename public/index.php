<?php 
	require_once("..".DIRECTORY_SEPARATOR."cdn".DIRECTORY_SEPARATOR."config.php");
	require_once(MAIN.DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."Router".DIRECTORY_SEPARATOR."Router.php");
	require_once(MAIN.DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."Database".DIRECTORY_SEPARATOR."DB.php");
	require_once(MAIN.DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."Biblio".DIRECTORY_SEPARATOR."Biblio.php");

	session_name(SESSION_NAME);
	session_start();

	Router::setGet($_GET);
	$_SESSION['logged'] = false;
	$_SESSION['logged'] = (isset($_SESSION['logged'])) ? $_SESSION['logged'] : false;

	if ($_SESSION['logged']) {
		include "painel.php";
		exit();
	}
	if (!empty(Router::getController()) && 
		!empty(Router::getMethod()) && 
		Router::getController() != "Main" && 
		Router::getMethod() != "index") {
		$controllerName = Router::getController();

		$methodName = Router::getMethod();

		$controller = new $controllerName;
		$method = call_user_method($methodName, $controller);
		if (!is_null($method) && $method != false) {
			include "view".DIRECTORY_SEPARATOR.str_replace("Controller", "", $controllerName).DIRECTORY_SEPARATOR.$method.".php";
		}
		exit();
	}
	else {
		include HOMEPAGE;
	}
?>