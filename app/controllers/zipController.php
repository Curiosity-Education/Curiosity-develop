<?php


/**
 *
 */
class zipController extends BaseController
{
  private function recorrer_ruta($ruta, $typeAndFolder, $boolean){
    $filesSaved = [];
    // abrir un directorio y listarlo
    //---Verificamos si la ruta es un dirctorio
    if (is_dir($ruta)) {
      //---Abrimos el directorio
      if ($dh = opendir($ruta)) {
        //---Mientras que el directio sea leeible
        while (($file = readdir($dh)) !== false) {
          //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio
          if (!is_dir($ruta . $file) && $file!="." && $file!=".."){
            //solo si es un archivo, distinto que "." y ".."
            //Encontramos su extension
            foreach ($typeAndFolder as $tipo => $directorio) {
              if ($tipo == archivoController::findExtension($file)){
                if ($boolean == 'yes'){
                  $fileName = rand()."_".date('Y-m-d').".".archivoController::findExtension($file);
                }
                else if ($boolean == 'not'){
                  $fileName = $file;
                }
                else if ($boolean == 'both'){
                  $fileName = $file."-".rand()."_".date('Y-m-d').".".archivoController::findExtension($file);
                }
                archivoController::moveFile($ruta.$file,public_path().$directorio.$fileName);
                array_push($filesSaved, array(
                  'nombre' => $fileName,
                  'ruta' => $directorio,
                  'tipo' => $tipo
                ));
              }
            }
          }
        }
        closedir($dh);
        return $filesSaved;
      }
    }else{
      return  Response::json(array(0=>"<br>No es ruta valida"));
    }
  }

  private function extraerArchivo($rutaZIP, $typeAndFolder, $boolean){
    //Creamos un objeto de la clase ZipArchive()
    $enzipado = new ZipArchive();
    //Abrimos el archivo a descomprimir
    $enzipado->open($rutaZIP);
    if(!file_exists(public_path()."/packages/zipFilesTemp/")){
      $Zipdescompress = mkdir(public_path()."/packages/zipFilesTemp/");
    }
    $ruta = public_path()."/packages/zipFilesTemp/";
    //--Extraemos el archivo a la ruta destinada
    $extraido = $enzipado->extractTo($ruta);
    //--Crerramos el archivo
    $enzipado->close();
    unlink($rutaZIP);
    //---Recorreomos la ruta para validar sus archivos y distribuirlos
    $saved = $this->recorrer_ruta($ruta, $typeAndFolder, $boolean);
    /* Si el archivo se extrajo correctamente listamos los nombres de los
    * archivos que contenia de lo contrario mostramos un mensaje de error
    */
    if($extraido == true){
      return array(true, $saved);
    }
    else{
      return false;
    }
  }

  public function extraerSave($inputFile, $typeAndFolder = [], $boolean = 'yes'){
    try{
      //Validamos que el input no este vacio
      if($inputFile != null){
        //Realizamos la validación para ver si es un archivo .ZIP
        if($inputFile->getClientOriginalExtension() == 'zip'){
          //Guardamos el nombre del archivo en la var $log
          $log = $inputFile->getClientOriginalName();
          //Preguntamos en una condicional si la carpeta existe
          if(!file_exists(public_path()."/packages/saveFilesZipTemp/")){
            $dirTempJuegoZip = mkdir(public_path()."/packages/saveFilesZipTemp/");
          }
          //--Guardamos el destino para guardar el zip del juego
          $destinoPath = public_path()."/packages/saveFilesZipTemp/";
          //--Guardamos el archivo en la variable $file
          $file = $inputFile;
          //Movemos el archivo a el $destinoPath
          $file->move($destinoPath, $log);
          //--Asignamos a la variable rutaZIP la ruta donde se encuentra el ZIP
          $rutaZIP = $destinoPath.$log;
          // Extraemos el archivo y como parametro recibe la ruta si todo
          // se procesa bien dentro de la funcion
          $extraccion = $this->extraerArchivo($rutaZIP, $typeAndFolder, $boolean);
          if($extraccion[0] == true){
            return $extraccion;
          }
          else {
            return false;
          }
        }
        else{
          return false;
        }
      }
      else{
        return false;
      }
    }
    catch(Exception $ex){
      return Response::json(array(0=>'ERROR: '.$ex));
    }
  }
}



 ?>
