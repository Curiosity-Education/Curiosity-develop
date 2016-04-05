/*
* GEWIRO PLUGINS es un plugin creado para uso para el desarrollador y
* facilitar la realizacion de ciertas tareas básicas en el desarrollo de plataformas web
* herramienta de fácil uso y apresurar el desarrollo de los CRUD
* ALL RESERVED ......
*/

jQuery.fn.extend({
    login: function(options){
        defaults = {
           route:'',
           datas : this.serializeArray(),
           method: 'POST',
           returnData: 'JSON',
           messageSuccess: 'Success Login',
           redirectTo: '/',
           messageError: 'Error Login'
        };

        var options = $.extend({},defaults,options);

        $.ajax({
            url:options.route,
            type:options.method,
            dataType:options.returnData,
            data:options.datas
        }).done(function(response){
           if($.isPlainObject(response)){
               $.each(response,function(index,value){
                   $.each(value,function(i,message){
                       var n = noty({
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
                   });
               });
           }
           else if(response == 'success'){
               var n = noty({
                            layout: 'topRight',
                            theme: 'defaultTheme', // or 'relax'
                            type: 'success',
                            text: options.messageSuccess,
                            animation: {
                                open: {height: 'toggle'}, // jQuery animate function property object
                                close: {height: 'toggle'}, // jQuery animate function property object
                                easing: 'swing', // easing
                                speed: 300 // opening & closing animation speed
                            }
                        });
               window.location=options.redirectTo;
           }
           else{
               var n = noty({
                            layout: 'bottomRight',
                            theme: 'defaultTheme', // or 'relax'
                            type: 'information',
                            text: 'La contraseña del usuario no es valida',
                            animation: {
                                open: {height: 'toggle'}, // jQuery animate function property object
                                close: {height: 'toggle'}, // jQuery animate function property object
                                easing: 'swing', // easing
                                speed: 300 // opening & closing animation speed
                            }
                        });
           }
        }).fail(function(error,status,statusText){
            swal({
                title: options.messageError+': '+statusText,
                text: 'Error descrito en consola',
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#e03939",
                confirmButtonText: "Entendido..",
                closeOnConfirm: false });
            console.log(error);
            console.log(statusText);
            console.log(status);
        });
    },
    crud:function(options){

        defaults = {
           route:'',
           datas : this.serializeArray(),
           method: 'POST',
           returnData: 'JSON',
           action:'read',
           messageSuccess: 'Success',
           messageError: 'Error'
        }

        var options = $.extend({},defaults,options);
        return $.ajax({
            url:options.route,
            type:options.method,
            dataType:options.returnData,
            data:options.datas
        });

    }
});
