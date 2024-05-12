<?php

# manipulando datas

# ultima atualização: 26-09-2023



class datas{

    private $dia;

    private $mes;

    private $ano;

    private $data;

    private $hora;

    private $datahora;

    private $conn;

    function __construct()
    {
        $conn = MySqli_conn::conectar();
        if(!$conn){
            die('falha na conexão'.mysqli_connect_error());
        }else{
            $this->conn = $conn;
        }
    }



    public function getHora(){

       return $this->hora;

    }



    public function getDia() {

        return $this->dia;

    }



    public function getMes() {



        return $this->mes;



    }







    public function getAno() {



        return $this->ano;



    }







    public function getData() {



        return $this->data;



    }



    



    public function getDatahora(){



        return $this->datahora;



    }







    public function setHora($hora){



        $this->hora = $hora;



    }



    



    public function setDia($dia) {



        $this->dia = $dia;



    }







    public function setMes($mes) {



        $this->mes = $mes;



    }







    public function setAno($ano) {



        $this->ano = $ano;



    }







    public function setData($data) {



        $this->data = $data;



    }



    



    public function setDatahora($datahora){



        $this->datahora = $datahora;



    }



    



    public function USABR($dateUSA){



        if($dateUSA != ""){



        $ano = substr($dateUSA, 0, 4);



        $mes = substr($dateUSA, 5, 2);



        $dia = substr($dateUSA, 8, 2);



        $dateBR = $dia . '-' . $mes . '-' . $ano;



        return $dateBR;



        } else {



        return "";



        }



    }



    



    public function BRUSA($dateBR){



        if ($dateBR != ""){



        $ano = substr($dateBR, 6, 4);



        $mes = substr($dateBR, 3, 2);



        $dia = substr($dateBR, 0, 2);



        $dateUSA = $ano . '-' . $mes . '-' . $dia;



        return $dateUSA;



        } else {



        return "";



        }



    }



    



    public function dataHojeBR(){



        return date("d-m-Y");



    }



    



    public function dataHojeUSA(){



        return date("Y-m-d");



    }



    



    public function mesAtual(){



        return date("m");



    }



    



    public function anoAtual(){



        return date("Y");



    }



    



    public function diaAtual(){



        return date("d");



    }



    



    public function horaAtual(){



        return $this->hora = date("H:i:s");



    }



    



    public function dataHoraAtual(){



        $datahoraAtual = date("Y-m-d")." ".date("H:i:s");



        return $datahoraAtual;



    }



    



    public function diasemana($data){



    //Traz o número do dia da semana para qualquer data informada



    



    $dia =  substr($data,0,2);



    $mes =  substr($data,3,2);



    $ano =  substr($data,6,9);



    $diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano));



    



    return $diasemana;



    }



    



    public function diasemanaString($data){

    //Traz o dia da semana para qualquer data informada

    $dia =  substr($data,0,2);

    $mes =  substr($data,3,2);

    $ano =  substr($data,6,9);

    $diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano));

        switch($diasemana){

            case "0": $stringDiaSemana = "Domingo";

                break;  				

            case "1": $stringDiaSemana = "Segunda-Feira";

                break;  				

            case "2": $stringDiaSemana = "Terça-Feira";

                break;  				

            case "3": $stringDiaSemana = "Quarta-Feira";

                break;  				

            case "4": $stringDiaSemana = "Quinta-Feira";

                break;  				

            case "5": $stringDiaSemana = "Sexta-Feira";

                break;  				

            case "6": $stringDiaSemana = "Sábado";

                break; 

    }

        return $stringDiaSemana;

    }



    /**

     * Exibir o mês abreviado em 3 letras

     * @param int $codMes codigo do mes

     * @return string 3 letras 

     */

    public function MesAbrev($codMes){

        switch ($codMes){

            case "1" : $M = 'Jan'; break;

            case "2" : $M = 'Fev'; break;

            case "3" : $M = 'Mar'; break;

            case "4" : $M = 'Abr'; break;

            case "5" : $M = 'Mai'; break;

            case "6" : $M = 'Jun'; break;

            case "7" : $M = 'Jul'; break;

            case "8" : $M = 'Ago'; break;

            case "9" : $M = 'Set'; break;

            case "10" : $M = 'Out'; break;

            case "11" : $M = 'Nov'; break;

            case "12" : $M = 'Dez'; break;     

            default : $M = "";

        };

        return $M;

    }



    public function totaldiasMes($mes,$ano){

        $totalDiasMes = cal_days_in_month(CAL_GREGORIAN,$mes,$ano);

        return $totalDiasMes;

    }



    



    public function totalDiasTrabalhadosMes($dataInicial, $dataFinal){



        $diaInicial = substr($dataInicial,0,2);

        $mesInicial = substr($dataInicial,3,2);

        $anoInicial = substr($dataInicial,6,9);

        $diaFinal = substr($dataFinal,0,2);



        $mesFinal = substr($dataFinal,3,2);



        $anoFinal = substr($dataFinal,6,9);



        



        $totalDias = 0;



        



        for($dia = 1; $dia <= $diaFinal; $dia++){



            if($dia < 10){



                $dia = "0".$dia;



            }



            $diaSemana = date("w", mktime(0,0,0,$mesFinal,$dia,$anoFinal));



            



                if($diaSemana != 0){



                



                $selecionarFeriados = "SELECT DAY(dataFeriado) AS diaFeriado FROM feriados WHERE tipo = '0' AND DAY(dataFeriado) = '".$dia."' AND MONTH(dataFeriado) = '".$mesFinal."'";

                $queryFeriados = mysqli_query($this->conn, $selecionarFeriados);

                $totalFeriados = mysqli_num_rows($queryFeriados);



                if($diaSemana == 6){

                    $totalDias += 0.5;

                }else{

                    $totalDias++;

                }

                if($totalFeriados > 0){



                    $totalDias--;



                }

                }



            }



        return $totalDias;



  }



}



?>