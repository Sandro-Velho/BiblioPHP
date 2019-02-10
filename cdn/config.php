<?php 
define("BIBLIO_VERSION", "1.00"); //Versão
define("PRODUCTION_ENV", 1); //Desenvolvimento em produção
define("HOMOLOGATION_ENV", 2); //Desenvolvimento em homologação
define("LOCAL_ENV", 3); //Desenvolvimento local

setlocale(LC_ALL, "pt_BR", "pt_BR.utf-8", "portuguese"); 
date_default_timezone_set('America/Sao_Paulo');

//ALTERAR A PARTIR DAQUI
define("ROOTNAME", "biblio"); //nome da pasta na raiz
define("MAIN", $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.ROOTNAME); //Define o root
define("CDN", DIRECTORY_SEPARATOR.ROOTNAME.DIRECTORY_SEPARATOR); //caminho para os arquivos css e js
define("ASSETS", DIRECTORY_SEPARATOR.ROOTNAME.DIRECTORY_SEPARATOR."cdn"); //caminho para os arquivos css e jss
define("SESSION_NAME", "BiblioPHP"); //Nome da sessão
define("HOMEPAGE", "homepage.php"); //Arquivo a ser carregado sem sessão
define("ENVIRONMENT_TYPE", LOCAL_ENV); //define o tipo de ambiente
define("CONTROLLER_DEFAULT", "MainController");
define("METHOD_DEFAULT", "index");

//Carrega arquivos CSS
function getCSS($diretorio) {
	while ($arquivo = $diretorio->read()) {
		if ($arquivo != '.' && $arquivo != '..') {
			if (strstr($arquivo, ".css")) {
				$filename = str_replace(MAIN, CDN, $diretorio->path).$arquivo;
				echo '<link rel="stylesheet" type="text/css" href="'.$filename.'">';
			}
			else {
				if (!strstr($arquivo, ".")) {
					$auxDir = dir($diretorio->path.'/'.$arquivo.'/');
					getCSS($auxDir);
				}
			}
		}
	}
}

//Carrega arquivos JS
function getJS($diretorio) {
	while ($arquivo = $diretorio->read()) {
		if ($arquivo != '.' && $arquivo != '..') {
			if (strstr($arquivo, ".js")) {
				$filename = str_replace(MAIN, CDN, $diretorio->path).$arquivo;
				echo '<script type="text/javascript" src="'.$filename.'"></script>';
			}
			else {
				if (!strstr($arquivo, ".")) {
					$auxDir = dir($diretorio->path.'/'.$arquivo.'/');
					getJS($auxDir);
				}
			}
		}
	}
}

//Função de autoload de controllers
spl_autoload_register(function($nameClass) {
	if (file_exists("app/Controllers/".$nameClass.".php")) {
		require_once("app/Controllers/".$nameClass.".php");
	}
	if (file_exists("app/Controllers/".$nameClass.".php")) {
		require_once("app/Controllers/".$nameClass.".php");
	}
});
?>