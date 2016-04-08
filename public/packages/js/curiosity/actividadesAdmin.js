$(document).ready(function() {

  $curiosity.menu.setPaginaId("#menuAdminNivel");

// arreglo con los colores preestablecidos
// en el css estandar del sistema curiosity
  var colores = Array(
    'bg-blue',
    'bg-green',
    'bg-red',
    'bg-purple',
    'bg-maroon',
    'bg-teal-active',
    'bg-yellow-active'
  );
//---Variables para el menu-desplegable
 var idActividad;
            var activity;
            var activity_move={
                 idActivityBeforeGame:this.idActivityBeforeGame,
                 idActivityNowGame:this.ActivityNowGame
            };
            var to_move=false;
    var desplegable=false;
//--Fin de var para menu desplegable

// creamos el objeto general en el que
// se declararan las funciones a utilizar
  var actividad = {
    //--hasGame se encarga de ver que actividades tienen juegos
    hasGame:function(){
      $.ajax({
         url:'/hasgame',
         method:'POST',
         dataType:'JSON'
      }).done(function(response){
          console.log(response);
          $("#actividades").children('div').each(function(i,objeto){
                $.each(response,function(index,value){
                          $(objeto).removeAttr('data-has-game');
                          $(objeto).removeAttr('title');

                          if($(objeto).attr('data-id') == value.actividad_id){
                              $(objeto).attr('data-has-game',value.id);
                              $(objeto).attr('title','Juego: '+value.nombre.replace(".blade.php",""));
                              $(objeto).children('.box').children('.box-footer').children('.row').children('div').children('#entrar-juego').attr('data-location-game','/juego/'+value.actividad_id+'/'+value.nombre.replace(".blade.php",""))
                          }
                    });
              desplegable=true;
          });
      }).fail(function(error,status,statusText){
          $curiosity.noty(error,"error");
          console.log(status);
          console.log(statusText);
      });
    },
    // funcion para limpiar el formulario
    // de administracion
    restablecerForm : function(){
      $("#nombre").val("");
      $("#descripcion").val("");
      $("#video").val("");
      $("#archivoPDF").val("");
      $.each($('#profesores > option'), function(index, obj){
      if($(this).val() == ""){
          $(this).attr('selected', 'selected');
        }
      });
    },
    // funcion para mostrar el formulario
    // de administracion y ocultar los cuadros
    showAdmin : function(){
      $("#viewSection").hide('slow');
      $("#adminSection").show('slow');
    },
    // funcion para mostrar nuevamente los cuadros
    // y ocultar el formulario de administracion
    hideAdmin : function(){
      $("#viewSection").show('slow');
      $("#adminSection").hide('slow');
      $("#botonEstatus").hide();
      actividad.restablecerForm();
    },
    // creando sub objeto en el cual se declaran
    // las funciones correspondientes al resgistro
    // y manipulacion de la informacion
    registro : {
      // sincroniza el DOM en tiempo de ejecucion agregando
      // un nuevo cuadro con la informacion del objeto
      // recien creado al momento de ser registrado
      sincronizar : function(titulo, color, id, descrip, estatusArg, imagen, idtema, idbloque, idnivel, idintell, video_id, code_embed, pdf, profe){
        var nuevo = "<div class='col-md-4 objeto' data-id="+id+" data-id-remove="+id+">"+
          "<div class='box box-widget widget-title'>"+
            "<div class='widget-title-header "+color+"'>"+
              "<h3 class='widget-title-set text-center' data-descrip='"+descrip+"' data-estatus="+estatusArg+" id="+id+">"+titulo+"</h3>"+
              "<h5 class='widget-title-desc'></h5>"+
            "</div>"+
            "<div class='widget-title-image'>"+
              "<img class='img-circle tooltipShow' title='Cambiar imagen' src='/packages/images/actividades/"+imagen+"' data-id-img="+id+">"+
            "</div>"+
            "<div class='box-footer'>"+
              "<div class='row'>"+
                "<div class='col-xs-4 border-right'>"+
                  "<div class='description-block btnUpdate' data-id = "+id+" data-id-video="+video_id+" data-code-embed='"+code_embed+"' data-pdf='"+pdf+"' data-prof-id="+profe+">"+
                    "<span class='fa fa-refresh fa-3x' title='Actualizar'></span>"+
                    "<br>"+
                    "<span class='description-text'>ACTUALIZAR<br></span>"+
                  "</div>"+
                "</div>"+
                "<div class='col-xs-4 border-right'>"+
                  "<div class='description-block btnRemove' data-id = "+id+">"+
                    "<span class='fa fa-remove fa-3x' title='Eliminar'></span>"+
                    "<br>"+
                    "<span class='description-text' >Eliminar</span>"+
                  "</div>"+
                "</div>"+
                "<div class='col-xs-4'>"+
                  "<div class='description-block btnIn' data-id-actividad="+id+" data-id-tema="+idtema+" data-id-inteligencia="+idintell+" data-id-nivel="+idnivel+" data-id-bloque="+idbloque+">"+
                    "<span class='fa fa-arrow-right fa-3x'></span>"+
                    "<br>"+
                    "<span class='description-text'>Ingresar</span>"+
                  "</div>"+
                "</div>"+
              "</div>"+
            "</div>"+
          "</div>"+
        "</div>";
        $("#viewSection").append(nuevo);
      },
      // registrar un nuevo objeto enviando como parametros
      // el boton al que se le da clic, la direccion donde
      // hará la funcion de registrar y la inteligencia al que este
      // pertenece.
      guardarAdd : function(boton, direccion, tema){
        var $btnEnviar = boton;
        $btnEnviar.attr('disabled', 'disabled');
        $btnEnviar.text('Guardando...');
        var color = Math.floor(Math.random()*7);
        var formData = new FormData($("#formPDF")[0]);
        formData.append('nombre', $("#nombre").val());
        formData.append('estatus', 'lock');
        formData.append('active', 1);
        formData.append('objetivo', $("#descripcion").val());
        formData.append('bg_color', colores[Math.floor(Math.random()*7)]);
        formData.append('tema_id', tema);
        formData.append('code_embed', $("#video").val());
        formData.append('profesores_id', $("#profesores").val());
        $.ajax({
          url: direccion,
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false
        })
        .done(function(response) {
          if($.isPlainObject(response)){
            $.each(response,function(index,value){
              $.each(value,function(i, message){
                $curiosity.noty(message, 'warning');
              });
            });
          }
          else if(response[0] == 'success'){
            actividad.registro.sincronizar(response[1][0].nombre, response[1][0].bg_color, response[1][0].id, response[1][0].descripcion, response[1][0].estatus, response[1][0].imagen, response[1][0].tema_id, response[1][0].bloque_id, response[1][0].nivel_id, response[1][0].inteligencia_id, response[1][0].video_id, response[1][0].code_embed, response[1][0].pdf, response[1][0].profesores_id);
            $curiosity.noty("Registrado Correctamente", "success");
            actividad.hideAdmin();
          }
          else if(response[0] == 'success_exist'){
            actividad.registro.sincronizar(response[1][0].nombre, response[1][0].bg_color, response[1][0].id, response[1][0].descripcion, response[1][0].estatus, response[1][0].imagen, response[1][0].tema_id, response[1][0].bloque_id, response[1][0].nivel_id, response[1][0].inteligencia_id, response[1][0].video_id, response[1][0].code_embed, response[1][0].pdf, response[1][0].profesores_id);
            $curiosity.noty("Se ha habilitado nuevamente", "success");
            actividad.hideAdmin();
          }
          else if(response[0] == 'same'){
            $curiosity.noty("El nombre ingresado ya existe", "warning");
          }
        })
        .fail(function(error) {
          console.log(error);
        })
        .always(function(){
          $btnEnviar.removeAttr('disabled');
          $btnEnviar.html("<i class='fa fa-check'></i> Guardar");
        });
      },
      // actualiza un objeto enviando como parametros
      // el boton al que se le da clic, la direccion donde
      // hará la funcion de actualizar, el id del cuadro
      // al que se le ha dado clic y el estatus es decir
      // si se encuentra bloqueado o desbloqueado
      guardarUpdate : function(boton, direccion, id, estatusNow, idProcedencia){
        var $btnEnviar = boton;
        $btnEnviar.attr('disabled', 'disabled');
        $btnEnviar.text('Guardando...');

        var formData = new FormData($("#formPDF")[0]);
        formData.append('nombre', $("#nombre").val());
        formData.append('objetivo', $("#descripcion").val());
        formData.append('code_embed', $("#video").val());
        formData.append('profesores_id', $("#profesores").val());
        formData.append('estatus', estatusNow);
        formData.append('procedenciaID', idProcedencia);
        formData.append('idUpdate', id);
        $.ajax({
          url: direccion,
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false
        })
        .done(function(response) {
          if($.isPlainObject(response)){
            $.each(response,function(index,value){
              $.each(value,function(i, message){
                $curiosity.noty(message, 'warning');
              });
            });
          }
          else if(response[0] == 'success'){
            $curiosity.noty("Actualizado Correctamente", "success");
            $("#"+id).text($("#nombre").val());
            $("#"+id).data('descrip', $("#descripcion").val());
            $("#"+id).data('estatus', estatusNow);
            $(".box-footer > .row > div > [data-id="+id+"]").data('code-embed', $("#video").val());
            actividad.hideAdmin();
          }
          else if(response[0] == 'same'){
            $curiosity.noty("El nombre ya existe", "warning");
          }
          else if(response[0] == 'same_exist'){
            $curiosity.noty("El nombre existe pero se encuentra deshabilitado", "warning");
          }
        })
        .fail(function(error) {
          console.log(error);
        })
        .always(function(){
          $btnEnviar.removeAttr('disabled');
          $btnEnviar.html("<i class='fa fa-check'></i> Guardar");
        });
      },
      // elimina el objeto seleccionado enviando el id del
      // cuadro al que se le ha dado clic
      remove : function(miId){
        var funcionRemover = function(){
          var datos = {
            id : miId
          };
          $.ajax({
            url: '/removeActividad',
            type: 'POST',
            data: {data: datos}
          })
          .done(function(response) {
            console.log(response);
            if($.isPlainObject(response)){
              $.each(response,function(index,value){
                $.each(value,function(i, message){
                  $curiosity.noty(message, 'warning');
                });
              });
            }
            else if(response[0] == 'success'){
              $("[data-id-remove="+miId+"]").hide('slow', function() {
                $(this).remove();
              });
            }
          })
          .fail(function(error) {
            console.log(error);
          });
        }
        $curiosity.notyConfirm(funcionRemover);
      },
      changeImagen : function(id){
        var formData = new FormData($("#imagenForm")[0]);
        $.ajax({
          url: "/changeImageActividad"+id+"",
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false
        })
        .done(function(response) {
          if(response[0] == 'success'){
            $(".widget-title-image > [data-id-img="+id+"]").attr('src', "/packages/images/actividades/"+response[1]);
            $curiosity.noty("Imagen cambiada Correctamente", "success");
          }
        })
        .fail(function(error) {
          console.log(error);
        });
      }
    }
  };

// -----------------------------------------------------------------

  // variables generales que funcionan para enviar como
  // parametros al momento de registrar o actualizar
  // un objeto
  var titulo = $("#nombre").val();
  var descripcion = $("#descripcion").val();
  var estatus;

  // funcion al dar clic en el boton de enviar en el
  // formulario de administracion
  $("#enviarEnv").click(function(event) {
    // se crea un switch para distinguir si el formulario
    // hace funcion de registro o actualizacion de la
    // informacion dependiendo del data-tipo que tiene
    // este boton
    switch ($(this).data('tipo')) {
      case 'add':
      var id_tema = $(this).data('tema');
      var id_bloque = $(this).data('bloque');
      var id_inteligencia = $(this).data('inteligencia');
      var id_nivel = $(this).data('nivelid');
      actividad.registro.guardarAdd($(this), "/adminActividad"+id_tema+"_"+id_bloque+"_"+id_inteligencia+"_"+id_nivel, id_tema);
        break;
        case 'update':
        actividad.registro.guardarUpdate($(this), '/updateActividad', $(this).data('updateId'), estatus, $(this).data('tema'));
          break;
    }
  });

  // click en el boton de cancelar en el formulario de
  // administracion
  $("#cancelarEnv").click(function(event) {
    actividad.hideAdmin();
  });

  // damos clic en el boton de agregar nuevo en la parte
  // donde estan los cuadros.
  // este boton nos permite mostrar el formulario de administracion
  // y establecerle al boton de enviar el data correspondiente en este caso
  // 'add' el cual servira para distingir que dicho boton hará la funcion
  // de registro en caso de ser presionado
  $('#addNew').click(function(event) {
    $("#enviarEnv").data('tipo', 'add');
    actividad.showAdmin();
  });

  // permitir dar clic en el boton de Actualizar ubicado en cada
  // cuadro de la pagina que permite ingresar al crud de actualizacion
  // cambiando el data-tipo del boton enviar a 'update'
  // para que el boton funcione para actualizar en caso de ser presionado
  $("#viewSection").on('click', '.objeto > .box > .box-footer > .row > div > .btnUpdate', function(event) {
    $("#enviarEnv").data('tipo', 'update');
    var idSelected = $(this).data('id');
    // le ponemos la boton de enviar un data con el id del
    // objeto que se ha dado clic esto para saber a cual
    // objeto se le hará la actualizacion del lado del
    // servidor
    $("#enviarEnv").data('updateId', idSelected);
    // se ponde el nombre y la descripcion del cuadro seleccionado
    // en los inputs correspondientes
    $("#nombre").val($("#"+idSelected).text());
    $("#descripcion").val($("#"+idSelected).data('descrip'));
    $("#video").val($(this).data('code-embed'));
    var idFromProfe = $(this).data('prof-id');
    $.each($('#profesores > option'), function(index, obj){
      if($(this).val() == idFromProfe){
        $(this).attr('selected', 'selected');
      }
    });
    // se pone el icono segun el estatus del objeto seleccionado
    estatus = $("#"+idSelected).data('estatus');
    if(estatus == "lock"){
      $("#btnLock").removeClass('fa-unlock');
      $("#btnLock").addClass('fa-lock');
    }
    else{
      $("#btnLock").removeClass('fa-lock');
      $("#btnLock").addClass('fa-unlock');
    }
    // se musestra el icono del candadito en el
    // formulario de la administracion
    $("#botonEstatus").show();
    // mostramos el formulario de administracion
    actividad.showAdmin();
  });

  // variable para determinar el estatus del objeto
  var isBlock = true;
  // damos click en el icono del candadito en el
  // formulario de administracion y guardamos el estatus
  // correspondiente al estado del candadito
  $("#btnLock").click(function(event) {
    if(isBlock){
      isBlock = false;
      $(this).removeClass('fa-lock');
      $(this).addClass('fa-unlock');
      estatus = "unlock";
    }
    else {
      isBlock = true;
      $(this).removeClass('fa-unlock');
      $(this).addClass('fa-lock');
      estatus = "lock";
    }
  });

  // acciones al dar clic en el boton de eliminar ubicado
  // en cada cuadro u objeto
  $("#viewSection").on('click', '.objeto > .box > .box-footer > .row > div > .btnRemove',function(event) {
    // obtenemos el id del objeto seleccionado
    var idSelected = $(this).data('id');
    // enviamos como parametro el id del objeto seleccionado
    // para eliminar dicho objeto en base a su id
    actividad.registro.remove(idSelected);
  });

  // asignar funcionalidad de input file a la imagen del objeto
  // para poder cambiarla al dar clic sobre ella
  var idImagenData;
  $("#viewSection").on('click', '.objeto > .box > .widget-title-image > img', function(){
    idImagenData = $(this).data('id-img');
    $("#up-image").trigger("click");
  });

  $("#up-image").change(function(event) {
    actividad.registro.changeImagen(idImagenData);
  });

  // Boton ingresar
  $("#viewSection").on('click', '.objeto > .box > .box-footer > .row > div > .btnIn',function(event) {
    if($(this).attr('data-location-game') != undefined)
       window.location.href=$(this).attr('data-location-game');
    else
       $curiosity.noty("Actividad sin juego aun","warning");
  });

   /* mostramos el menú si hacemos click derecho
            con el ratón */
            $(".activity").bind("contextmenu", function(e){
                      if(desplegable){
                          activity=this;
                          idActividad = $(this).attr('data-id');
                          console.log(idActividad);
                          $("#mover_juego,#asignar_juego,#eliminar_juego").removeClass('hide');
                          if($(this).attr('data-has-game') == undefined){
                               $("#mover_juego").addClass('hide');
                               $("#eliminar_juego").addClass('hide');
                          }
                          else{
                               $("#asignar_juego").addClass('hide');
                          }
                          $("#menu").removeClass('hide');
                          $("#menu").css({'display':'block', 'left':e.pageX, 'top':e.pageY});
                      }
                 return false;
            });

            $(".activity").click(function(){
                 if(!to_move){
                      $(activity).css('opacity','1');

                 }
                 else if($(this).attr('data-id') != activity_move.idActivityBeforeGame){
                      to_move = false;
                      activity_move.idActivityNowGame=$(this).attr('data-id');

                     $.ajax({
                         url:'/move/game',
                         method:'POST',
                         dataType:'JSON',
                         data:activity_move
                     }).done(function(response){
                         if($.isPlainObject(response)){
                             if(response.message == "success"){
                                $curiosity.noty("Se ha movido el juego con exito","success");
                                desplegable=false;
                                actividad.hasGame();
                             }
                             else
                                 $curiosity.noty("Ups no se ha podido realizar la accion","warning");
                         }
                     }).fail(function(error){
                            $curiosity.noty(error,"error");
                     });
                      $("#actividades").children('.activity').each(function(i,elemento){
                          if($(this).attr('data-id') == activity_move.idActivityBeforeGame){
                              $(this).css('opacity','1');
                          }
                      });
                 }
                 else{
                      $(activity).css('opacity','1');
                      to_move = false;
                 }
            });

            //cuando hagamos click, el menú desaparecerá
            $(document).click(function(e){
                  if(e.button == 0){
                        $("#menu").css("display", "none");

                  }
            });

            //si pulsamos escape, el menú desaparecerá
            $(document).keydown(function(e){

                  if(e.keyCode == 27){
                        console.log($(this).attr('data-object'));
                        $("#menu").css("display", "none");
                        $("#menu").addClass('hide');
                  }
            });

            //controlamos los botones del menú
            $("#menu").click(function(e){

                  // El switch utiliza los IDs de los <li> del menú
                  switch(e.target.id){
                        case "asignar_juego":
                              $("#subir_juego").attr('data-id-actividad',idActividad);
                              $("#subir_juego").modal('show');
                              break;
                        case "mover_juego":
                             $(activity).css('opacity','0.7');
                              activity_move.idActivityBeforeGame=$(activity).attr('data-id');
                              to_move=true;
                              break;
                        case "eliminar_juego":
                             $.ajax({
                                 url:'/delete/game',
                                 method:'POST',
                                 dataType:'JSON',
                                 data:{actividad_id:$(activity).attr('data-id')}
                             }).done(function(response){
                                 if($.isPlainObject(response)){
                                     if(response.message == "success"){
                                        $curiosity.noty("Se ha eliminado el juego con exito","success");
                                        desplegable=false;
                                        $("#actividades").children('div').each(function(i,objeto){

                                            $(objeto).removeAttr('data-has-game');
                                            $(objeto).removeAttr('title');
                                        });
                                        actividad.hasGame();
                                     }
                                     else
                                         $curiosity.noty("Ups no se ha podido realizar la accion","warning");
                                 }
                             });
                              break;
                  }

            });
    var urls='/asignar/juego/'+$("#subir_juego").attr('data-id-actividad');
    var fileAdded;
    Dropzone.options.myDropzone = {
            autoProcessQueue : false,
            uploadMultiple:false,
            maxFiles:10,
            maxFilesize:100000,//MB
            success: function(file, response){
                $("#archivos").empty();
                console.log(response);
                if(response.archivos != null || response.archivos != undefined){
                    $.each(response.archivos,function(i,archivo){
                        var $img = $("<img/>");
                        $img.attr({'title':archivo.nombre,
                                   'style':'width:70px; height:70px;'});
                        switch(archivo.tipo){
                            case 'css':
                                $img.attr({
                                    'src':'packages/images/icon-css.png',
                                    'rel':archivo.ruta,
                                    'title':archivo.name
                                });
                                break;
                            case 'js':
                                $img.attr({
                                    'src':'packages/images/icon-js.png',
                                    'rel':archivo.ruta,
                                    'title':archivo.name
                                });
                                break;
                            case 'php':
                                $img.attr({
                                    'src':'packages/images/page_php.png',
                                    'rel':archivo.ruta,
                                    'title':archivo.name
                                });
                                break;
                            case 'png':
                                $img.attr({
                                    'src':'packages/images/png_icons.png',
                                    'rel':archivo.ruta,
                                    'title':archivo.name
                                });
                                break;
                            case 'gif':
                                $img.attr({
                                    'src':'packages/images/gif_icons.png',
                                    'rel':archivo.ruta,
                                    'title':archivo.name
                                });
                                break;
                            case 'mp3':
                                $img.attr({
                                    'src':'packages/images/mp3_icons.png',
                                    'rel':archivo.ruta,
                                    'title':archivo.name
                                });
                                break;
                            case 'jpeg':
                                $img.attr({
                                    'src':'packages/images/jpeg_icons.png',
                                    'rel':archivo.ruta,
                                    'title':archivo.name
                                });
                                break;
                            case 'jpg':
                                $img.attr({
                                    'src':'packages/images/jpeg_icons.png',
                                    'rel':archivo.ruta,
                                    'title':archivo.name
                                });
                                break;
                        }
                        var $title = $('<label/>');
                        var div = $("<div/>").addClass("col-md-4");
                        div.append($img);
                        div.append("<br>");
                        div.append($title.text(archivo.nombre).css("word-wrap","break-word"));
                        $("#archivos").append(div);
                        $("#archivosUpload").removeClass('hide');
                    });
                    $curiosity.noty("El juego "+file.name+" se subio con exito","success");
                }
                else{
                    $curiosity.noty(response.message,"warning");
                }
            },

            init:function(){
                var submitButton = document.querySelector('#subirJuego');
                myDropzone=this;

                submitButton.addEventListener("click",function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });
                var addedfile = false;
                this.on('addedfile',function(file){
                        urls='/asignar/juego/'+$("#subir_juego").attr('data-id-actividad');
                        this.options.url = urls;
                        fileAdded=file;
                        //Evento al agregar un archivo
                        var toload = $("#toload").text();
                        var total = parseFloat(toload) + 1;
                        $("#toload").text(total);

                        $("#removeFile").attr('disabled',false);
                });
                this.on('complete',function(file){
                    //Evento al completar la carga
                    $("#subirJuego").prop('disabled',false);
                    myDropzone.removeFile(file);
                    $("#toload").text(0);
                    $("#subirJuego").empty();
                    $("#subirJuego").append("<i class='fa fa-upload'></i> Subir Juego");

                });

                this.on("maxfilesexceeded",function(file){
                    $curiosity.noty("Demasiado grande","warning");
                });
                this.on('success',function(file, response){
                    actividad.hasGame();
                    $("#subirJuego").prop('disabled',false);
                    $("#bytesSent").text("");
                    $("#progress").text("");

                });

                this.on('sending',function(files,response){
                    $("#subirJuego").prop('disabled',true);
                    $("#removeFile").attr('disabled',true);
                    $("#subirJuego").text('Subiendo archivo...');
                });

            },
            uploadprogress: function(file, progress, bytesSent) {
                // Display the progress
                $("#bytesSent").text(bytesSent+"KB");
                $("#progress").text(progress+"%");
            }

        }
    $("#close_modal").click(function(){
        $("#subir_juego").modal('hide');
        $("#archivos").empty();
        $("#archivosUpload").addClass('hide');
        $("#progress").text("");
    });
    $("#removeFile").click(function(){
         $("#removeFile").attr('disabled',true);
        if(fileAdded != null)
            myDropzone.removeFile(fileAdded);
    });

  // Disparamos el hasgame
    actividad.hasGame();

});
