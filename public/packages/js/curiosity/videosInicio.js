$(document).ready(function() {


  $curiosity.menu.setPaginaId("#videosInicio");

  $.ajax({
   url:'/getAllVideosAdmin',
   method:'POST'
  })
  .done(function(response){
    console.log(response);
    if(response.length != 0){
      var datos = [];
      $.each(response, function(index, obj){
        datos.push({
          'cont':index+1,
          'grado' : response[index].nivel,
          'inteligencia' : response[index].inteligencia,
          'bloque' : response[index].bloque,
          'tema' : response[index].tema,
          'actividad' : response[index].actividad,
          'embedSelected' :"<button type='button' data-embed='"+response[index].code_embed+"' class='btn btn-default playSelected' id='playSelected'><i class='fa fa-play''></i>&nbsp;"+
         "play"+
      "</button>" 
        });
      });
      $('#tabla-videos').bootstrapTable({
        data : datos,
        'onPageChange':changePage
      });
      $("#tabla-videos>tbody>tr").attr("draggable","true");    
      $("#tabla-videos>tbody>tr").attr("ondragstart","drag(event)");
      $("#tabla-videos>tbody").attr("ondrop","drop(event)");
      $("#tabla-videos>tbody").attr("ondragover","allowDrop(event)");
    }
  });
 $("#tabla-videos").on("click",".playSelected",function(evt){
     document.getElementById("ifr-video").setAttribute("src",evt.target.getAttribute("data-embed"));
     $("#modalVideo").modal("show");
 });

  function changePage(){
      $("#tabla-videos>tbody>tr").attr("draggable","true");    
      $("#tabla-videos>tbody>tr").attr("ondragstart","drag(event)");
      $("#tabla-videos>tbody").attr("ondrop","drop(event)");
      $("#tabla-videos>tbody").attr("ondragover","allowDrop(event)");
  }  
  
});
