$(document).ready(function(){

    $curiosity.menu.setPaginaId("#menuPerfil");
    $("#promedio").mask("ABC",{placeholder:"0.0"},{translation:{
                                                    A:{pattern:/^[0-9]?$/},
                                                    B:{pattern:/(\.)?/},
                                                    C:{pattern:/([0-9])?$/}
    }});
    var username = $("input[name='username']").val();
    var telefono = $("input[name='telefono']").val();
    $("#frm-reg-admins").on("click","a[href='#finish']",function(){
        $btn = $(this);
        var text = $btn.text();
        $btn.text("Almacenando ...");
        $btn.addClass('striped-alert');
        $btn.prop('disabled',true);
        if($('#frm-reg-admins').valid()){
            $.ajax({
                url:"/regAdmin",
                type:"post",
                data:$('#frm-reg-admins').serialize(),
                beforeSend: function(){
                    message = "Espera.. Los datos se estan Almacenando... Verificando información";
                    after = noty({
                                layout: 'bottomRight',
                                theme: 'defaultTheme', // or 'relax'
                                type: 'information',
                                text: message,
                                animation: {
                                    open: {height: 'toggle'}, // jQuery animate function property object
                                    close: {height: 'toggle'}, // jQuery animate function property object
                                    easing: 'swing', // easing
                                    speed: 300 // opening & closing animation speed
                                }
                            });
                    }
            }).done(function(r){
                after.close();
                console.log(r);
                if(r.estado==200){
                    $curiosity.noty(r.message,"success");
                    $("#wizard-admin-t-0").trigger("click");
                    document.getElementById('frm-reg-admins').reset();
                }else if(r.estado==500){
                    $curiosity.noty(r.message,"warning");

                }else if($.isPlainObject(r)){
                   alerta.errorOnInputs(r);
                   $curiosity.noty("Algunos campos no fueron obtenido, porfavor verifique que todos los campos esten correctos", 'warning');
               }
            }).always(function(){
                after.close();
                $btn.text(text);
                $btn.removeClass('striped-alert');
                $btn.prop("disabled",false);
            }).fail(function(error){
                $curiosity.noty(error.message,"error");
            });
        }
    });
    $("#frm_user").on("change","select[name='estado']",function(){
        if($(this).val()!==""){
            $("select[name='ciudad_id']").prop("disabled",true);
            $("select[name='ciudad_id']").addClass("striped-alert");
            $.ajax({
                type:"GET",
                url:"/getCiudades",
                data:{estado_id:$("select[name='estado']").val()}

            })
            .done(function(r){
                $("select[name='ciudad_id']").empty();
                $default = $("<option>",{value:"null"}).text("Ciudad");
                $("select[name='ciudad_id']").append($default);
                $.each(r,function(i,o){
                    $option_ciudad=$("<option/>",{value:o.id}).text(o.nombre);
                    $("select[name='ciudad_id']").append($option_ciudad);
                });
            })
            .always(function(){
               $("select[name='ciudad_id']").prop("disabled",false);
               $("select[name='ciudad_id']").removeClass("striped-alert");
            });
        }
    });

    $("#frm_user input[name='username']").keypress(function(){
        if($(this).valid()){
         $(this).next().remove();
        }
    });
    $("#frm-reg-hijos").on("change","#escuela_id",function(){
        if($(this).val()==="0"){
            $(this).hide();
            $("#return-fa-normal").hide();
            $("#esc_alt").removeClass('hidden');
            $("#return-select-school").removeClass("hidden");
            $("#return-select-school").show();
            $("#esc_alt").show();
        }
    });
    $("#frm-reg-hijos").on("click","#return-select-school",function(){
        $("#return-fa-normal").show();
        $("#esc_alt").hide();
        $(this).hide();
        $("#escuela_id").show();
        $("#escuela_id").val($("#escuela_id").children().first().val());
        $("#esc_alt").val("");

    });


    //evento click en el boton restaurar
    $("#rest").click(function(){
        $("input[name='username']").val(username);
        $("input[name='telefono']").val(telefono);
    });
    //mandar los datos ha actualizar por el usuario
    $("#frm-reg-admins").validate({
        rules:{
            username_admin:{required:true,maxlength:50,remote:{
                url:"/remote-username-admin",
                type:"post",
                username:function(){
                  return $("input[name='username_admin']").val();
                }
             }},
           //  nombre_admin:{required:true,maxlength:50,alpha:true},
             apellido_paterno_admin:{required:true,maxlength:30,alpha:true},
             apellido_materno_admin:{required:true,maxlength:30,alpha:true},
             sexo_admin:{required:true,maxlength:1},
             role:{required:true,maxlength:1,numeric:true}, 
             fecha_nacimiento_admin:{required:true,date:true},
             password_admin:{required:true,minlength:8,maxlength:100},
             cpassword_admin:{required:true,equalTo:function(){
               return $("input[name='password_admin']");
             }},
         },
      messages:{
           cpassword_admin:{equalTo:"Las contraseñas no coinciden"},
           username_admin:{remote:"EL nombre de usuario que ingreso ya  esta en uso, intente con otro nombre."},
           nombre_admin:{alpha:"Nombre invalido,solo puedes agregar letras."},
           apellido_paterno_admin:{alpha:"Apellido invalido,solo puedes agregar letras."},
           apellido_materno_admin:{alpha:"Apellido invalido,solo puedes agregar letras."}
       },
        errorPlacement: function (error, element) {
            error.appendTo(element.parent().parent());
         }

    });
    $("#frm-reg-hijos").validate({
        rules:{
             nombre:{required:true,maxlength:50,alpha:true},
             apellido_paterno:{required:true,maxlength:30,alpha:true},
             apellido_materno:{required:true,maxlength:30,alpha:true},
             sexo:{required:true,maxlength:1},
             escuela_id:{required:true,maxlength:100},
             web:{maxlength:100},
             promedio:{required:true,promedio:true},
             fecha_nacimiento:{required:true,date:true},
             password:{required:true,minlength:8,maxlength:100},
             cpassword:{required:true,equalTo:function(){
               return $("input[name='password']");
             }},
             esc_alt:{maxlength:200},
             username_hijo:{required:true,maxlength:50,remote:{
                url:"/remote-username-hijo",
                type:"post",
                username:function(){
                  return $("input[name='username_hijo']").val();
                }
             }}

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
     $.validator.addMethod("alpha",alpha,"Formato no valido");
     $.validator.addMethod("promedio",promedio,"Formato no valido");
     $.validator.addMethod("numero_casa",numero_casa,"Por favor ingresa un numero de casa valido. Ej 1, 12, 124, 1248, 1A, 12B, 124C, 1248C");
     $.validator.addMethod("telephone",telephone,"Numero telefónico invalido o incompleto");
     // creamos una nueva regla de validacion para el input de telefono
     function telephone(value, element, param){//regla de validacion de numeros de telefono
        var er = /^\([0-9]{3}\){1}\s[0-9]{3}\-[0-9]{4}/;// (999) 999-9999
        if(er.test(value)){
          return true;
        }else return false;
    }
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
    function promedio(value,element,param){
        var er = /^([0-9]{1}(\.[0-9]{1})?|10{1})$/;
        if(er.test(value)){
            return true;
        }else return false;
    }
    $(".list-hijos>li").click(function(){
        $(".list-hijos>li").removeClass("active");
        $(this).addClass("active");
    });
    $("#frm-reg-hijos").on("click","a[href='#finish']",function(){
        if($("#frm-reg-hijos").valid()){
            $btn = $(this);
             var text_temp = $(this).text();
            $(this).addClass("striped-alert");
            $(this).text("Registrando...");
            $(this).prop("disabled",true);
            datos={
                nombre:$("#nombre").val(),
                apellido_paterno:$("#apellido_paterno").val(),
                apellido_materno:$("#apellido_materno").val(),
                sexo:$("#sexo").val(),
                fecha_nacimiento:$("#fecha_nacimiento").val(),
                escuela_id:$("#escuela_id").val(),
                username_hijo:$("#username_hijo").val(),
                promedio:$("#promedio").val(),
                password:$("#password").val(),
                cpassword:$("#cpassword").val(),
                esc_alt:$("#esc_alt").val()
            }
            $.ajax({
                url:"/regHijo",
                type:"post",
                data:{data:datos},
                beforeSend: function(){
                message = "Espera.. Los datos se estan guardando... Verificando información";
                after = noty({
                            layout: 'bottomRight',
                            theme: 'defaultTheme', // or 'relax'
                            type: 'information',
                            text: message,
                            animation: {
                                open: {height: 'toggle'}, // jQuery animate function property object
                                close: {height: 'toggle'}, // jQuery animate function property object
                                easing: 'swing', // easing
                                speed: 300 // opening & closing animation speed
                            }
                        });
                }

            }).done(function(r){
                console.log(r);
                if(r=="OK"){
                    //alerta.show("Registro Exitoso","EL niño fue registrado exitosamente","success-alert striped",true);
                    $curiosity.noty("EL niño fue registrado exitosamente","success");
                    document.getElementById('frm-reg-hijos').reset();
                    $("#wizard-t-0").trigger("click");

                }else if($.isPlainObject(r)){
                   alerta.errorOnInputs(r);
                   after.close();
                   //alerta.show("Registro no Exitoso","Algunos campos no fueron obtenido, porfavor verifique que todos los campos esten correctos","warning-alert striped-alert",true);
                   mensage= "Algunos campos no fueron obtenido, porfavor verifique que todos los campos esten correctos";
                   $curiosity.noty(message, 'warning');
                   $btn.prop("disabled",false);
                   return;
               }
            }).always(function(){
                 after.close();
                 $btn.text(text_temp);
                 $btn.removeClass("striped-alert");
                 $btn.prop("disabled",false);
            });
        }
    });

});
