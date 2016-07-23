@extends('juegos.layer_unity')

@section('mi_css')
{{HTML::script('/TemplateData/UnityProgress.js')}}

@stop

@section('title')
  figuras geometricas
@stop



@section('zona_game')
  <!doctype html>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Unity WebGL Player | Figuras Geometricas</title>
    <link rel="stylesheet" href="TemplateData/style.css">
    <link rel="shortcut icon" href="TemplateData/favicon.ico" />
    <script src="TemplateData/UnityProgress.js"></script>
  </head>
  <body class="template">
    <div class="template-wrap clear">
      <canvas class="emscripten" id="canvas" oncontextmenu="event.preventDefault()" height="600px" width="960px"></canvas>
      <br>
      <div class="logo"></div>
      <div class="fullscreen"><img src="/TemplateData/fullscreen.png" width="38" height="38" alt="Fullscreen" title="Fullscreen" onclick="SetFullscreen(1);" /></div>
      <div class="title">Figuras Geometricas</div>
    </div>
  </body>
</html>

@stop

@section('mi_js')
<script type='text/javascript'>

  var Module = {
    TOTAL_MEMORY: 268435456,
    errorhandler: null,			// arguments: err, url, line. This function must return 'true' if the error is handled, otherwise 'false'
    compatibilitycheck: null,
    dataUrl: "{{asset('/packages/js/curiosity/juegos/figuras.data')}}",
    codeUrl: "{{asset('/packages/js/curiosity/juegos/figuras.js')}}",
    memUrl: "{{asset('/packages/js/curiosity/juegos/figuras.mem')}}",
  };
</script>
{{HTML::script('/Development/UnityLoader.js')}}
<script type="text/javascript">
  $position_body = $("body").position();
  
 // $("#canvas").css({"width":$(window).width(),"height":$(window).height(),"left":$position_body.left,"top":$position_body.top});
</script>
@stop

