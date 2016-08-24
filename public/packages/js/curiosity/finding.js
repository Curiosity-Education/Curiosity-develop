$(document).ready(function() {


  $("#btnfind").click(function() {
    if ($("#navbar-search-input").val() != ''){
      $("#formFind").submit();
    }
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
