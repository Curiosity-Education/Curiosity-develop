$(document).on("ready",function(){
   $form = $("#frm-registro");
    $(".input-group-addon").css({"maxHeight":"45px"});
    $("input[name='telefono']").mask('(000) 000-0000',{placeholder:"(999) 999-9999"});
    $("input[name='codigo_postal']").mask("00000");
    $("input[name='numero']").mask("ABCDE",{translation:{
                                                    A:{pattern:/^[0-9]/},
                                                    B:{pattern:/([0-9])?/},
                                                    C:{pattern:/([0-9])?/},
                                                    D:{pattern:/([0-9])?/},
                                                    E:{pattern:/([A-Za-z]{1})?$/}
    }});
    // $("input[name='numero_tarjeta']").mask('0000-0000-0000-0000');
    // $("input[name='cvc']").mask('000');
    var dateNow = new Date();
    dateNow.setMonth(dateNow.getMonth()-216);//restar 19 años a la fecha actual
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
    // console.log($form);
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
       },
        validClass:'valid',
        errorPlacement: function (error, element) {
            error.appendTo(element.parent().parent());
         }
   });
    function alpha(value, element, param){
        var er =/^[a-zA-Z_-ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöùúûüýøþÿÐdŒ\s]*$/;
        if(er.test(value)){
            return true;
        }else return false;

    }
    // function cvc(value, element, param){
    //     var er = /[0-9]{3}/;
    //     if(er.test(value)){
    //         return true;
    //     }else return false;
    // }
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
    // $.validator.addMethod("telephone",telephone,"Numero telefónico invalido o incompleto");
    // $.validator.addMethod("cvc",cvc,"Por favor ingresa un cvc válido");
    // $.validator.addMethod("numero_casa",numero_casa,"Por favor ingresa un numero de casa valido. Ej 1, 12, 124, 1248, 1A, 12B, 124C, 1248C");
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
    $form.on("click","a[href='#finish']",function(ev){


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
        }
        if($form.valid()){
          $btn = $(this).prop("disabled",true);
          $btn.addClass("striped-alert");
          $(this).text("Enviando..");
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
                       alerta.errorOnInputs(r);
                       $curiosity.noty("Algunos campos no fueron obtenido, porfavor verifique que todos los campos esten correctos", "warning");
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
               $btn.text("finish");
               $btn.removeClass("striped-alert");
           }).fail(function(){
               $btn.prop("disabled",false);
           });
        }
});
// $("body").on("change","select[name='estado']",function(){
//         if($(this).val()!==""){
//             $("select[name='ciudad']").prop("disabled",true);
//             $("select[name='ciudad']").addClass("striped-alert");
//             $.ajax({
//                 type:"GET",
//                 url:"/getCiudades",
//                 data:{estado_id:$("select[name='estado']").val()}
//
//             })
//             .done(function(r){
//                 $("select[name='ciudad']").empty();
//                 $default = $("<option>",{value:"null"}).text("Ciudad");
//                 $("select[name='ciudad']").append($default);
//                 $.each(r,function(i,o){
//                     $option_ciudad=$("<option/>",{value:o.id}).text(o.nombre);
//                     $("select[name='ciudad']").append($option_ciudad);
//                 });
//             })
//             .always(function(){
//                $("select[name='ciudad']").prop("disabled",false);
//                $("select[name='ciudad']").removeClass("striped-alert");
//             });
//         }
//     });
});
