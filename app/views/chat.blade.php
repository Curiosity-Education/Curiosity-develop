<!DOCTYPE html>
<html lang="es">
<head>
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Expires" CONTENT="-1">
    <title></title>
    {{HTML::style('/packages/css/libs/bootstrap/bootstrap.min.css')}}
    {{HTML::style('/packages/css/awensome/css/font-awesome.min.css')}}
</head>
<body>
    <div class="col-md-3"></div>
    <div class="col-md-6">
       <div class="row">
           <div class="col-md-6">
               <input type="text" class="form-control col-md-6" id="nombre" placeholder="Nombre de usuario">
           </div>
           <div class="col-md-6">
               <input type="text" class="form-control col-md-6" id="chat-message" placeholder="Mensaje a todos">
           </div>
       </div>
        <div id="chat-log"></div>
    </div>
    <div class="col-md-3"></div>
</body>
{{HTML::script('/packages/js/libs/jquery/jquery.min.js')}}
{{HTML::script('/packages/js/curiosity/BrainSocket.js')}}
{{HTML::script('/packages/js/curiosity/BrainSocketPub.js')}}
<script>
    var fake_user_id = Math.floor((Math.random()*1000)+1);
    //Se declara una id falsa de un usuario
    window.app = {};
    app.BrainSocket = new BrainSocket(
            new WebSocket('wss://www.curiosity.com.mx:7070'),
            new BrainSocketPubSub()
    );
    //Instancia del websocket :D
    //primer parametro es la url
    //segundo es el objeto BrainSocketPubSub()
    app.BrainSocket.Event.listen('generic.event',function(msg){
        if(fake_user_id==msg.client.data.user_id){
            $('#chat-log').append('<div> Yo : '+msg.client.data.message+'</div>');
        }else{
            $('#chat-log').append('<div class="alert alert-info">'+msg.client.data.name+': '+msg.client.data.message+'</div>');
        }
    });
    //en el evento generico (cualquiera) se va a poner el mensaje de los usuarios conectados
    app.BrainSocket.Event.listen('app.success',function(data){
        console.log('Mensaje enviado con exito');
        console.log(data);
    });
    //en caso de que el mensaje se envie correctamente
    app.BrainSocket.Event.listen('app.error',function(data){
        console.log('Hubo una falla al enviar el mensaje');
        console.log(data);
    });
    //En caso de que el mensaje falle
    $('#chat-message').keypress(function(event) {
        var message = $(this).val();
    if(event.keyCode == 13){
            app.BrainSocket.onopen(function()
             {
                // this executes as soon as the connection is established.
                app.BrainSocket.message('generic.event',
                    {
                        'message':message,
                        'user_id':fake_user_id,
                        'name':$("#nombre").val()
                    }
                );
                $("#nombre").attr("readonly",true);
                //aqui se le dice que el mensaje va en el evento generico, se le manda el mensaje y el user id
                $(this).val('');
            });
        }
            return event.keyCode != 13;
    });
    //envio del mensaje
</script>
</html>