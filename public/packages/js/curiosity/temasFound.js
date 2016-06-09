$(document).ready(function() {

  $(".largeCard").click(function(event) {
    var estatus = $(this).data('estatus');
    var rol = $(this).data('rol');
    var prem = $(this).data('prem');
    if(estatus == "unlock"){
      if(rol == 'hijo_free' || rol == 'root' &&  prem == "1"){
        $curiosity.notyPremium();        
      }
      else{
        window.location.href="/actividad"+$(this).data('found');
      }
    }
    else{
      $curiosity.noty("Disponible próximamente", "warning");
    }
  });

});
