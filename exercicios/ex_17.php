<?php

function removerEspacos($texto){
    return trim(preg_replace('/\s+/', ' ', $texto));
}

function contarCaracteres($texto){
    return strlen($texto);
}

function contarPalavras($texto){
    return str_word_count($texto);
}

function contarFrases($texto){
    return substr_count($texto, ".") +
           substr_count($texto, "!") +
           substr_count($texto, "?");
}

function maiorPalavra($texto){

    $palavras = explode(" ", removerEspacos($texto));

    $maior = $palavras[0];

    foreach($palavras as $palavra){

        if(strlen($palavra) > strlen($maior)){
            $maior = $palavra;
        }

    }

    return $maior;
}

function menorPalavra($texto){

    $palavras = explode(" ", removerEspacos($texto));

    $menor = $palavras[0];

    foreach($palavras as $palavra){

        if(strlen($palavra) < strlen($menor)){
            $menor = $palavra;
        }

    }

    return $menor;
}

function palavrasFrequentes($texto){

    $texto = strtolower(removerEspacos($texto));

    $palavras = explode(" ", $texto);

    $contagem = array_count_values($palavras);

    arsort($contagem);

    return array_slice($contagem, 0, 5, true);

}

function palavrasRepetidas($texto){

    $texto = strtolower(removerEspacos($texto));

    $palavras = explode(" ", $texto);

    $contagem = array_count_values($palavras);

    $repetidas = 0;

    foreach($contagem as $valor){

        if($valor > 1){
            $repetidas++;
        }

    }

    return $repetidas;
}

function formatarTexto($texto){
    return ucwords(strtolower(removerEspacos($texto)));
}

function processarTexto($texto){

    return [

        "Caracteres" => contarCaracteres($texto),
        "Palavras" => contarPalavras($texto),
        "Frases" => contarFrases($texto),
        "Maior Palavra" => maiorPalavra($texto),
        "Menor Palavra" => menorPalavra($texto),
        "Palavras Repetidas" => palavrasRepetidas($texto),
        "Cinco Mais Frequentes" => palavrasFrequentes($texto),
        "Texto Sem Espaços Duplicados" => removerEspacos($texto),
        "Texto Formatado" => formatarTexto($texto)

    ];

}

$texto = "Do lado de cá
A vida não é boa
Problemas não param de surgir

Do lado de cá
Vagamos sem rumo
Sem leito
Sem nada!
Pra seguir

Garota sua alma resguarda
O que falta na gente
E não larga o que tem que ser seu

Brilhante conforme no escuro
Seu rosto tão puro
Me lembra algo que se perdeu

Ó garota
O que se esconde na sua alma?
Ó garota
Seu olhar que devasta a escuridão pra salvar

O que se perdeu
Se perdeu
Do outro lado
Do outro lado

Me mostra a visão que eu nunca terei
Do outro lado
Do outro lado

(Mostra a visão que eu nunca terei)
(Do outro lado)
(Do outro lado)

E não é como se fosse tão fácil assim
Separar
Um lado bom, um lado ruim
O que há em você?
O que falta em mim?

Por partes
Não metades
E não é tarde
Pra acabar com toda essa ambição

Com o coração surge a alma
E com o corpo vem a fome
Fogo cruzado e o que há
Apenas provas de que ambos se corrompem

E poderia destruir
Só que não vai conseguir
O olhar que enxerga bondade sobre o homem

Ó garota
O que se esconde na sua alma?
Ó garota
Seu olhar que devasta a escuridão pra salvar

O que se perdeu
Se perdeu
Do outro lado
Do outro lado

Me mostra a visão que eu nunca terei
Do outro lado
Do outro lado";

$resultado = processarTexto($texto);

print_r($resultado);

?>