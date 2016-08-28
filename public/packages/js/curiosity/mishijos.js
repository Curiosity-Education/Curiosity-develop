$(document).ready(function() {

  $curiosity.menu.setPaginaId("#menuMisHijos");

  $("#showHelp").click(function(){
    $("#helper").modal('show');
  });

  $.validator.addMethod("alpha",alpha,"Formato no valido");
  $.validator.addMethod("promedio",promedio,"Formato no valido");

  function alpha(value, element, param){
    var er =/^[a-zA-Z_-ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöùúûüýøþÿÐdŒ\s]*$/;
    if(er.test(value)){
      return true;
    }else return false;
  }

  function promedio(value,element,param){
    var er = /^([0-9]{1}(\.[0-9]{1})?|10{1})$/;
    if(er.test(value)){
      return true;
    }else return false;
  }

  var dateNow = new Date();
  var dateOld = new Date();
  //restar 5 años a la fecha actual
  dateNow.setMonth(dateNow.getMonth() - 60);
  //restar 13 años a la fecha actual
  dateOld.setMonth(dateNow.getMonth() - 156);

  $('#fecha_nacimiento').pickadate({
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

  $("#promedio").mask("ABC", {placeholder:"0.0"}, {translation:{
      A:{pattern:/^[0-9]?$/},
      B:{pattern:/(\.)?/},
      C:{pattern:/([0-9])?$/}}
    }
  );

  $("#frm-reg-hijos").validate({
    rules:{
      nombre:{required:true,maxlength:50,alpha:true},
      apellido_paterno:{required:true,maxlength:30,alpha:true},
      apellido_materno:{required:true,maxlength:30,alpha:true},
      sexo:{required:true,maxlength:1},
      grado:{required:true},
      promedio:{required:true,promedio:true},
      fecha_nacimiento:{required:true,date:true},
      password:{required:true,minlength:8,maxlength:100},
      cpassword:{required:true,equalTo:function(){
        return $("input[name='password']");
      }},
      username_hijo:{
        required:true,maxlength:50,
        remote:{
          url:"/remote-username-hijo",
          type:"post",
          username:function(){
            return $("input[name='username_hijo']").val();
          }
        }
      }
    },
    messages:{
      cpassword:{equalTo:"Las contraseñas no coinciden"},
      username_hijo:{remote:"EL nombre de usuario que ingreso ya  esta en uso, intente con otro nombre."},
      nombre:{alpha:"Nombre invalido,solo puedes agregar letras."},
      apellido_paterno:{alpha:"Apellido invalido,solo puedes agregar letras."},
      apellido_materno:{alpha:"Apellido invalido,solo puedes agregar letras."}
    },
    errorPlacement: function (error, element) {
      error.appendTo(element.parent().parent());
    }
  });

  $("#btn-svh").click(function(){
    if($("#frm-reg-hijos").valid()){
      $btn = $(this);
      $btnc = $("#btn-clh");
      var text_temp = $(this).text();
      $(this).addClass("striped-alert");
      $(this).text("Registrando...");
      $(this).prop("disabled",true);
      $btnc.prop("disabled",true);
      datos={
        nombre:$("#nombre").val(),
        apellido_paterno:$("#apellido_paterno").val(),
        apellido_materno:$("#apellido_materno").val(),
        sexo:$("#sexo").val(),
        fecha_nacimiento:$("#fecha_nacimiento").val(),
        username_hijo:$("#username_hijo").val(),
        promedio:$("#promedio").val(),
        grado_inicial:$("#grado").val(),
        password:$("#password").val(),
        cpassword:$("#cpassword").val()
      }
      $.ajax({
        url:"/regHijo",
        type:"post",
        data:{data:datos}
      }).done(function(r){
        if(r[0]=="OK"){
          $curiosity.noty("EL niño fue registrado exitosamente","success");
          var codenew = "<div class='col-xs-6 col-sm-4 col-md-4'>"+
            "<div class='hijo_avatar' style='margin-bottom:20px;'>"+
            "<center>"+
            "<img src='/packages/images/perfil/"+r[1]+"' class='img-responsive img-rounded imgprfh'>"+
            "</center>"+
            "<div style='margin-top: 15px;margin-bottom: 20px;margin-left: 25px;'>"+
            "<p class='nombres'>"+ datos.nombre +" <br> "+ datos.apellido_paterno +" <br> "+ datos.apellido_materno +"</p>"+
            "<p class='nombres' style='color:black;'>"+ datos.username_hijo +"</p>"+
            "</div>"+
            "</div>"+
            "</div>";
            $("#thisAppnd").append(codenew);
            $("#secreghijo").hide('slow');
            $("#hijosInfo").show('slow');
            document.getElementById('frm-reg-hijos').reset();
          }else if($.isPlainObject(r)){
            alerta.errorOnInputs(r);
            mensage= "Algunos campos no fueron obtenido, porfavor verifique que todos los campos esten correctos";
            $curiosity.noty(message, 'warning');
            $btn.prop("disabled",false);
            return;
          }
        }).always(function(){
          $btnc.prop("disabled",false);
          $btn.text(text_temp);
          $btn.removeClass("striped-alert");
          $btn.prop("disabled",false);
        });
      }
  });

  $("#btn-clh").click(function(event) {
    $("#secreghijo").hide('slow');
    $("#hijosInfo").show('slow');
    document.getElementById('frm-reg-hijos').reset();
  });

  $(document).bind('keydown', function(e){
    if(e.which == 27){
      $("#secreghijo").hide('slow');
      $("#hijosInfo").show('slow');
      document.getElementById('frm-reg-hijos').reset();
    }
  });

});
