$(document).ready(function() {


  $curiosity.menu.setPaginaId("#videosInicio");

  $.ajax({
   url:'/getAllVideosAdmin',
   method:'POST'
  })
  .done(function(response){
    if(response.length != 0){
      var datos = [];
      $.each(response, function(index, obj){
        datos.push({
          'grado' : response[index].nivel,
          'inteligencia' : response[index].inteligencia,
          'bloque' : response[index].bloque,
          'tema' : response[index].tema,
          'actividad' : response[index].actividad,
          'embedSelected' : response[index].code_embed
        });
      });
      $('#tabla-videos').bootstrapTable({
        data : datos
      });
    }
  });


});
