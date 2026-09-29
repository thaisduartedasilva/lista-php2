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

function nivelSeguranca($senha){

    $nivel = 0;

    if(strlen($senha) >= 8){
        $nivel++;
    }

    if(contarMaiusculas($senha) > 0){
        $nivel++;
    }

    if(contarMinusculas($senha) > 0){
        $nivel++;
    }

    if(contarNumeros($senha) > 0){
        $nivel++;
    }

    if(contarEspeciais($senha) > 0){
        $nivel++;
    }

    if($nivel <= 2){
        return "Fraca";

    }elseif($nivel == 3){
        return "Média";

    }elseif($nivel == 4){
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
        "Nível" => nivelSeguranca($senha)
    ];

}

$resultado = analisarSenha("Thais123");

echo "Maiúsculas: " . $resultado["Maiúsculas"] . "<br>";
echo "Minúsculas: " . $resultado["Minúsculas"] . "<br>";
echo "Números: " . $resultado["Números"] . "<br>";
echo "Especiais: " . $resultado["Especiais"] . "<br>";
echo "Tamanho: " . $resultado["Tamanho"] . "<br>";
echo "Nível: " . $resultado["Nível"];


?>