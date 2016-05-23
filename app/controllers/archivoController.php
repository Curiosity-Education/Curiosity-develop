<?php
class archivoController extends Eloquent{
    public static function findExtension($file){
        $trozos = explode(".", $file);
        $extension = end($trozos);
        // mostramos la extensión del archivo
        return  $extension;
    }
    public static function moveFile($dirNow,$newDir){
        rename($dirNow,$newDir);
    }
}
