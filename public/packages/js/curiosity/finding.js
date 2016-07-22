$(document).ready(function() {


  $("#btnfind").click(function() {
    buscar();
  });

  function buscar (){
    $("#formFind").on('submit', function (e) {
      if ($("#navbar-search-input").val() == ''){
        e.preventDefault();
      }
    });
  }

  buscar();



});
