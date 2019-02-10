<?php 

class Router {
	private static $pg;

	public static function setGet($get) {
		Router::$pg = (empty($get['pg'])) ? '' : $get['pg'];
	}

	public static function getController() {
		if (!empty(Router::$pg)) {
			if (strstr(Router::$pg, "/")) {
				$aux = explode("/", Router::$pg);
				return $aux[0].'Controller';
			}
			else {
				return Router::$pg.'Controller';
			}
		}
		else {
			return CONTROLLER_DEFAULT;
		}
	}
	public static function getMethod() {
		if (!empty(Router::$pg)) {
			if (strstr(Router::$pg, "/")) {
				$aux = explode("/", Router::$pg);
				if (!empty($aux[1]))
					return $aux[1];
				else {
					return METHOD_DEFAULT;
				}
			}
			else {
				return METHOD_DEFAULT;
			}
		}
		else {
			return METHOD_DEFAULT;
		}
	}

	public static function getParam($index) {
		if (strstr(Router::$pg, "/")) {
			$aux = explode("/", Router::$pg);
			if (!empty($aux[$i+2]))
				return $aux[$i+2];
			else {
				return '';
			}
		}
		else {
			return '';
		}
	}
}


?>