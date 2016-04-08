$(document).on('ready',function(){
  $curiosity.menu.setPaginaId('#menuNivel');
  
    var actividad = {
        //--hasGame se encarga de ver que actividades tienen juegos
        hasGame:function(){
              $.ajax({
                 url:'/hasgame',
                 method:'POST',
                 dataType:'JSON'
              }).done(function(response){                
                  $("#actividades").children('div').each(function(i,objeto){
                       console.log(objeto);
                        $.each(response,function(index,value){
                                  $(objeto).removeAttr('data-has-game');
                                  $(objeto).removeAttr('title');

                                  if($(objeto).children('div').attr('data-id') == value.actividad_id){
                                      
                                      $(objeto).attr('data-has-game',value.id);
                                      // $(objeto).attr('title','Juego: '+value.nombre.replace(".blade.php",""));
                                      $(objeto).attr('data-location-game','/juego/'+value.actividad_id+'/'+value.nombre.replace(".blade.php",""))
                                  }
                            });
                  });
              }).fail(function(error,status,statusText){
                  $curiosity.noty(error,"error");
                  console.log(status);
                  console.log(statusText);
              });
        }
    }
    
    // Boton ingresar
  $(".objeto").click(function(event) {
    if($(this).attr('data-location-game') != undefined)
       window.location.href=$(this).attr('data-location-game');
    else 
       $curiosity.noty("Actividad sin juego aun","warning");
  });
  actividad.hasGame();
});
