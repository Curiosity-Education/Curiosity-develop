$(document).ready(function(){

  $curiosity.menu.setPaginaId("#menuAdminNavegadores");

  $.ajax({
   url:'/getBrowsers/30',
   method:'POST'
  })
  .done(function(response){
    if(response.length != 0){
      var datos = [];
      $.each(response, function(index, obj){
        datos.push({
          'browser' : response[index].browser,
          'uso_personas' : response[index].uso
        });
      });
      $('#tabla-browsers').bootstrapTable({
        data : datos
      });

    }
  });
});
