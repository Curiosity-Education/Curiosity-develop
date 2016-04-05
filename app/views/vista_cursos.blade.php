@extends('admin_base')

@section('title')
  cursos
@stop

@section('mi_css')
	{{HTML::style('packages/css/curiosity/cursos.css')}}
@stop

@section('titulo_contenido')
  Cursos
@stop


@section('titulo_small')
@stop

@section('panel_opcion')
  @foreach($cursos as $curso)
    <div class='col-md-4 box-curso' id = {{ $curso->id }} >
      <div class='box box-widget widget-user temario bloque-hover'>
        <div class='widget-user-header bg-blue'>
          <h3 class='widget-user-username text-center'>{{ $curso->titulo }}</h3>
        </div>
        <div class='widget-user-image'>
          {{HTML::image($curso->foto_curso, 'alt', array('class' => 'img-circle'))}}
        </div>
        <div class='box-footer'>
          <div class='row'>
            <div class='col-xs-4 border-right'>
              <div class='description-block'>
                <span class='fa fa-star fa-3x'></span>
                <br>
                <span class='description-text'>RANKING<br>{{ $curso->raiking }}</span>
              </div>
            </div>
            <div class='col-xs-4 border-right'>
              <div class='description-block'>
                <span class='fa fa-tasks fa-3x'></span>
                <br>
                <span class='description-text'>CURSOS<br>6</span>
              </div>
            </div>
            <div class='col-xs-4'>
              <div class='description-block'>
                <span class='fa fa-unlock fa-3x'></span>
                <br>
                <span class='description-text'>UNLOCK</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endforeach
@stop

@section('mi_js')
  {{HTML::script('packages/js/curiosity/Alumno_cursos.js')}}
@stop
