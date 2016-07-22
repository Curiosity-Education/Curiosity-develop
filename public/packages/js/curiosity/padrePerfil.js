$(document).ready(function(){

  var indexCurrent = 0;
  var countCurrent = 0;
  var vueltas = 1;

  $curiosity.menu.setPaginaId("#menuPerfil");

  $("#edit_datos").click(function(event) {
    $("#editar_datos_papa").modal('show');
  });

  $("#slider-ul").find('li').first().addClass('slide-current');

});
