$(document).ready(function() {

  $curiosity.menu.setPaginaId('#menuTiendaAvatar');
  $sprite.putSpriteSelected('esperar', $("#miAvatar"));

  $('body').on('click', '.sk', function(){
    var prev = $(this).find('img').attr('src');
    var skin = $(this).attr('id').replace('sku', '');
    $tienda.skin.utilizar(prev, skin);
  });

  $("body").on('click', '.skout', function(){
    var prev = $(this).find('img').attr('src');
    var skin = $(this).attr('id').replace('sku', '');
    $tienda.skin.comprar(prev, skin);
  });

  $("body").on('click', '.myStyle', function(){
    var prev = $(this).find('img').attr('src');
    var style = $(this).attr('id').replace('ast', '');
    $tienda.estilo.utilizar(prev, style);
  });

  $("body").on('click', '.style', function(){
    swal({
      title: "Lo sentimos",
      text: "Una vez que alcances el nivel de experiencia indicado, será posible hacer uso de éste estilo para tu avatar.",
      type: 'info'
    });
  });

});
