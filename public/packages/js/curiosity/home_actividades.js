$(document).ready(function() {

  $curiosity.menu.setPaginaId('#menuInicioAct');
  $('#menuInicioAct > a').attr("href", "javascript:void(0)");

  var flagItem = 0;

  $.each($("#carrusel-list > .item"), function(index, obj) {
    if(flagItem === 0){
      $(this).addClass('active');
      $(".carousel-indicators").append("<li data-target='#myCarousel' data-slide-to='"+flagItem+"' class='active'></li>");
    }
    else{
      $(".carousel-indicators").append("<li data-target='#myCarousel' data-slide-to='"+flagItem+"'></li>");
    }
    flagItem = flagItem + 1;
  });

  $('body').on('click', '.gotoplay', function(){
    var $act = $(this).data('as');
    var $nombre = $act['nombreFile'].replace(".blade.php", "");
    var $prem = $act['premium'];
    var $lock = $act['estatus'];
    var $rol = $(this).data("r");
    if($lock == "unlock"){
      if($prem == 1 && $rol == "hijo_free"){
        console.log("es premium");
        $curiosity.notyPremium();
      }
      else{
        document.location.href = "/juego/" + $act['id'] + "/" + $nombre;        
      }
    }
    else{
      $curiosity.noty("Disponible próximamente", "warning");
    }
  });



});
