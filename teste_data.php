<html>
    <head>
        <meta charset="utf-8">
        <title>Teste Data Zero</title>
    </head>
<body>
<?php 
        require_once './datazero.php'; 
        // este arquivo serve para testar as funções criadas
?>    

<h2> Código do Dia </h2>
<p> A variável $codigodia transforma em codigo a sigla DOM, SEG, TER ... etc. </p>
<?php
  echo "<p> DOM: " . $codigododia["DOM"] . ", SEG: " . $codigododia["SEG"] . ", TER: " . $codigododia["TER"] . "</p>";
?>
<hr />

<h2> Exibir data </h2>
<p> A função <b> datafinal( </b> pega a data em diversos formatos<br>
function datafinal($dx, $ssigla){ </p>
<?php
  $um = "21/09/1970";
  $r = datafinal($um, "US");
  echo "<p> Entrada: " . $um . " - saída us: " . $r . "</p>";
  //
  $dois = "1970-09-21";
  $r = datafinal($um, "BR");
  echo "<p> Entrada: " . $dois . " - saída br: " . $r . "</p>";


?>



</body>    
</html>
