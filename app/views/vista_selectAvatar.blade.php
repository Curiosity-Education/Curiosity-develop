  @extends('admin_base')

@section('title')
  Avatar
@stop

@section('mi_css')
{{HTML::style('packages/css/curiosity/selectAvatar.css')}}
@stop

@section('titulo_contenido_hijo')
	Selecciona tu Avatar
@stop

@section('panel_opcion')

<div class='container-fluid'>

  <div class='row bienvenida'>
    <center><h3 id="tit-wc"><b class='kds'>¡Bienvenido a Curiosity Educación!</b></h3></center>
    <div class='col-xs-12 col-sm-3 col-md-2'>
      <center><img src='/packages/images/curiosityGif.gif' alt='' class='img-responsive' style='margin-top:25px;'></center>
    </div>
    <div class='col-xs-12 col-sm-9 col-md-10'>
      <p class='text-justify'>
        Estas a punto de comenzar una gran aventura llena de conocimientos,
        en la que cada vez serás mejor y podrás aumentar tus habilidades para el estudio,
        todo esto claro de una manera entretenida y mas que nada divertida a travez de juegos
        que estan hechos especialmente para tí.
        <br><br>
        <h5><b id='sbt'>¡No esperes más!</b></h5>
        <br>
        Para comenzar con esta aventura, te presentamos a nuestros avatars,
        de los cuales podrás seleccionar al que más te guste
        para acompañarte durante todo el proceso de aprendizaje.
      </p>
    </div>
  </div>

  <div class='row'>
    @foreach ($avatars as $avatar)
    <div class='col-md-4'>
      <div class="boxAv">
        <center><h5 class="bordTitle">{{$avatar->nombre}}</h5></center>
        <center><img src='/packages/images/avatars_curiosity/estilos/{{$avatar->preview}}'class='img-responsive avatarDef'></center>
        <center><button type='button' class='btnSelect' data-yd='{{$avatar->yd}}'>
          <span class='fa fa-check'></span>&nbsp;
          Seleccionar
        </button></center>
      </div>
    </div>
    @endforeach
  </div>

</div>

@stop

@section('mi_js')
{{HTML::script('/packages/js/curiosity/selectAv.js')}}
@stop
