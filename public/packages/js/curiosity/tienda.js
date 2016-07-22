var $tienda = {
  skin : {
    utilizar : function(preview, skin){
      swal({
        title: "Cambiar el Skin Curiosity",
        text: "¿Estas seguro de cambiar el color del skin actual y utilizar seleccionado?",
        imageUrl: preview,
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#2262ae",
        confirmButtonText: "Sí, utilizar",
        closeOnConfirm: false
      },
      function(){
        $.ajax({
          url: '/cambiarSkin',
          type: 'POST',
          data: {data: skin}
        })
        .done(function(response) {
          if(response == "success"){
            swal({
              title: "¡Muy Bien!",
              text: "Espera un momento mientras cambiamos el color de tu skin",
              type: 'success',
              showCancelButton: false,
              showConfirmButton: false
            });
            window.location.reload();
          }
        })
        .fail(function(error) {
          console.log(error);
        });
      });
    },
    comprar : function(prev, skin){
      swal({
        title: "Comprar nuevo Skin Curiosity",
        text: "¿Estas seguro de comprar el color de skin actual?",
        imageUrl: prev,
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#2262ae",
        confirmButtonText: "Sí, comprar",
        closeOnConfirm: false
      },
      function(){
        $.ajax({
          url: '/comprarSkin',
          type: 'POST',
          data: {data: skin}
        })
        .done(function(response) {
          if(response[0] == "success"){
            var $comprado = $("#"+response[1]['skin']+"sku");
            $comprado.removeClass('skout');
            $comprado.addClass('sk');
            $comprado.find('.captionSkin').text('Utilizar');
            $("#cantCoins").text(response[1]['coins'] + " cc");
            swal({
              title: "¡Muy Bien!",
              text: "Has comprado un nuevo skin. Ahora puedes utilizarlo cuando tú quieras.",
              type: 'success'
            });
          }
          else if (response[0] == "invalid"){
            swal({
              title: "¡Oops!",
              text: "Los sentimos no cuentas con la cantidad de Curiosity Coins (CC) suficientes para completar la acción.",
              type: 'error'
            });
          }
        })
        .fail(function(error) {
          console.log(error);
        });
      });
    }
  },
  estilo : {
    utilizar : function (prev, style){
      swal({
        title: "Cambiar el estilo de mi Avatar",
        text: "¿Estas seguro de cambiar el estilo de tu avatar?",
        imageUrl: prev,
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#2262ae",
        confirmButtonText: "Sí, cambiar",
        closeOnConfirm: false
      },
    function(){
        $.ajax({
          url: '/cambiarAvatar',
          type: 'POST',
          data: {data: style}
        })
        .done(function(response) {
          if(response[0] == "success"){
            swal({
              title: "¡Muy Bien!",
              text: "Has cambiado el estilo de tu avatar. Ahora solo espera un momento",
              type: 'success',
              showCancelButton: false,
              showConfirmButton: false
            });
            window.location.reload();
          }
        })
        .fail(function(error) {
          console.log(error);
        });
      });
    }
  }
}
