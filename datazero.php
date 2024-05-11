
<?php
# autor: aldosena10@gmail.com
# atualização em: 18/01/2023
# disponível em: https://github.com/aldosena/datazero
# Objetivo: Funçoes com datas (PHP7)

// menusculo em desuso
$DIADASEMANA = array(1 => "DOMINGO", 2 => "SEGUNDA", 3 => "TERÇA", 4 => "QUARTA", 5 => "QUINTA", 6 => "SEXTA", 7 => "SÁBADO");
$CODDASEMANA = array(1 => "DOM", 2 => "SEG", 3 => "TER", 4 => "QUA", 5 => "QUI", 6 => "SEX", 7 => "SÁB");
$CODDODIA = array("DOM" => "1", "SEG" => "2", "TER" => "3", "QUA" => "4", "QUI" => "5", "SEX" => "6", "SAB" => "7");
$codigododia = array("DOM" => "1", "SEG" => "2", "TER" => "3", "QUA" => "4", "QUI" => "5", "SEX" => "6", "SAB" => "7");
$AMESES = array(1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
$ameses = array(1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
// diário de classe
$AMES = array("01" => "Janeiro", "02" => "Fevereiro", "03" => "Março", "04" => "Abril", "05" => "Maio", "06" => "Junho", "07" => "Julho", "08" => "Agosto", "09" => "Setembro", "10" => "Outubro", "11" => "Novembro", "12" => "Dezembro");
$AMS = array(1 => "Jan", 2 => "Fev", 3 => "Mar", 4 => "Abr", 5 => "Mar", 6 => "Jun", 7 => "Jul", 8 => "Ago", 9 => "Set", 10 => "Out", 11 => "Nov", 12 => "Dez");
$ams = array(1 => "Jan", 2 => "Fev", 3 => "Mar", 4 => "Abr", 5 => "Mar", 6 => "Jun", 7 => "Jul", 8 => "Ago", 9 => "Set", 10 => "Out", 11 => "Nov", 12 => "Dez");

// função que soma uma dia ou uma hora a uma data específica
function MaisDH($inicial, $dd, $hh){
  // quer acrescentar um dia, coloque em $dd
  // quer acrescentar uma hora, coloque em $hh
  // quecra a tada no foramto timestamp - yyyy-mm-dd hh:nn:ss
  $dia = substr($inicial, 8, 2); 
  $mes = substr($inicial, 5, 2); 
  $ano = substr($inicial, 0, 4); 
  $hora = substr($inicial, 11, 2);
  $minuto = substr($inicial, 14, 2);
  $segundo = 0;
  $re = mktime(($hora + $hh), $minuto, $segundo, $mes, ($dia + $dd), $ano);
  $r = date("Y-m-d H:i:s", $re);
  return $r;   
}; 
// exemplo de uso: $futuro =  MaisDH($h, 1, 0);

function datafinal($dx, $xsaida){   
	# esta função recebe data no formato no formato us ou br e retorna no formato escolhido us ou br.
	# se exporta para us, recebeu br! se exporta para br, recebeu us!
	if (strtoupper($xsaida) == "US"){ 
			$xentrada = "BR";
	}else{
        $xentrada = "US";
	};		 
	// separa valores da data recebida
	$d = str_replace("/", "-", $dx); // trocar / por - se houver
	$dia = explode("-",$d); // separa as partes
	
  if ($xentrada == "US"){	 
	    $d = intval($dia[2]);
	    $m = intval($dia[1]);
	    $a = intval($dia[0]);	
  };

  if ($xentrada == "BR"){	 
	    $d = intval($dia[0]);
	    $m = intval($dia[1]);
	    $a = intval($dia[2]);	
  };
	
  // confere se a data está correta
  if (checkdate($m,$d,$a)){ // se é valido
      if ($xsaida == "US"){
	        $f = $a."-".$m."-".$d;
      }else{
	        $f = $d."/".$m."/".$a;
      };// se saida  
  }else{	
    $f = "0-0-0";
  };//se invalido	
	return $f;  
};// fim funcçao
	
	
// exemplo de uso: $gravanobanco = datafinal($dataescolhida,"us");

/**
 * esta função recebe e retorna uma data no formato brasileiro ou americano
 * @param string $pini us ou br;
 * @param string $dx data recebida;
 * @param string $pfini us ou br;
 * @return string data no formato br ou us;
 */
function datazero($pini, $dx, $pfini){   
  $pi = strtoupper($pini);
  $pf = strtoupper($pfini);   
	 
 // separa valores da data recebida
 $d = str_replace("/", "-", $dx); // aceita / ou -
 $di = explode("-",$d); // separa
 // se for entrada america
 if ($pi == "US"){	 
	    $d = $di[2];
	    $m = $di[1];
	    $a = $di[0];	
 };
 //se a entrada for brasileira
 if ($pi == "BR"){	 
	    $d = $di[0];
	    $m = $di[1];
	    $a = $di[2];	
 };
 $f = "";
 if (checkdate($m,$d,$a) == true){ // checo se é valido
	    if ($pf == "US"){
	        $f = $a."-".$m."-".$d;
	    } else {
	        $f = $d."/".$m."/".$a;
	    };// ame
};// se valido
	 return $f;  
}; // fim datazero
// exemplo: $gravabanco = datazero("br",$dataescolhida,"us");


#  soma MESES a uma data
function soma_dma($dma, $qt){ 
     $q = intval($qt);
	 // separa valores
	 $v = str_replace("/", "-", $dma); // aceita / ou -
	 $vi = explode("-",$v); // quebra
	 $d = $vi[0];
	 $m = $vi[1];
	 $a = $vi[2];	
	 if (checkdate($m,$d,$a) == false){ // checo se é valido
	     $f = "0000-00-00";	 
	 } else { // nova data
	     $f = date("Y-m-d", mktime(0, 0, 0, ($m + $q), $d, $a));
     };	 
     return $f;  
};

# checa se a data está correta
function datacertadma($dtc){
	$dx = str_replace("/", "-", $dtc); // aceita / ou -
	$data = explode("-","$dx"); // fatia a string
	$d = $data[0];
	$m = $data[1];
	$y = $data[2];
	$r = checkdate($m,$d,$y);
  return $r;
}
//if (datacertadma("31/02/2002") == 0) { // 1 = true (válida), 0 = false (inválida) *coloque " aspas

# checa se a data no formato Ymd está correta
function datacertaYmd($dtc){
	$dx = str_replace("/", "-", $dtc); // aceita / ou -
	$data = explode("-","$dx"); // fatia a string
	$y = $data[0];
	$m = $data[1];
	$d = $data[2];
	$r = checkdate($m,$d,$y);
  return $r;
}
//if (datacertadma("2002/01/20") == 0) { // 1 = true (válida), 0 = false (inválida) *coloque " aspas

# pega o padrão brasileiro
function diaextenso($dix){	
	$mex = array(1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Março", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
	$dxx = str_replace("/", "-", $dix); // aceita / ou -
	$data = explode("-","$dxx"); // fatia a string $dat em pedados, usando / como referência
	$d = $data[0];
	$m = $data[1];
	$y = $data[2];
	$r = $d." de ".$mex[$m]." de ".$y;
  return $r;
}

# retorna o numero do dia da semana
function nsemana($letr, $giorno){
	$letra = strtoupper($letr);
	if ($letra == "BR"){
		$da = explode("/",$giorno); // fatia a string $dat em pedados, usando / como referência
		$d = $da[0];
		$m = $da[1];
		$a = $da[2];	
		$g = date("Y-m-d", mktime(0, 0, 0, $m, $d, $a));		
	};
	if ($letra == "US"){
		$g = $giorno;		
	};	
	$r = date('w', strtotime($g)) + 1;    
	return $r;
};

# pega um campo timestamp (2017-04-13 00:00:00) no banco de dados e exibe em BR
function vertimestamp($dts){
	$d = substr($dts, 8, 2); 
	$m = substr($dts, 5, 2); 
	$y = substr($dts, 0, 4); 
	$h = substr($dts, 11, 2);
	$i = substr($dts, 14, 2);
	$r = $d."-".$m."-".$y." às ".$h.":".$i." h";
  return $r;
};

# pega um campo timestamp (2017-04-13 00:00:00) no banco de dados e exibe as horas
function VerHora($dts){
  $h = substr($dts, 11, 2);
  $i = substr($dts, 14, 2);
  $r = $h.":".$i." h";
  return $r;
};

# calcula em anos a data de uma pessoa 21/09/1970
function Calcula_Idade($diaaniv){
	$da = explode("/",$diaaniv); // fatia a string $dat em pedados, usando / como referência
	$dia_cli = $da[0];
	$mes_cli = $da[1];
	$ano_cli = $da[2];	
	// ano atual
	$anoatual = date("Y");
	$Rano = intval($anoatual) - intval($ano_cli);
	// mes -  se já passou o u não o aniversáiro do cara
	$mesatual = date("m");
	if (intval($mesatual) >= intval($mes_cli)){ $Rano += 1; }; //se passou ou chegou no mes de aniversário
	return $Rano;
};

/**
 * Esta função pega os dados diretamente o banco e exibe no formato BR
 */
function dataBR($dateUSA){
	if($dateUSA != ""){
	$ano = substr($dateUSA, 0, 4);
	$mes = substr($dateUSA, 5, 2);
	$dia = substr($dateUSA, 8, 2);
	$dateBR = $dia . '/' . $mes . '/' . $ano;
	return $dateBR;
	} else {
	return "";
	};
}

/**
 * Recebe uma string e converte para o formato americano
 * Retorna 0 (zero) se houver erro
 */
function dataUS($dateBR){
	if ($dateBR != ""){
			$ano = substr($dateBR, 6, 4);
			$mes = substr($dateBR, 3, 2);
			$dia = substr($dateBR, 0, 2);
			// validar
			if (checkdate($mes,$dia,$ano)){ 
					$r = $ano . '-' . $mes . '-' . $dia;
			}else{
					$r = 0;
			}; // if check		
	}else{  
		$r = 0; // vazio
	}; // se nao tem texto
	return $r;
} // func


/**
 * Use quando a variável data é confiavel
 */
function dateToUs($diaBR){
	if ($diaBR != ""){
	$ano = substr($diaBR, 6, 4);
	$mes = substr($diaBR, 3, 2);
	$dia = substr($diaBR, 0, 2);
	$dateUSA = $ano . '-' . $mes . '-' . $dia;
	return $dateUSA;
	} else {
	return "";
	}
}

?>