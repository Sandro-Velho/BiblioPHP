<?php 

$path = MAIN."/cdn/";
$diretorio = dir($path);

getCSS($diretorio);

unset($path);
unset($diretorio);
?>