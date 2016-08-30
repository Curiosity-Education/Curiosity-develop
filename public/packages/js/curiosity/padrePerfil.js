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

});
