$(document).ready(function() {

  var $padre = {
    validar : {
      roleFree : function(rol){
        if (rol == 'demo_padre'){
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
          if(response >= 5){
            $("#modalPremDad").modal('show');
          }
          else{
            $("#hijosInfo").hide('slow');
            $("#secreghijo").show('slow');
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
      $("#hijosInfo").hide('slow');
      $("#secreghijo").show('slow');
    }
  });

});
