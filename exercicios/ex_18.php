<?php

function totalConsultas($consultas){
    return count($consultas);
}

function pacientesDiferentes($consultas){

    $pacientes = [];

    foreach($consultas as $consulta){
        $pacientes[] = $consulta["paciente"];
    }

    return count(array_unique($pacientes));
}

function consultasEspecialidade($consultas){

    $especialidades = [];

    foreach($consultas as $consulta){

        if(isset($especialidades[$consulta["especialidade"]])){
            $especialidades[$consulta["especialidade"]]++;
        }else{
            $especialidades[$consulta["especialidade"]] = 1;
        }

    }

    return $especialidades;
}

function ordenarHorario($consultas){

    usort($consultas, function($a, $b){
        return strcmp($a["horario"], $b["horario"]);
    });

    return $consultas;
}

function pesquisarPaciente($consultas, $nome){

    $resultado = [];

    foreach($consultas as $consulta){

        if(strtolower($consulta["paciente"]) == strtolower($nome)){
            $resultado[] = $consulta;
        }

    }

    return $resultado;
}

function horariosDuplicados($consultas){

    $horarios = [];

    foreach($consultas as $consulta){
        $horarios[] = $consulta["horario"];
    }

    return count($horarios) != count(array_unique($horarios));
}

function organizarAgenda($consultas, $paciente){

    $ordenada = ordenarHorario($consultas);

    return [

        "Total de consultas" => totalConsultas($consultas),

        "Pacientes diferentes" => pacientesDiferentes($consultas),

        "Consultas por especialidade" => consultasEspecialidade($consultas),

        "Primeiro atendimento" => $ordenada[0],

        "Último atendimento" => $ordenada[count($ordenada)-1],

        "Agenda ordenada" => $ordenada,

        "Pesquisa do paciente" => pesquisarPaciente($consultas, $paciente),

        "Horários duplicados" => horariosDuplicados($consultas)

    ];

}

$consultas = [

    [
        "paciente"=>"Thais",
        "especialidade"=>"Cardiologia",
        "data"=>"10/08/2026",
        "horario"=>"09:00"
    ],

    [
        "paciente"=>"Serenna",
        "especialidade"=>"Pediatria",
        "data"=>"10/08/2026",
        "horario"=>"08:00"
    ],

    [
        "paciente"=>"Annie",
        "especialidade"=>"Cardiologia",
        "data"=>"10/08/2026",
        "horario"=>"10:30"
    ],

    [
        "paciente"=>"Henrique",
        "especialidade"=>"Dermatologia",
        "data"=>"10/08/2026",
        "horario"=>"11:00"
    ]

];

$resultado = organizarAgenda($consultas, "Thais");

print_r($resultado);

?>