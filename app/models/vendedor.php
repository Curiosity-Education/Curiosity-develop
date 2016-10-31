<?php

/**
 *
 */
class vendedor extends Eloquent
{
  protected $table = 'vendedores';
  protected $fillable = ['nombre','apellidos','correo','telefono','sexo'];
}
