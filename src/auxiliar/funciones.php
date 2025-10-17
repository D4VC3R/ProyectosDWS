<?php

function generarPassword(int $longitud, bool $numeros, bool $letras, bool $signos) : string{
    $numeros = filter_var($numeros, FILTER_VALIDATE_BOOLEAN);
    $letras = filter_var($letras, FILTER_VALIDATE_BOOLEAN);
    $signos = filter_var($signos, FILTER_VALIDATE_BOOLEAN);

    $caracteres = "";

    if ($numeros) $caracteres .= '0123456789';

    if ($letras) $caracteres .= 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    if ($signos) $caracteres .= '!@#$%^&*()-_=+[]{}|;:,.<>?/~';

    if ($caracteres === '') {
        return 'Debe seleccionar al menos un tipo de carácter (números, letras o signos).';
    }

    $contrasena = '';
    $longitudCaracteres = strlen($caracteres);


    for ($i = 0; $i < $longitud; $i++) {
        $indice = rand(0, $longitudCaracteres - 1);
        $contrasena .= $caracteres[$indice];
    }

    return $contrasena;
};

function calculos ($x, $y) {
    return [
        "suma" => $x + $y,
        "resta" => $x - $y,
        "multiplicacion" => $x * $y,
        "division" => $y != 0 ? $x / $y : 'Error: División por cero'
    ];
};

function organizarImagen(array $datosImagen,string $tituloPelicula):string|bool{
    $carpetas=scandir(__DIR__);
    if (!array_search('uploaded',$carpetas)){
        mkdir(__DIR__."/uploaded");
        move_uploaded_file($datosImagen['tmp_name'],__DIR__."/uploaded/".$tituloPelicula."png");

    }else{
        move_uploaded_file($_FILES['poster']['tmp_name'],__DIR__."/uploaded/".$tituloPelicula."png");
    }


    return __DIR__."/uploaded/".$tituloPelicula."png";
}
