<?php

/**
 *
 */
class vendedorController extends BaseController
{

  function verPagina(){
    return View::make('adminVendedores');
  }

  function obtenerActivos (){
    return vendedor::join('ciudades', 'ciudades.id', '=', 'vendedores.ciudad_id')
    ->join('estados', 'estados.id', '=', 'ciudades.estado_id')
    ->select('vendedores.*', 'ciudades.id as ciudadId', 'ciudades.nombre as ciudadNombre', 'estados.id as estadoId', 'estados.nombre as estadoNombre')
    ->where('active', '=', 1)->get();
  }

  function guardar(){

  }

  function actualizar(){

  }

  function eliminar (){

  }

  function guardarFoto(){

  }

}


 ?>
