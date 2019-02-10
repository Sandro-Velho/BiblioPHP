<!DOCTYPE html>
<html>
<head>
	<?php 
		require_once("includes/header.php");
		require_once("includes/footer.php");
	?>
	<title></title>
</head>
<body>
	<?php 
		$controllerName = Router::getController();

		$methodName = Router::getMethod();

		$controller = new $controllerName;
		$method = call_user_method($methodName, $controller);
		if (!is_null($method) && $method != false) {
			include "view".DIRECTORY_SEPARATOR.str_replace("Controller", "", $controllerName).DIRECTORY_SEPARATOR.$method.".php";
		}
	?>
</body>
</html>