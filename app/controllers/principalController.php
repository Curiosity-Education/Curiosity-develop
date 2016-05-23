<?php

/**
 *
 */
class principalController extends BaseController
{

  function verPagina()
  {
    $escuelas = array('escuelas' => escuela::where('active', '=', 1)->get());
    return View::make('principal', $escuelas);
  }

  function verNosotros(){
    return View::make('vista_nosotros');
  }

}


 ?>
