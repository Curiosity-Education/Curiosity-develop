$(document).ready(function() {

  var $idAv;

  $('ul.sidebar-menu > li, #navSearch').css('display', 'none');

  $("body").on('click', '.btnSelect', function(){
    $idAv = $(this).data('yd');
    swal({
      title: "¡Muy bien has seleccionado tu nuevo avatar!",
      text: "Presiona en aceptar para para comenzar tu aventura",
      type: "warning",
      showCancelButton: true,
      cancelButtonText: "Cancelar",
      confirmButtonColor: "#088c3d",
      confirmButtonText: "Aceptar",
      closeOnConfirm: false
    },
    function(){
      $registrarAvatar($idAv);
      swal({
        title: "¡Que tu curiosidad no tenga limites!",
        text: "Espera un momento mientras carga la página",
        type: "success",
        showConfirmButton: false
      });
    });
  });

  function $registrarAvatar(avatar){
    $.ajax({
      url: '/asignAvatar',
      type: 'POST',
      data: {data: avatar}
    })
    .done(function(response) {
      if (response == "success"){
        window.location.reload();
      }
      else{
        console.log(response);
      }
    })
    .fail(function(error) {
      console.log(error);
    });
  };

});
