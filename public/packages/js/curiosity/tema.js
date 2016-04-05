$(document).ready(function() {
  $(".objetoPointer").click(function(event) {
    if($(this).data('estatus') == "unlock"){
      window.location.href="/actividad"+$(this).data('id');
    }
    else{
      $curiosity.noty("El elemento se encuentra bloqueado", "warning");
    }
  });
});
