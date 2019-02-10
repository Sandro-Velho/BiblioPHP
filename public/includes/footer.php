<?php 

$path = MAIN."/cdn/";
$diretorio = dir($path);

getJS($diretorio);

unset($path);
unset($diretorio);
?>