$(document).ready(function() {
  $curiosity.menu.setPaginaId('#menuNivel');

  $(".objetoPointer").click(function(event) {
    if($(this).data('estatus') == "unlock"){
      if($(this).data('rol') == 'hijo_free' || $(this).data('rol') == 'root' && $(this).data('prem') == 1){
        $curiosity.noty("Hazte PREMIUM y disfruta del conteido completo", "warning");
      }
      else{
        window.location.href="/actividad"+$(this).data('id');
      }
    }
    else{
      $curiosity.noty("Disponible próximamente", "warning");
    }
  });
});
