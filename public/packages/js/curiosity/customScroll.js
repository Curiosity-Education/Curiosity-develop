$(document).ready(function() {

    var irOfrecemos = ($("#inicio").height() + 25);
    var irPagos = (irOfrecemos + $("#ofrecemos").height());
    var irEscuelas = (irPagos + $("#pagos").height() + 50);

    $("#link-inicio").click(function(){
      $('html, body').animate({scrollTop: 0}, 'slow');
    });

    $("#link-ofrecemos").click(function(){
      $('html, body').animate({scrollTop: irOfrecemos}, 'slow');
    });

    $("#link-escuelas").click(function(){
      $('html, body').animate({scrollTop: irEscuelas}, 'slow');
    });

    $("#link-pagos").click(function(){
      $('html, body').animate({scrollTop: irPagos}, 'slow');      
    });

});
