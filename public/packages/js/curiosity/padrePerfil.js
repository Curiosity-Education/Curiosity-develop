$(document).ready(function(){

  $curiosity.menu.setPaginaId("#menuPerfil");

  $("#edit_datos").click(function(event) {
    $("#sectionGral").hide('slow');
    $("#sectionChangeData").show('slow');
  });

  $(document).bind('keydown', function(e){
    if(e.which == 27){
      $("#sectionChangeData").hide('slow');
      $("#sectionGral").show('slow');
      document.getElementById('frm_user_papa').reset();
    }
  });

  $("#btn-clh").click(function(){
    $("#sectionChangeData").hide('slow');
    $("#sectionGral").show('slow');
    document.getElementById('frm_user_papa').reset();
  });

  var dateNow = new Date();
  var dateOld = new Date();
  //restar 18 años a la fecha actual
  dateNow.setMonth(dateNow.getMonth() - 216);
  //restar 99 años a la fecha actual
  dateOld.setMonth(dateNow.getMonth() - 1188);

  $('#fecha_nacimiento_persona').pickadate({
    monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado'],
    weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
    showMonthsShort: true,
    today: 'Hoy',
    clear: 'Limpiar',
    close: 'Cancelar',
    labelMonthNext: 'siguiente mes',
    labelMonthPrev: 'mes anterior',
    labelMonthSelect: 'menu de mes',
    labelYearSelect: 'menu de años',
    selectMonths: true,
    selectYears: 99,
    format: 'yyyy-mm-dd',
    min: [dateOld.getFullYear(),dateOld.getMonth(),dateOld.getDate()],
    max: [dateNow.getFullYear(),dateNow.getMonth(),dateNow.getDate()]
  });

  // Actualizar los datos del padre
  var $validar = $("#frm_user_papa").validate({
    rules:{
      username_persona:{maxlength:50,required:true,remote:{
        url:"/remote-username-update",
        type:"post",
        username:function(){
          return $("input[name='username']").val();
        }
      }},
      password_new:{maxlength:100,minlength:8},
      cpassword_new:{equalTo:function(){
        return $("input[name='password_new']");
      }},
      nombre_persona:{required:true,maxlength:50,alpha:true},
      apellido_paterno_persona:{required:true,maxlength:30,alpha:true},
      apellido_materno_persona:{required:true,maxlength:30,alpha:true},
      sexo_persona:{required:true,maxlength:1},
      fecha_nacimiento_persona:{required:true,date:true},
      email:{required:true,email:true}
    },
    messages:{
      cpassword_new:{equalTo:"La contraseña no coincide"},
      username_persona:{
        required:"No puedes dejaar en blanco este campo",
        remote:"Este nombre de usuario se encuentra en uso"
      },
      password_now:{remote:"La contraseña es incorrecta"},
      email:{email:"Formato de correo incorrecto"}
    },
    errorPlacement: function (error, element) {
      error.appendTo(element.parent().parent());
    }
  });

  $("#btn-svh").click(function(){
    if($validar.valid()){
      $btn =$(this);
      var text_temp = $(this).text();
      $(this).addClass("striped-alert");
      $(this).text("Actualizando...");
      $(this).prop("disabled",true);
      $("#btn-clh").prop("disabled",true);
      if($("input[name='password_new']").val()!==""){
        var datos={
          username_persona:$("input[name='username_persona']").val(),
          password_persona:$("input[name='password_persona']").val(),
          password_new:$("input[name='password_new']").val(),
          cpassword_new:$("input[name='cpassword_new']").val(),
          nombre_persona:$("input[name='nombre_persona']").val(),
          apellido_paterno_persona:$("input[name='apellido_paterno_persona']").val(),
          apellido_materno_persona:$("input[name='apellido_materno_persona']").val(),
          sexo_persona:$("select[name='sexo_persona']").val(),
          fecha_nacimiento_persona:$("input[name='fecha_nacimiento_persona']").val(),
          email:$("#email").val()
        }
        $.ajax({
          url:"/updatePerfil",
          type:"post",
          data:{data:datos},
          beforeSend: function(){
            message = "Espera.. Los datos se estan Actualizando... Verificando información";
            $curiosity.noty(message, 'info');
          }
        })
        .done(function(r){
          if($.isPlainObject(r)){
            $curiosity.noty("Algunos campos no fueron obtenidos... Favor de verificar la información  e intentar nuevamente ","warning");
          }else if(r == "contraseña incorrecta"){
            $curiosity.noty("Tu contraseña ingresada es incorreca","warning");
          }
          else if(r =="bien"){
            $("#fecha_nacimiento_persona").val(datos.fecha_nacimiento_persona);
            $("#menu-usuario").text(datos.nombre_persona+" "+datos.apellido_paterno_persona);
            $("#textEmail").text(datos.email);
            $("#textUser").text(datos.username_persona);
            $("#msj_bienvenida").text("Bienvenido "+datos.username_persona+"");
            $("input[name='password_persona']").val('');
            $("input[name='password_new']").val('');
            $("input[name='cpassword_new']").val('');
            $curiosity.noty("Los datos se han actualizado correctamente, su contraseña ha sido cambiada con exito!!","success");
            $("span#name-complete").text(datos.nombre_persona+" "+datos.apellido_paterno_persona+" "+datos.apellido_materno_persona);
            $("span#username-profile").text(datos.username_persona);
            $("label.error").remove();
            $("#btn-clh").trigger('click');
          }
        }).always(function(){
          $btn.text(text_temp);
          $btn.removeClass("striped-alert");
          $btn.prop("disabled",false);
          $("#btn-clh").prop("disabled",false);
        });
      }else{
        var datos = {
          username_persona:$("input[name='username_persona']").val(),
          nombre_persona:$("input[name='nombre_persona']").val(),
          apellido_paterno_persona:$("input[name='apellido_paterno_persona']").val(),
          apellido_materno_persona:$("input[name='apellido_materno_persona']").val(),
          sexo_persona:$("select[name='sexo_persona']").val(),
          fecha_nacimiento_persona:$("input[name='fecha_nacimiento_persona']").val(),
          email:$("#email").val()
        }
        $.ajax({
          url:"/updatePerfilUser",
          type:"post",
          data:{data:datos},
          beforeSend: function(){
            message = "Espera.. Los datos se estan Actualizando... Verificando información";
            $curiosity.noty(message, 'info');
          }
        }).done(function(r){
          if($.isPlainObject(r)){
            $curiosity.noty("Algunos campos no fueron obtenidos... Favor de verificar la información  e intentar nuevamente ","warning");
          }else if(r == "bien"){
            $("#fecha_nacimiento_persona").val(datos.fecha_nacimiento_persona);
            $("#menu-usuario").text(datos.nombre_persona+" "+datos.apellido_paterno_persona);
            $("#textEmail").text(datos.email);
            $("#textUser").text(datos.username_persona);
            $("#msj_bienvenida").text("Bienvenido "+datos.username_persona+"");
            $curiosity.noty("Los datos se han actualizado correctamente","success");
            $("label.error").remove();
            $("span#name-complete").text(datos.nombre_persona+" "+datos.apellido_paterno_persona+" "+datos.apellido_materno_persona);
            $("span#username-profile").text(datos.username_persona);
            $("#btn-clh").trigger('click');
          }
        }).always(function(r){
          $btn.text(text_temp);
          $btn.removeClass("striped-alert");
          $btn.prop("disabled",false);
          $("#btn-clh").prop("disabled",false);
        });
      }
    }
  });
  // Termina actualizar datos del padre

  $("#btnselectprofile").click(function(event) {
    $("#inImage").trigger('click');
  });


    $(".img-hijo").on('click',function(){
        crearGraficaJuegosJugados($(this).attr('data-id'));
        crearGraficaAvanceMeta($(this).attr('data-id'));
        $("#nom_hijo_s_est").text($("#name_hijo_s_mis_hijos_"+$(this).attr('data-id')).text());
        $(".container-estadisticas").show('slow');
        $("html,body").animate({scrollTop:$(".container-estadisticas").offset().top});
    });
    
    $(".back-misHijos").on('click',function(){
        $(".container-estadisticas").hide('slow');

    });
    
    $(".info-progress-day").click(function(){
        var infoJSON = JSON.parse($(this).attr('data-info'));
        infoJSON.miMeta = JSON.parse(JSON.stringify(infoJSON.miMeta));
        data = {
            tituloHelp:'Progreso de la meta diaria',
            description_helper:'El progreso del cumplimiento de la meta diaria de cada hijo se muestra en una gráfica donde se puede observar el porcentaje de avance que lleva en el día',
            subtitle_1:'Meta',
            description_subtitle:'La meta se compone de los siguientes elementos <br> <b>Nombre: </b>'+infoJSON.miMeta.nombre+'<br> <b>Meta:</b> '+infoJSON.miMeta.meta+' actividades <br> <b>Actividades realizadas: </b>'+(infoJSON.porcAvanceMeta*infoJSON.miMeta.meta/100)+'/'+infoJSON.miMeta.meta,
            note_helper:'El total de actividades a realizar depende de la meta seleccionada por el alumno'     
        };
        llenarHelper(data);
        
        
    });
    $(".info-uso-plataform").click(function(){
    
        data = {
            tituloHelp:'Estado de uso de la plataforma',
            description_helper:'Muestra el porcentaje de uso de la plataforma basado en las metas del día de cada uno de sus hijos. Esta gráfica se relaciona con el cumpliento de metas, recuerde que cuando la aguja se encuentre en color rojo, alguno o todos sus hijos no esta cumpliendo con todas sus metas del día',
            subtitle_1:'Estados de uso',
            description_subtitle:'<b>Rojo: </b> El uso de la plataforma es muy bajo y no se obtendran buenos resultados.<br> <b>Amarillo: </b> El uso de la plataforma es suficiente y en ocasiones se obtendran buenos resultados.<br> <b>Verde: </b> El uso de la plataforma es bueno  y hay mas posibilidades que se obtengan buenos resultados.<br>',
            note_helper:'Si sus hijos han cumplido con todas sus metas del día la aguja marcará en verde.'     
        };
        llenarHelper(data);
        
        
    });
    
    $(".info-uso-misHijos").click(function(){
    
        data = {
            tituloHelp:'Mis hijos',
            description_helper:'En esta sección se encuentra tus hijos registrados y su progreso en el día',
            subtitle_1:'Estadisticas',
            description_subtitle:'Puedes acceder a las estadisticas de cada uno de tus hijos dando un click en la imagen correspondiente a tu hijo',
            note_helper:'Las estadisticas de esta sección se generan con las actividades realizadas de tus hijos'     
        };
        llenarHelper(data);
        
        
    });
    
    $(".info-progress-game").click(function(){
        var infoJSON = JSON.parse($(this).attr('data-info'));
        
        var act_real = function(){
            var text='';
            var table = $('<table/>').addClass('table table-bordered table-hover col-md-12');
            var tbody = $('<tbody/>');
            table.append($('<thead/>').append($('<tr/>').append('<td>Actividad</td><td>Total de veces jugados</td><td>Porcentaje de los juegos totales</td>')));
            $.each(infoJSON,function(i,objeto){
                var tr = $('<tr/>');
                $.each(objeto,function(i,o){
                    var td = $('<td/>');
                    if(i == 'y')
                        td.append(parseFloat(o).toFixed(2)+'%');
                    else 
                        td.append(o);
                    tr.append(td);
                });
                tbody.append(tr);
            });
            return table.append(tbody);
        }
        data = {
            tituloHelp:'Desglose de las actividades realizadas',
            description_helper:'El desglose de las actividades se observa en una gráfica de pie la cual se muestra dividida en porcentajes ej. Si su hijo ha jugado 10 veces y de esas 10 veces a jugado 5 veces el tema sumas y restas entonces este aparecera con un porcentaje de 50% ',
            subtitle_1:'Actividades Realizadas',
            description_subtitle:act_real(),
            note_helper:'Las actividades que se muestran son las que el alumno ha realizado durante el transcurso del día'     
        };
        llenarHelper(data);
        
        
    });
    //Graficación juegos jugados!
    function crearGraficaJuegosJugados(idHijo){
        var ruta = '/desgloce/hijo/'+idHijo;
        $.ajax({
            url:'/desgloce/hijo/'+idHijo,
            method:'POST',
            dataType:'JSON'
        }).done(function(response){
            $(".info-progress-game").attr('data-info', JSON.stringify(response));
            var seriesGET = {
                name: 'Porcentaje',
                data: []
            };
            $.each(response,function(index,object){
                var yData = parseFloat(object.y).toFixed(2);
                var dataResponse = {
                    name : object.name,
                    y : yData - 0
                }
                seriesGET.data.push(dataResponse);
            });
            if(seriesGET.data[0] != undefined){
                $curiosityCharts.pieMonoChrome('#des_jue',{
                    title:'',
                    series: seriesGET
                });
            }

        }).fail(function(error){

        });
    }
    
    //Crear grafica avance meta 
    function crearGraficaAvanceMeta(idHijo){
        $.ajax({
            url:'getMeta/hijo/'+idHijo,
            method:'POST',
            dataType:'JSON'
        }).done(function(response){

            $(".info-progress-day").attr('data-info', JSON.stringify(response));
            $(".dial").val(response.porcAvanceMeta+'%');
            $(".dial").knob({
                readOnly:true,
                fgColor:"#f2dd49",
                angleOffset:0,
                font:'Helvetica'
            });
            $(".dial").val(response.porcAvanceMeta+'%');
        }).fail(function(error){
            
        });
    }
    
    function llenarHelper(data){
        $("#tituloHelp").text(data.tituloHelp);
        $(".description-helper").text(data.description_helper);
        $('#subtitle-1').text(data.subtitle_1);
        $('.description-subtitle').empty();
        $('.description-subtitle').append(data.description_subtitle);
        $('.note-helper').text(data.note_helper);
        $("#helper").modal('show');
    }
    crearGraficaUsoPlataforma();
    function crearGraficaUsoPlataforma(){
        $.ajax({
            url:'/obtenerUsoPlataforma',
            method:'POST',
            dataType:'JSON'
        }).done(function(response){
            $(".info-uso-plataform").attr('data-info',response);
            var dataResponse=0,index = 0,avgResponse=0;
            $.each(response,function(i,object){
                index++;
                avgResponse = (object.total_jugados*100)/object.meta;
                dataResponse += avgResponse;
            });
            if(dataResponse > 0)
                dataResponse = dataResponse/index;

            $curiosityCharts.gauge('#status',{
                name: 'Status',
                data: [dataResponse],
                tooltip: {
                    valueSuffix: '%'
                }
            });
        }).fail(function(error){
            
        });
        
    }
    
    //$curiosityCharts.column();
    

});
