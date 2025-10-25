<?php

namespace App\Class;

class FileManager
{
    private const string DIRECTORIO_SUBIDAS = __DIR__ . '/../../uploads/';
    private const int TAMANYO_MAX = 8 * 1024 * 1024;
    private const array EXTENSIONES_PERMITIDAS = ['jpg', 'png', 'jpeg', 'webp', 'svg', 'gif'];

    //datosImagen -> Lo que llega por $_FILES
    //carpetaDestino -> Le pasamos por parametro donde almacenar la imagen (users, movies, director, etc.)
    public static function subirImagen(array $datosImagen, string $carpetaDestino, string $nombreFinal):false|string {
        // Comprobamos que se haya subido un archivo y que haya errores, si el campo 'error' es distinto de 0, problemas.
        if (!isset($datosImagen['tmp_name']) || $datosImagen['error'] !== UPLOAD_ERR_OK)
            return false;

        // Si el archivo que se ha subido excede el tamaño, problemas.
        if ($datosImagen['size'] > self::TAMANYO_MAX)
            return false;

        // Si la extensión no está permitida, más problemas.
        $extension = strtolower(pathinfo($datosImagen['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, self::EXTENSIONES_PERMITIDAS))
            return false;

        // Si llegamos hasta aquí es que no hay problemas y podemos construir la ruta.
        $rutaCompleta = self::DIRECTORIO_SUBIDAS . $carpetaDestino . '/' . $nombreFinal;

        // Si no existe la carpeta, por ejemplo en el caso de que sea un nuevo usuario, la creamos.
        $carpeta = dirname($rutaCompleta);
        if (!is_dir($carpeta))
            mkdir($carpeta, 0775, true);

        // Si ya hay una imagen en ese directorio, la eliminamos.
        if (file_exists($rutaCompleta))
            unlink($rutaCompleta);

        // Ejecutamos move_uploaded_file, como devuelve true si tiene exito, negamos la condición
        // y en una sola linea movemos y comprobamos si se ha movido correctamente.
        if (!move_uploaded_file($datosImagen['tmp_name'], $rutaCompleta))
            return false;

        // Si tdo va bien, devolvemos la ruta relativ donde se ha guardado la imagen.
        return str_replace(self::DIRECTORIO_SUBIDAS, '/uploads', $rutaCompleta);

    }
}