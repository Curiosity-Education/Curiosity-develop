<?php
class cursoController extends BaseController
{
  public function verPagina()
  {
    $cursos = array('cursos' => curso::all());
    return View::make('vista_cursos', $cursos);
  }

  public function verPaginaAdmin()
  {
	  return View::make("vista_cursosAdmin");
  }

}
