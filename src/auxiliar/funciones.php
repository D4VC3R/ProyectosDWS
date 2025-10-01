<?php

function generatePassword(int $longitud, bool $numeros, bool $letras, bool $signos) : string{
    $caracteres = "";

    if ($numeros) {
        $caracteres .= '0123456789';
    }

    if ($letras) {
        $caracteres .= 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    }

    if ($signos) {
        $caracteres .= '!@#$%^&*()-_=+[]{}|;:,.<>?/~';
    }

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
}
