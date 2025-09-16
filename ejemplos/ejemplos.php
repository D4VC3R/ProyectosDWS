<?php

    // Mostrar texto por pantalla
    echo "Hola mundo";
    echo "<br>";

    print ("Esto es un mensaje de muestra con print");

    $mensaje = "Este es un parrafo";

    ?>
    <!-- Contenido en HTML -->
    <p><?=$mensaje?></p>

<?php
// Definir una variable

    $variable1 = "Mensaje 1";
    $variable2 = "Mensaje 2";

    echo $variable1 . $variable2;

    echo "<p style='color: whitesmoke; background-color: burlywood'>" . $variable2 . "</p>";

    $variable2 = 1.5;
    echo $variable2 . "<br>";

    //Definir una constante

        const PI = 3.1415;

        $variable2++;

        echo PI*$variable2;
