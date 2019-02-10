<?php 
class Biblio {
	private static $sucesso;
	private static $erro;

	public static function setSucesso ($msg) {
		self::$sucesso = $msg;
	}
	public static function setErro ($msg) {
		self::$erro = $msg;
	}

	public static function redireciona($url) {
		if (!empty(self::$erro))
			$_SESSION['erro'] = self::$erro;

		if (!empty(self::$sucesso))
			$_SESSION['sucesso'] = self::$sucesso;

		if ($url == '/') {
			$url .= ROOTNAME."/public/";
		}
		?>
		<script type="text/javascript">
			document.location = '';
			location.href = '<?=$url?>';
		</script>
		<?php
		exit();
	}
	public static function removeMask ($str) {
		return 	str_replace(".", "", 
					str_replace("-", "", 
						str_replace("/", "", 
							str_replace("(", "", 
								str_replace(")", "", 
									str_replace(" ", "", $str
									)
								)
							)
						)
					)
				);
	}

	public static function mask($val, $mask) {
		$maskared = '';
		$k = 0;
		for($i = 0; $i<=strlen($mask)-1; $i++) {
			if($mask[$i] == '#') {
				if(isset($val[$k]))
					$maskared .= $val[$k++];
			}
			else{
				if(isset($mask[$i]))
					$maskared .= $mask[$i];
			}
		}
		return $maskared;
	}

	public static function swapDate($data) {
		//verifica se tem a barra /
		if (strstr($data, "/")) {
		  	$d = explode ("/", $data);//tira a barra
		  	$rstData = "$d[2]-$d[1]-$d[0]";//separa as datas $d[2] = ano $d[1] = mes etc...
		  	return $rstData;
		}
		else if(strstr($data, "-")) {
		  	$data = substr($data, 0, 10);
		  	$d = explode ("-", $data);
		  	$rstData = "$d[2]/$d[1]/$d[0]";
		  	return $rstData;
		}
		else {
		  	return '';
		}
	}

	public static function setValues($data) {
		foreach ($data as $campo => $valor) {
			?>
			<script type="text/javascript">
				$("#<?=$campo?>").val("<?=$valor?>");
			</script>
			<?php
		}
		return 1;
	}

	public function setChecks($data) {
		foreach ($data as $campo => $valor) {
			if (!empty($valor) && $valor == 'S') {
			?>
			<script type="text/javascript">
				$("#<?=$campo?>").attr("checked", "<?=$checked?>");
			</script>
			<?php
			}
		}
		return 1;
	}

	public static function validate ($data) {
		foreach ($data as $campo => $valor) {
			if (empty($valor)) {
				return 0;
			}
		}
		return 1;
	}

	public static function removeAccents($string){
		$acentos = array("/(á|à|ã|â|ä)/",
						"/(Á|À|Ã|Â|Ä)/",
						"/(é|è|ê|ë)/",
						"/(É|È|Ê|Ë)/",
						"/(í|ì|î|ï)/",
						"/(Í|Ì|Î|Ï)/",
						"/(ó|ò|õ|ô|ö)/",
						"/(Ó|Ò|Õ|Ô|Ö)/",
						"/(ú|ù|û|ü)/",
						"/(Ú|Ù|Û|Ü)/",
						"/(ñ)/","/(Ñ)/");
		
	    return preg_replace($acentos,explode(" ","a A e E i I o O u U n N"),$string);
	}

	public static function pad($num, $tam) {
		return str_pad($num, $tam, "0", STR_PAD_LEFT);
	}

	public static function toFloat($valor) {
		return str_replace(",", ".", str_replace(".", "", $valor));
	}

	public static function moneyFormat($val) {
		if (empty($val))
			$val = 0;

		return number_format($val, 2, ",", ".");
	}

	public static function caps($str) {
		return mb_convert_case($str, MB_CASE_UPPER, 'UTF-8');
	}
}

?>