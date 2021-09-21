<?php
# autor: aldosena10@gmail.com
# atualização em: 2021 - 09 - 21
# histórico:
#- 21-09-2021 = criada a funçao datafinal(....
#- 24-09-2020 = retorno "" se não consegir converter para BR 
#- 24-09-2020 = o datacertadma agora aceita / ou -
# Objetivo: Funçoes com datas (PHP7)

$codigododia = array("DOM" => "1", "SEG" => "2", "TER" => "3", "QUA" => "4", "QUI" => "5", "SEX" => "6", "SAB" => "7");
$ameses = array(1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Março", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
$ams = array(1 => "Jan", 2 => "Fev", 3 => "Mar", 4 => "Abr", 5 => "Mar", 6 => "Jun", 7 => "Jul", 8 => "Ago", 9 => "Set", 10 => "Out", 11 => "Nov", 12 => "Dez");

# esta função recebe data no formato no formato us ou br
# e retorna no formato escolhido us ou br.

function datafinal($dx, $ssigla){   
     $ssaida = strtoupper($ssigla);   
     if ($ssaida != "BR"){ // se nao definir o padrão, gera zero
	 if ($ssaida != "US"){
		 return "00-00-00";
		 exit;
	 };
	 };	 
	 // separa valores da data recebida
	 $d = str_replace("/", "-", $dx); // trocar / por -
	 $di = explode("-",$d); // separa a data em 3 partes

	 //se o 1º intervalo tiver 1 ou 2 letras, é o dia no formato d/m/a (br)
     if (strlen($di[0]) < 3){ $dformato = "BR"; }else{ $dformato = "US"; };
	 
	 // se a data recebida for america
	 if ($dformato == "US"){	 
	    $d = intval($di[2]);
	    $m = intval($di[1]);
	    $a = intval($di[0]);	
	 };
	 //se a data recebida for brasileira
	 if ($dformato == "BR"){	 
	    $d = intval($di[0]);
	    $m = intval($di[1]);
	    $a = intval($di[2]);	
	 };
	 // confere se a data está correta
	 if (checkdate($m,$d,$a) == false){ // checo se é valido
			return "00-00-00";
			exit;
	 };	
     // exibir final
	 if ($ssaida == "US"){
	        $f = $a."-".$m."-".$d;
	}else{
	        $f = $d."/".$m."/".$a;
	};// ame
	return $f;  
};
// exemplo de uso: $gravanobanco = datafinal($dataescolhida,"us");

# esta função recebe e retorna uma data no formato brasileiro ou americano
# esta função está obsoleta e será exclída em 2022
# usar a função acima: datafinal(
function datazero($pini, $dx, $pfini){   
	$pi = strtoupper($pini);
    if ($pi != "BR"){ // se nao definir o padrão, gera zero
	if ($pi != "US"){
		 return "";
		 exit;
	 };
	 };
     $pf = strtoupper($pfini);   
     if ($pf != "BR"){ // se nao definir o padrão, gera zero
	 if ($pf != "US"){
		 return "";
		 exit;
	 };
	 };	 
	 // separa valores da data recebida
	 $d = str_replace("/", "-", $dx); // aceita / ou -
	 $di = explode("-",$d); // separa
	 if (intval($di[0]) == 0){ // se não houver inteiro
		 return "";
		 exit;		 
	 };
	 // se for entrada america
	 if ($pi == "US"){	 
	    $d = intval($di[2]);
	    $m = intval($di[1]);
	    $a = intval($di[0]);	
	 };
	 //se a entrada for brasileira
	 if ($pi == "BR"){	 
	    $d = intval($di[0]);
	    $m = intval($di[1]);
	    $a = intval($di[2]);	
	 };
	 if (checkdate($m,$d,$a) == true){ // checo se é valido
	    if ($pf == "US"){
	        $f = $a."-".$m."-".$d;
	    } else {
	        $f = $d."/".$m."/".$a;
	    };// ame
	 }else{ //se não for válido...
	    if ($pf == "US"){
	        $f = "0000-00-00";
	    } else {
	        $f = "";
	    };
	 };// invalido
	 return $f;  
};
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

# pega o padrão brasileiro
function diaextenso($dix){	
	$mex = array(1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Março", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
	$data = explode("/","$dix"); // fatia a string $dat em pedados, usando / como referência
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

?>

