
@extends('admin_base')

@section('title')
  Subir Juegos
@stop

@section('mi_css')
	{{HTML::style('packages/css/cursos.css')}}

@stop
@section('titulo_contenido')
  Subir Contenido del juego
@stop


@section('titulo_small')
@stop

@section('panel_opcion')

<div class='col-md-4'>
        <section class="form-group dropzones">
            <label>Subir Juego</label>
            <form action="/subirZIP" enctype="multipart/form-data" id="frm_subir_juego">
                <input type="file" class="fallback" multiple="true" accept="application/x-zip-compressed" name="juego_zip" id="juego_zip">
            </form>
        </section>
        <div id="archivos" class="col-md-12">

        </div>
</div>
@stop


@section('mi_js')

    <script type="text/javascript" src="packages/js/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script type="text/javascript" src="packages/js/noty/layouts/bottomRight.js"></script>
    <script type="text/javascript" src="packages/js/noty/layouts/topRight.js"></script>
    {{HTML::script('packages/js/dropzone/dropzone.js')}}
    {{HTML::script('packages/js/curiosity/subirjuego.js')}}


@stop
