$(document).ready(function() {

  var $padre = {
    validar : {
      roleFree : function(rol){
        if (rol == 'padre_free' || rol == 'demo_padre'){
          return true;
        }
        else {
          return false;
        }
      },
      hijosCount : function(){
        $.ajax({
          url: '/cotarhijos',
          type: 'POST',
          dataType: 'JSON'
        })
        .done(function(response) {
          if(response >= 1){
            $("#modalPremDad").modal('show');
          }
          else{
            $("#registro_hijo").modal('show');
          }
        })
        .fail(function(error) {
          console.log(error);
        });
      }
    }
  }

  $("#tabRegHijos").click(function(event) {
    if($padre.validar.roleFree($(this).data('dad'))){
      $padre.validar.hijosCount();
    }
    else{
      $("#registro_hijo").modal('show');
    }
  });

});
