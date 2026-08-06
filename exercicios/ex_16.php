<?php

function contarMaiusculas($senha){
    $contador = 0;

    for($i = 0; $i < strlen($senha); $i++){
        if(ctype_upper($senha[$i])){
            $contador++;
        }
    }

    return $contador;
}

function contarMinusculas($senha){
    $contador = 0;

    for($i = 0; $i < strlen($senha); $i++){
        if(ctype_lower($senha[$i])){
            $contador++;
        }
    }

    return $contador;
}

function contarNumeros($senha){
    $contador = 0;

    for($i = 0; $i < strlen($senha); $i++){
        if(is_numeric($senha[$i])){
            $contador++;
        }
    }

    return $contador;
}

function contarEspeciais($senha){
    $contador = 0;

    for($i = 0; $i < strlen($senha); $i++){

        if(!ctype_alpha($senha[$i]) && !is_numeric($senha[$i])){
            $contador++;
        }

    }

    return $contador;
}

function classificarSenha($senha){

    $pontos = 0;

    if(strlen($senha) >= 8){
        $pontos++;
    }

    if(contarMaiusculas($senha) > 0){
        $pontos++;
    }

    if(contarMinusculas($senha) > 0){
        $pontos++;
    }

    if(contarNumeros($senha) > 0){
        $pontos++;
    }

    if(contarEspeciais($senha) > 0){
        $pontos++;
    }

    if($pontos <= 2){
        return "Fraca";
    }elseif($pontos == 3){
        return "Média";
    }elseif($pontos == 4){
        return "Forte";
    }else{
        return "Muito Forte";
    }

}

function analisarSenha($senha){

    return [
        "Maiúsculas" => contarMaiusculas($senha),
        "Minúsculas" => contarMinusculas($senha),
        "Números" => contarNumeros($senha),
        "Especiais" => contarEspeciais($senha),
        "Tamanho" => strlen($senha),
        "Nível" => classificarSenha($senha)
    ];

}

$resultado = analisarSenha("Thais123");

print_r($resultado);

?>