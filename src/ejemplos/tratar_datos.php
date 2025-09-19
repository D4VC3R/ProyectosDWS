<?php

    //$_GET[] es una variable global que contiene un array con los datos del formulario enviado
    $variable1 = $_GET['dividendo'];
    $variable2 = $_GET['divisor'];

    echo $variable1 / $variable2;
