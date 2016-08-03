$(document).ready(function() {

    var $navbar = $('.navbar');
    var irOfrecemos = ($("#inicio").height() + $navbar.height());
    var irPagos = (irOfrecemos + $("#ofrecemos").height());
    var irEscuelas = (irPagos + $("#pagos").height() + 50);


    $("#link-inicio").click(function(){
      $('html, body').animate({scrollTop: 0}, 'slow');
    });

    $("#link-ofrecemos").click(function(){
      $('html, body').animate({scrollTop:irOfrecemos}, 'slow');
    });

    $("#link-escuelas").click(function(){
      $('html, body').animate({scrollTop: irEscuelas}, 'slow');
    });

    $("#link-pagos").click(function(){
      $('html, body').animate({scrollTop: irPagos}, 'slow');      
    });

    var $navbar = $('.navbar');
    $navbar.css({'transition':'.6s',"background":"transparent"});
    var heightNav = $navbar.height();
    var heightInit = ((heightNav)/2)/2;
    $navbar.find('a').css({'margin-top': heightInit+'px','transition':".6s"});
    $navbar.height(heightNav+20);
    $(window).scroll(function(){
        if($(window).scrollTop() >= $("#inicio").height()/6){
            $navbar.height(heightNav);
            $navbar.css("background","#2262ae");
            $(".navbar-collapse").css("background","#2d96ba");
            $navbar.find('a').css({'margin-top': (heightInit-16)+'px'});
        }
        else{
            $navbar.height(heightNav+20);
            $navbar.css("background","transparent");
            if($(window).width() <= 768)
                $(".navbar-collapse").css("background","#2262ae");
            else
                $(".navbar-collapse").css("background","transparent");
            $navbar.find('a').css({'margin-top': (heightInit)+'px'});
        }
    });

});
