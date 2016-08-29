$(document).ready(function() {

  $curiosity.menu.setPaginaId("#menuAdminAvatar");

  var $botonGestionar;
  var $botonGestionarEst;
  var $botonGestionarSec;
  var $idAvatar;
  var $idEstilo;
  var $idSecuencia;
  var prevAvatar;
  var prevEstilo;
  var prevSecuencia;

  function clearAll() {
    $(".form-control").val("");
    $("#sexoAvatar").val($("#sexoAvatar").children().first().val());
  }

  function hideElement($selector){
    $selector.hide("slow");
  }

  function showElement($selector){
    $selector.show("slow");
  }

  function makePreview(imagen){
    $(".btnUploadImg").css({
      'padding-top': "0px",
      'height' : 'auto'
    });
    $(".btnUploadImg").html("<img src='"+imagen+"' class='img-responsive imgPreview' />");
  }

  function resetPreview(){
    $(".btnUploadImg").css({
      'padding-top': "25px",
      'height' : '150px'
    });
    $(".btnUploadImg").html("<span class='fa fa-file-image-o fa-3x'></span><br><br>click para seleccionar");
  }

  // ----------------------------
  // Acciones Generales
  // ----------------------------
  // Ocultar cualquier formulario con
  // la tecla ESC
  $(document).bind('keydown', function(e){
    if(e.which == 27){
      // hideAdmin();
      hideElement($(".btn-gestion-avatar"));
      hideElement($(".seccionAdmin"));
      hideElement($("#viewEstilos"));
      hideElement($("#viewSecuencias"));
      showElement($("#viewSection"));
      showElement($("#addNew"));
      hideElement($("#back"));
      clearAll();
      resetPreview();
    }
  });
  // regresamos a lo anterior
  $("#back").on('click', function(){
    var go = $(this).data('go');
    if(go == 'inicio'){
      hideElement($(".btn-gestion-avatar"));
      hideElement($(".seccionAdmin"));
      showElement($("#viewSection"));
      showElement($("#addNew"));
      hideElement($("#back"));
      clearAll();
      resetPreview();
    }
    else if (go == 'avatar') {
      hideElement($("#newEstilo"));
      makePreview("/packages/images/avatars_curiosity/estilos/"+prevAvatar);
      $("#viewEstilos").html("");
      hideElement($("#viewEstilos"));
      showElement($("#avatar"));
      showElement($("#addEstilos"));
      hideElement($("#addSecuencias"));
      $("#back").data('go', 'inicio');
    }
    else if (go == "quitFormEstilos") {
      resetPreview();
      showElement($("#newEstilo"));
      hideElement($("#estilos"));
      showElement($("#viewEstilos"));
      hideElement($("#addSecuencias"));
      $("#back").data('go', 'avatar');
      $("#nombreEstilo").val("");
      $("#valorEstilo").val("");
      $("#descripcionEstilo").val("");
    }
    else if (go == 'estilos') {
      $("#back").data('go', 'quitFormEstilos');
      makePreview("/packages/images/avatars_curiosity/estilos/"+prevEstilo);
      showElement($("#estilos"));
      showElement($("#addSecuencias"));
      hideElement($("#viewSecuencias"));
      hideElement($("#newSecuencia"));
      $("#viewSecuencias").html('');
    }
    else if (go == 'quitFormSecuencias') {
      hideElement($("#secuencias"));
      showElement($("#viewSecuencias"));
      showElement($("#newSecuencia"));
      $("#tipoSecuencia").val('');
      $("#back").data('go', 'estilos');
    }
    else if (go == 'backToDefault'){
      showElement($("#newEstilo"));
      showElement($("#viewEstilos"));
      hideElement($("#viewSecuencias"));
      hideElement($("#newSecuencia"));
    }
  });
  // Mostrar formulario para registrar
  // un nuevo avatar
  $("#addNew").on('click', function(){
    $("#guardarAvatar").data('switch', '1');
    // showAdmin();
    $("#back").data('go', 'inicio');
    showElement($("#back"));
    hideElement($("#viewSection"));
    showElement($("#avatar"));
    hideElement($("#addNew"));
  });
  // Desplegar cuadro de dialogo para
  // seleccionar una imagen de preview
  // para el avatar
  $(".btnUploadImg").on('click', function(){
    $("#prevAvatar").trigger('click');
  });

  // Click para seleccionar el zip de avatar
  $(".btnUploadSec").on('click', function(){
    $("#filesecuence").trigger('click');
  });

  $("#filesecuence").attr('accept', 'application/zip');
  // ----------------------------
  // Gestión de avatar
  // ----------------------------
  // Selección de imagen de preview para avatar, estilos o secuencias
  $("#prevAvatar").on('change', function(){
    var pesoMaximo = 2048000;
    var extensiones = new Array(".png", ".jpg", ".jpeg", '.gif');
    var $archivo = $(this);
    if($curiosity.comprobarFile($archivo.val(), extensiones)){
      var archivos = document.getElementById("prevAvatar").files;
      if(archivos[0].size > pesoMaximo){
        $archivo.val("");
        resetPreview();
        $curiosity.noty("La imagen seleccionada excede el peso máximo (2 MB)", 'warning');
      }
      else{
        var navegador = window.URL || window.webkitURL;
        var objeto_url = navegador.createObjectURL(archivos[0]);
        makePreview(objeto_url);
      }
    }
    else{
      $archivo.val("");
      resetPreview();
    }
  });
  // guardar el registro de avatar
  $("#guardarAvatar").on('click', function(){
    if($(this).data('switch') == '1'){
      var formData = new FormData($("#formImgPrev")[0]);
      formData.append("nombreAvatar", $("#nombreAvatar").val());
      formData.append("historia", $("#historiaAvatar").val());
      formData.append("sexo", $("#sexoAvatar").val());
      formData.append("active", 1);
      formData.append("nombreEstilo", "Default");
      formData.append("descripcion", $("#historiaAvatar").val());
      formData.append("active", 1);
      formData.append('is_default', 1);
      formData.append('valor', 0);
      $avatar.avatar.guardar($(this), formData);
    }
  });
  // Gestionar avatar
  $("body").on('click', '.gestionarAv', function(event) {
    $botonGestionar = $(this);
    var $info = $botonGestionar.data('dat');
    $idAvatar = $info['id'];
    prevAvatar = $info['preview'];
    $("#guardarAvatar").data('switch', '2');
    $("#nombreAvatar").val($info['nombre']);
    $("#historiaAvatar").val($info['historia']);
    $("#sexoAvatar").val($info['sexo']);
    makePreview("/packages/images/avatars_curiosity/estilos/"+$info['preview']);
    hideElement($("#viewSection"));
    showElement($("#avatar"));
    hideElement($("#addNew"));
    showElement($("#addEstilos"));
    $("#back").data('go', 'inicio');
    showElement($("#back"));
  });
  // Actualizar Avatar
  $("#guardarAvatar").on('click', function(){
    if($(this).data('switch') == '2'){
      var formData = new FormData($("#formImgPrev")[0]);
      var $padre = $botonGestionar.parent().parent();
      formData.append('id', $idAvatar);
      formData.append("nombreAvatar", $("#nombreAvatar").val());
      formData.append("historia", $("#historiaAvatar").val());
      formData.append("sexo", $("#sexoAvatar").val());
      $avatar.avatar.actualizar($(this), $botonGestionar, $padre, formData);
    }
  });
  // Eliminar Avatar
  $("body").on('click', '.eliminarAv', function(event) {
    var $info = $(this).data('dat');
    var $padre = $(this).parent().parent().parent();
    $avatar.avatar.eliminar($info['id'], $padre);
  });

  // ----------------------------
  // Gestión de estilos
  // ----------------------------
  // mostrar estilos
  $("#addEstilos").click(function(event) {
    hideElement($("#avatar"));
    hideElement($(this));
    $("#back").data('go', 'avatar');
    showElement($("#back"));
    showElement($("#newEstilo"));
    $avatar.estilo.getById($idAvatar, $("#viewEstilos"));
  });
  // Agregar un nuevo estilo para el avatar
  // y mostrar el formulario
  $("#newEstilo").click(function(){
    resetPreview();
    $("#guardarEstilo").data('action', '1');
    $("#back").data('go', 'quitFormEstilos');
    hideElement($(this));
    hideElement($("#viewEstilos"));
    showElement($("#estilos"));
  });
  // click en gestionar estilos
  // llenar el formulario con los datos correspondientes
  $('body').on('click', '.gestionarEst', function(){
    hideElement($("#newEstilo"));
    $botonGestionarEst = $(this);
    $("#guardarEstilo").data('action', '2');
    var $estilo = $(this).data('dat');
    $idEstilo = $estilo['id'];
    prevEstilo = $estilo['preview'];
    showElement($("#addSecuencias"));
    $("#back").data('go', 'quitFormEstilos');
    makePreview("/packages/images/avatars_curiosity/estilos/"+$estilo['preview']);
    $("#nombreEstilo").val($estilo['nombre']);
    $("#valorEstilo").val($estilo['valor']);
    $("#descripcionEstilo").val($estilo['descripcion']);
    hideElement($("#viewEstilos"));
    showElement($("#estilos"));
  });
  // guardar la informacion del estilo en el formulario
  // tanto para guardar como para actulizar la información
  $("#guardarEstilo").click(function(event) {
    var accionEstilo = $(this).data('action');
    if(accionEstilo == 1){
      // Guardar
      var formData = new FormData($("#formImgPrev")[0]);
      formData.append('nombre', $("#nombreEstilo").val());
      formData.append('valor', $("#valorEstilo").val());
      formData.append('descripcion', $("#descripcionEstilo").val());
      formData.append('active', '1');
      formData.append('is_default', '0');
      formData.append('avatars_id', $idAvatar);
      $avatar.estilo.guardar($(this), formData);
    }
    else if(accionEstilo == 2){
      // Actualizar
      var formData = new FormData($("#formImgPrev")[0]);
      var $padre = $botonGestionarEst.parent().parent();
      formData.append('id', $idEstilo);
      formData.append('nombre', $("#nombreEstilo").val());
      formData.append('valor', $("#valorEstilo").val());
      formData.append('descripcion', $("#descripcionEstilo").val());
      $avatar.estilo.actualizar($(this), $botonGestionarEst, $padre, formData);
    }
  });
  // Eliminar estilo de avatar
  $('body').on('click', '.eliminarEst', function(){
    var $el = $(this).parent().parent().parent();
    $avatar.estilo.eliminar($(this).data('dat')['id'], $el);
  });

  // ----------------------------
  // Gestión de secuencias
  // ----------------------------
  // comprobar tipo de archivo seleccionado y mostrar preview
  $("#filesecuence").on('change', function(){
    var pesoMaximo = 2048000;
    var extensiones = new Array('.zip');
    var $archivo = $(this);
    var $selectorzip = $(".btnUploadSec");
    if($curiosity.comprobarFile($archivo.val(), extensiones)){
      var archivos = document.getElementById("filesecuence").files;
      if(archivos[0].size > pesoMaximo){
        $archivo.val("");
        $selectorzip.css({
          'padding-top' : '80px',
          'height' : '200px'
        });
        $selectorzip.html('');
        $selectorzip.text('Da click aquí para seleccionar tu archivo .zip');
        $curiosity.noty("El archivo seleccionado excede el peso máximo establecido (2 MB)", 'warning');
      }
      else{
        $selectorzip.html('');
        var $zip = $("<img/>");
        $zip.attr('src', '/packages/images/zipicon.png');
        $zip.css('width', '15%');
        $selectorzip.css({
          'padding-top' : '10px',
          'height' : 'auto'
        });
        $selectorzip.append($zip);
        $selectorzip.append("<h5 class='zipinfoloaded'>"+ archivos[0].name +"<h5/>");
        $selectorzip.append("<h5 class='zipinfoloaded'>"+ archivos[0].size +" kb<h5/>");
      }
    }
    else{
      $archivo.val("");
      $selectorzip.css({
        'padding-top' : '80px',
        'height' : '200px'
      });
      $selectorzip.html('');
      $selectorzip.text('Da click aquí para seleccionar tu archivo .zip');
    }
  });
  // mostrar las secuencias del estilo del avatar
  $("#addSecuencias").click(function() {
    $("#back").data('go', 'estilos');
    hideElement($(this));
    hideElement($("#estilos"));
    showElement($("#newSecuencia"));
    $avatar.secuencia.getById($idEstilo, $("#viewSecuencias"));
  });
  // Mostrar el formulario para registrar una nueva secuencia
  $("#newSecuencia").click(function() {
    resetPreview();
    hideElement($(this));
    hideElement($("#viewSecuencias"));
    showElement($("#secuencias"));
    $("#back").data('go', 'quitFormSecuencias');
    $("#guardarSecuencia").data('action', 1);
  });
  // mostrar las secuencias del estilo de avatar default
  $('body').on('click', '#secDef', function(){
    $("#back").data('go', 'backToDefault');
    hideElement($("#viewEstilos"));
    hideElement($("#newEstilo"));
    showElement($("#newSecuencia"));
    $idEstilo = $(this).data('dat')['id'];
    $avatar.secuencia.getById($idEstilo, $("#viewSecuencias"));
  });
  // guardar una nueva secuencia para el avatar
  $("#guardarSecuencia").click(function(){
    var accion = $(this).data('action');
    if(accion == 1){
      // Guardar
      var formData = new FormData($("#filesecuenceForm")[0]);
      formData.append('tipo_secuencia', $("#tipoSecuencia").val());
      formData.append('active', 1);
      formData.append('avatar_estilo_id', $idEstilo);
      $avatar.secuencia.guardar($(this), formData);
    }
  });
  // Eliminar secuencia de avatar
  $('body').on('click', '.eliminarSec', function(){
    var data = {
      'idEstilo' : $(this).data('dat')['avatar_estilo_id'],
      'isTipo' : $(this).data('dat')['tipo_secuencia_id']
    }

    var $el = $(this).parent().parent().parent();
    $avatar.secuencia.eliminar(data, $el);
  });

  // var urls='/asignar/juego/'+$("#subir_juego").attr('data-id-actividad');
  // var fileAdded;
  // Dropzone.options.myDropzone = {
  //   autoProcessQueue : false,
  //   uploadMultiple:false,
  //   maxFiles:10,
  //   maxFilesize:10000000,//MB
  //   success: function(file, response){
  //     $("#archivos").empty();
  //     console.log(response);
  //     if(response.archivos != null || response.archivos != undefined){
  //       $.each(response.archivos,function(i,archivo){
  //         var $img = $("<img/>");
  //         $img.attr({'title':archivo.nombre, 'style':'width:70px; height:70px;'});
  //         switch(archivo.tipo){
  //           case 'png':
  //             $img.attr({
  //               'src':'packages/images/icon-css.png',
  //               'rel':archivo.ruta,
  //               'title':archivo.name
  //             });
  //             break;
  //           }
  //           var $title = $('<label/>');
  //           var div = $("<div/>").addClass("col-md-4");
  //           div.append($img);
  //           div.append("<br>");
  //           div.append($title.text(archivo.nombre).css("word-wrap","break-word"));
  //           $("#archivos").append(div);
  //           $("#archivosUpload").removeClass('hide');
  //         });
  //         $curiosity.noty("El juego "+file.name+" se subio con exito","success");
  //       }
  //       else{
  //         $curiosity.noty(response.message,"warning");
  //       }
  //     },
  //     init:function(){
  //       var submitButton = document.getElementById('guardarSecuencia');
  //       myDropzone=this;
  //       submitButton.addEventListener("click",function(e){
  //         e.preventDefault();
  //         e.stopPropagation();
  //         myDropzone.processQueue();
  //       });
  //       var addedfile = false;
  //       this.on('addedfile',function(file){
  //         urls='/asignar/juego/'+$("#subir_juego").attr('data-id-actividad');
  //         this.options.url = urls;
  //         fileAdded=file;
  //         //Evento al agregar un archivo
  //         var toload = $("#toload").text();
  //         var total = parseFloat(toload) + 1;
  //         $("#toload").text(total);
  //         $("#removeFile").attr('disabled',false);
  //       });
  //       this.on('complete',function(file){
  //         //Evento al completar la carga
  //         $("#subirJuego").prop('disabled',false);
  //         myDropzone.removeFile(file);
  //         $("#toload").text(0);
  //         $("#subirJuego").empty();
  //         $("#subirJuego").append("<i class='fa fa-upload'></i> Subir Juego");
  //       });
  //       this.on("maxfilesexceeded",function(file){
  //         $curiosity.noty("Demasiado grande","warning");
  //       });
  //       this.on('success',function(file, response){
  //         actividad.hasGame();
  //         $("#subirJuego").prop('disabled',false);
  //         $("#bytesSent").text("");
  //         $("#progress").text("");
  //       });
  //       this.on('sending',function(files,response){
  //         $("#subirJuego").prop('disabled',true);
  //         $("#removeFile").attr('disabled',true);
  //         $("#subirJuego").text('Subiendo archivo...');
  //       });
  //     },
  //     uploadprogress: function(file, progress, bytesSent) {
  //       // Display the progress
  //       var progresAlt = parseFloat(progress).toFixed(2);
  //       var bytesAlt = parseFloat(bytesSent).toFixed(2);
  //       $("#bytesSent").text(bytesAlt+"KB");
  //       $("#progress").text(progresAlt+"%");
  //     }
  //   }
});
