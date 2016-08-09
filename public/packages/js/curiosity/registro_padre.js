$(document).on("ready",function(){

  var dateNow = new Date();
  var dateOld = new Date();
  dateNow.setMonth(dateNow.getMonth() - 216);//restar 19 años a la fecha actual
  dateOld.setMonth(dateNow.getMonth() - 1080);//restar 99 años a la fecha actual

  // Inicializacion
  new WOW().init();

  $(function () {
    $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
  });

  $('.mdb-select').material_select();

  $('.datepicker2').pickadate({
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

  // Variable para la comprobacion de terminos y condiciones
  var aceptedTerms = false;

  // Marcamos en selected los terminos segun su estado
  $("#terms").click(function(event) {
    if (aceptedTerms){
      aceptedTerms = false;
      $(this).removeClass('fa-check-square');
      $(this).addClass('fa-square-o');
    }
    else{
      aceptedTerms = true;
      $(this).removeClass('fa-square-o')
      $(this).addClass('fa-check-square');
    }
  });

  $form = $("#frm-registro");
  // $(".input-group-addon").css({"maxHeight":"45px"});
  // $("input[name='telefono']").mask('(000) 000-0000',{placeholder:"(999) 999-9999"});
  // $("input[name='codigo_postal']").mask("00000");
  $("input[name='numero']").mask("ABCDE",{
    translation:{
      A:{pattern:/^[0-9]/},
      B:{pattern:/([0-9])?/},
      C:{pattern:/([0-9])?/},
      D:{pattern:/([0-9])?/},
      E:{pattern:/([A-Za-z]{1})?$/}
    }});

  $('.datepicker').datepicker({
    "language":"es",
    "format" : "yyyy-mm-dd",
    "endDate":dateNow.getFullYear()+"/"+dateNow.getMonth()+"/"+dateNow.getDate(),
    "autoclose": true,
    "todayHighlight" : true
  });

  dateNew = new Date();

  $("input[name='fecha_expiracion']").datepicker({
    "language":"es",
    "format" : "yyyy-mm-dd",
    "startDate":dateNew.getFullYear()+"/"+dateNew.getMonth()+"/"+dateNew.getDate(),
    "minDate":dateNew.getFullYear()+"/"+dateNew.getMonth()+"/"+dateNew.getDate(),
    "autoclose": true,
    "todayHighlight" : true
  });

   /*----------------------
   Aplicar reglas de
   Validacion al formulario
   -----------------------*/
  $form.validate({
     rules:{
         username:{required:true,maxlength:50,remote:{
          url:"/remote-username",
          type:"post",
          username:function(){
            return $("input[name='username']").val();
          }
         }},
         password:{required:true,minlength:8,maxlength:100},
         cpassword:{required:true,equalTo:function(){
          return $("input[name='password']");
         }},
         email:{required:true,email:true,maxlength:255,remote:{
             url:"/remote-email",
             type:"post",
             email:function(){
                 return $("input[name='email']").val();
             }
         }},
         nombre:{required:true,maxlength:50,alpha:true},
         apellido_paterno:{required:true,maxlength:30,alpha:true},
         apellido_materno:{required:true,maxlength:30,alpha:true},
         sexo:{required:true,maxlength:1},
         fecha_nacimiento:{required:true,date:true}
     },
     messages:{
         cpassword:{equalTo:"Las contraseñas no coinciden"},
         username:{remote:"EL nombre de usuario que ingreso ya  esta en uso, intente con otro nombre."},
         nombre:{alpha:"Nombre invalido,solo puedes agregar letras."},
         apellido_paterno:{alpha:"Apellido invalido,solo puedes agregar letras."},
         apellido_materno:{alpha:"Apellido invalido,solo puedes agregar letras."},
         email:{remote:"El correo que ingreso ya esta en uso, intente con otra dirección de correo electronico"}
     }
  });

  function alpha(value, element, param){
    var er =/^[a-zA-Z_-ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöùúûüýøþÿÐdŒ\s]*$/;
    if(er.test(value)){
        return true;
    }else return false;
  }

  function numero_casa(value, element, param){
    var er = /^([0-9])([0-9]{1,3})?([A-Za-z]{1})?$/;
    if(er.test(value)){
      return true;
    }else return false;
  }

  function telephone(value, element, param){//regla de validacion de numeros de telefono
    var er = /^\([0-9]{3}\){1}\s[0-9]{3}\-[0-9]{4}/;// (999) 999-9999
    if(er.test(value)){
      return true;
    }else return false;
  }

  $.validator.addMethod("alpha",alpha,"Formato no valido");

  /*----------------------------------------------------
      function para limpiar el texto del formulario
  ----------------------------------------------------*/
  function clearText(text){
    var texto = text.replace(/\s/g,"");
    return texto;
  }

 /*----------------------------------------------------
       Evento key press del username
 ------------------------------------------------------*/
  $("body").on("keypress","input[name='username']",function(){
    $(this).val(clearText($(this).val()));

  });
  $("body").on("focusout","input[name='username']",function(){
    $(this).val(clearText($(this).val()));
  });

  /*-------------------------------------------------
      click t finish the formulario
  --------------------------------------------------*/
  $('body').on("click","#regAc",function(ev){
    var datos ={
      username:$("input[name='username']").val(),
      password:$("input[name='password']").val(),
      cpassword:$("input[name='cpassword']").val(),
      email:$("input[name='email']").val(),
      nombre:$("input[name='nombre']").val(),
      apellido_paterno:$("input[name='apellido_paterno']").val(),
      apellido_materno:$("input[name='apellido_materno']").val(),
      sexo:$("select[name='sexo']").val(),
      fecha_nacimiento:$("input[name='fecha_nacimiento']").val()
    };
    if($form.valid()){
      if(aceptedTerms){
        $btn = $(this).prop("disabled",true);
        $btn.addClass("striped-alert");
        $(this).text("Enviando..");
        console.log(datos);
        console.log("enviando....");
         $.ajax({
             type:"POST",
             url:"/regPadre",
             data:{data:datos},
             beforeSend: function(){
              message = "Espera.. Los datos se estan guardando... Verificando información";
              $curiosity.noty(message, "info");
              },
             success:function(r){
               console.log(r);
                  if($.isPlainObject(r)){
                     $.each(r,function(index,value){
                       $.each(value,function(i, message){
                         $curiosity.noty(message, 'warning');
                       });
                     });
                     $btn.prop("disabled",false);

                     return;
                  }
                 else if(r=="0"){// cero es el codigo de exception cuando se pierde la conexón a internet
                      $curiosity.noty("El registro no fue realizado por que se perdio la conexón a internet durante el proceso, verifique su conexión a internet e intente de nuevo", "error");
                     $btn.prop("disabled",false);
                 }
                 else if(r=="OK"){
                  $("input").val("");
                   swal({
                     title: "¡Registro Exitoso!",
                     text : "El registro fue realizado exitosamente. Se ha enviado un correo de verifcación a su cuenta para poder confirmar su registro. Favor de verificar el correo electrónico",
                     type: "success",
                     showCancelButton: false,
                     confirmButtonColor: "#3cb54a",
                     confirmButtonText: "Aceptar",
                     closeOnConfirm: true
                   },
                   function(){
                     document.location.href = '/';
                   });
                 }
             }
           }).always(function(){
               $btn.text("Guardar");
               $btn.removeClass("striped-alert");
           }).fail(function(){
               $btn.prop("disabled",false);
           });
      }
      else{
        swal({
          title: "Registro incompleto",
          text : "El registro no ha podido ser completado debido a que no se han aceptado los términos y condiciones establecidos por Curiosity Educación. Para continuar con el registro porfavor verifique su información",
          type: "info",
          showCancelButton: false,
          confirmButtonColor: "#3c61b5",
          confirmButtonText: "Aceptar",
          closeOnConfirm: true
        });
      }
    }
  });

  $("#regcanceled").click(function(event) {
    $("input").val("");
    aceptedTerms = false;
    $("#terms").removeClass('fa-check-square');
    $("#terms").addClass('fa-square-o');
  });

});
