<?php

function totalConsultas($gerenciar){
    return count($gerenciar);
}

function pacientesDiferentes($gerenciar){

    $pacientes = [];

    foreach($gerenciar as $consulta){
        $pacientes[] = $consulta["paciente"];
    }

    return count(array_unique($pacientes));
}

function consultasEspecialidade($gerenciar){
    $especialidades = [];

    foreach($gerenciar as $consulta){
        $especialidades[] = $consulta["especialidade"];
    }

    return array_count_values($especialidades);
}

function ordenarHorario($gerenciar){

    usort($gerenciar, function($a, $b){
        return strcmp($a["horario"], $b["horario"]);
    });

    return $gerenciar;
}

function pesquisarPaciente($gerenciar, $nome){

    foreach($gerenciar as $consulta){

        if(strtolower($consulta["paciente"]) == strtolower($nome)){
            return $consulta;
        }
    }

    return "O paciente não foi encontrado!";
}

function horariosDuplicados($gerenciar){

    $horarios = [];

    foreach($gerenciar as $consulta){
        $horarios[] = $consulta["horario"];
    }

    return count($horarios) != count(array_unique($horarios));
}

function organizarAgenda($gerenciar, $paciente){

    $ordenada = ordenarHorario($gerenciar);

    return [

        "Total de consultas" => totalConsultas($gerenciar),
        "Pacientes diferentes" => pacientesDiferentes($gerenciar),
        "Consultas por especialidade" => consultasEspecialidade($gerenciar),
        "Primeiro atendimento" => $ordenada[0],
        "Último atendimento" => $ordenada[count($ordenada)-1],
        "Agenda ordenada" => $ordenada,
        "Pesquisa do paciente" => pesquisarPaciente($gerenciar, $paciente),
        "Horários duplicados" => horariosDuplicados($gerenciar)

    ];
}

$gerenciar = [

    [
        "paciente" => "Thais",
        "especialidade" => "Cardiologia",
        "data" => "10/08/2026",
        "horario" => "09:00"
    ],

    [
        "paciente" => "Serenna",
        "especialidade" => "Cirurgia geral",
        "data" => "10/08/2026",
        "horario" => "08:00"
    ],

    [
        "paciente" => "Annie",
        "especialidade" => "Cirurgia plástica",
        "data" => "10/08/2026",
        "horario" => "10:30"
    ],

    [
        "paciente" => "Henrique",
        "especialidade" => "Dermatologia",
        "data" => "10/08/2026",
        "horario" => "11:00"
    ]

];

$resultado = organizarAgenda($gerenciar, "Thais");

echo "Total de consultas: " . $resultado["Total de consultas"] . "<br>";
echo "Pacientes diferentes: " . $resultado["Pacientes diferentes"] . "<br>";

echo "<br>Consultas por especialidade: <br>";
foreach ($resultado["Consultas por especialidade"] as $esp => $qtd){
    echo $esp . ": " . $qtd . "<br>";
}

echo "Primeiro atendimento: " . $resultado["Primeiro atendimento"]["paciente"] . " = " . $resultado["Primeiro atendimento"]["horario"] . "<br>";
echo "Último atendimento: " . $resultado["Último atendimento"]["paciente"] . " = " . $resultado["Último atendimento"]["horario"] . "<br>";

echo "Agenda ordenada: <br>";
foreach ($resultado["Agenda ordenada"] as $consulta){
    echo $consulta["horario"] . " = " . $consulta["paciente"] . "<br>";
}

echo "Pesquisa por paciente: <br>";
if(is_array($resultado["Pesquisa do paciente"])){
    echo $resultado["Pesquisa do paciente"]["paciente"] . " = " . $resultado["Pesquisa do paciente"]["especialidade"];
}else{
    echo $resultado["Pesquisa do paciente"];
}

echo "<br>Horários duplicados: ";
if ($resultado["Horários duplicados"]){
    echo "Sim";
}else{
    echo "Não";
}

?>