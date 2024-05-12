<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/aldosena/cssdelphi/delphi.01.css" media="screen">
    <title> Data Zero</title>
</head>
<body>
<h1> Testando a datazero - ! </h1>
<?php 
        require_once './datazero.php'; 
        // este arquivo serve para testar as funções criadas
        $MyDay = date("Y-m-d");
        $meudia = dataBR($MyDay);
?>    

<h2> Data vem do Banco de dados </h2>
<p> Variável MyDay: <?= $MyDay; ?> </p>
<p> Vairável modificada (br): <?= $meudia; ?> </p>
<hr>

<h2> Data Recebida e Convertida </h2>
<form method="POST" action="">
  <p> 
    <label for="dia1"> Dia(br) em Date </label><br>
    <input type="date" id="dia1" name="dia1" value=<?= "'$meudia'"; ?> />
  </p>  

  <p> 
    <label for="dia2"> Dia(br) em String </label><br>
    <input type="text" id="dia2" name="dia2" value=<?= "'$meudia'"; ?> />
  </p>  
  <input type="submit" value="Enviar">
</form> 

<?php
  $dia1 = (isset($_POST['dia1'])) ? $_POST['dia1'] : "";
  $dia2 = (isset($_POST['dia2'])) ? $_POST['dia2'] : "";
  echo "<p> Dados recebidos: d1 = $dia1 </p>";
  echo "<p> Dados recebidos: d2 = $dia2 </p>";
  echo "<p> Convertendo data 1 para us </p>";
  $my1 = dataUS($dia1);
  echo "<p> Exibir em us: $my1 </p>";
  //
  echo "<p> Convertendo data 2 para us </p>";
  $my2 = dataUS($dia2);
  echo "<p> Exibir em us: $my2 </p>";
?>
<p> Conclusão: <br>
Se usar Delphi /  C#, o input deve ser tipo String </p>

</body>
</html>