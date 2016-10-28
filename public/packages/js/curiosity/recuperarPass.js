$(document).on('ready',__init);

function __init(){
    $("#send_mail_rc").on('click',function(){
        var elemento = $(this);
        elemento.empty();
            elemento.attr('disabled','disabled');
            elemento.append("<i class='fa fa-spinner fa-pulse  fa-fw'></i><span class='sr-only'>Loading...</span>");
        var data = {
          email:$("#username").val()
        };


        if($("#username").val()  != ""){
            $.ajax({
                url:'/olvide-mi-contrasena',
                method:'POST',
                dataType:'JSON',
                data:data
            }).done(function(response){
                if($.isPlainObject(response)){
                    var status = (response.status == "200") ? "success" : "warning";
                    $curiosity.noty(response.message, status);
                    if(status == 200){
                        elemento.empty();
                        elemento.append("<span class='fa fa-key'></span> &nbsp;Cambio solicitado");
                    }
                    else{
                        elemento.empty();
                        elemento.append("<span class='fa fa-key'></span> &nbsp;Solicitar cambio");
                        elemento.removeAttr('disabled');
                    }

                }
            }).fail(function(error){
                console.log(error);
                $curiosity.noty("Oh! a ocurrido un error, te agradeceriamos que nos notifiques este error ","error");
            }).always(function(){
            });
        }
        else{
           $curiosity.noty("El email no puede estar vacio","info");
        }
    });

    $("#change_pass").on('click',function(){
        if($("#newPass").val() != "" && $("#rnewPass").val() != ""){
            if($('#newPass').val() == $("#rnewPass").val()){
                var elemento = $(this);
                var data = $("#frm_change_pass").serialize();
                elemento.empty();
                elemento.attr('disabled','disabled');
                elemento.append("<i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i><span class='sr-only'>Loading...</span>");
                $.ajax({
                    url:"/olvide-mi-contrasena/d4t4p4r4c4mbi0d3p45word",
                    method:'POST',
                    dataType:'JSON',
                    data:data
                }).done(function(response){
                    if($.isPlainObject(response)){
                        var status = (response.status == "200") ? "success" : "warning";
                        $curiosity.noty(response.message, status);
                        elemento.removeAttr('disabled');
                        elemento.html("<span class='fa fa-unlock'></span> &nbsp;Cambiar Contraseña");
                        elemento.removeAttr('disabled');
                    }
                }).fail(function(error){
                    console.log(error);
                    $curiosity.noty("Oh! a ocurrido un error, te agradeceriamos que nos notifiques este error. ERR-CU-RC-CP-01","error");
                }).always(function(){

                });
            }
            else{
                $curiosity.noty("Las contraseñas deben ser iguales. ","info");
            }
        }
        else{
            $curiosity.noty("Las contraseñas no pueden estar vacias","info");
        }
    });
}
