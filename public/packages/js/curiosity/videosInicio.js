$(document).ready(function() {
    $curiosity.menu.setPaginaId("#videosInicio");
    var videos=[];
    $.ajax({// petición al servidor para obtener los videos
        url:'/getAllVideosAdmin',
        method:'POST'
        })
        .done(function(response){
        console.log(response);
        if(response.length != 0){
          videos = response;
          var datos = [];
          $.each(response, function(index, obj){
            datos.push({
              'cont':index+1,
              'grado' : response[index].nivel,
              'inteligencia' : response[index].inteligencia,
              'bloque' : response[index].bloque,
              'tema' : response[index].tema,
              'actividad' : response[index].actividad,
              'embedSelected' :"<iframe class='ifr-videos-table'  src='"+response[index].code_embed+"'></iframe>"
            });
          });
          $('#tabla-videos').bootstrapTable({
            data : datos,
          });
          $("#tabla-videos>tbody>tr").attr("draggable","true");    
          $("#tabla-videos>tbody>tr").attr("ondragstart","drag(event)");
          $("#tabla-videos>tbody").attr("ondrop","drop(event)");
          $("#tabla-videos>tbody").attr("ondragover","allowDrop(event)");
          $("#tabla-videos>tbody>tr").each(function(index,row){
              $(row).data("object",response[index]);
          });
        }
    });
    // mostramos en una ventana modal el video seleccionado, por medio de un ifrrame
    $("#tabla-videos").on("click",".playSelected",function(evt){
         document.getElementById("ifr-video").setAttribute("src",evt.target.getAttribute("data-embed"));
         $("#modalVideo").modal("show");
    });

    $("#btnSave").on("click",function(){// al presionar en el boton guardar obtenemos el orden de los objetos para guardarlos en el servidor
      //alert("cambiaron las columnas");
      $txthtml = $("#btnSave").html();
      $("#btnSave").prop("disabled",true);  
      $("#btnSave").html($txthtml+"...");
      videos = [];//vaciamos el arreglo
      $("#tabla-videos>tbody>tr").each(function(index,row){
          videos.push($(row).data("object"));
          $(row).children().first().text(index+1);
          videos[index].index_order =index+1;
          $(row).data("object",videos[index]);
      });
      $.ajax({
          "url":"/reindexarVideos",
          "method":"POST",
          "data":{"videos":videos}
      }).done(function(response){
          console.log(response);
          if($.isPlainObject(response)){
             if(response.status){
                  $curiosity.noty("Los videos se ordenaron correctamente","success","Todo salio bien");
             }else{
                 $curiosity.noty("Los videos no se ordenaron correctamente, surgio un error al intentar guardar el orden de estos","info","Algo salio mal");
             }
          }
      }).fail(function(error){
          console.log(error);
      }).always(function(){
        $("#btnSave").html($txthtml);
      });
      console.log(videos);
    });
    
    $("table").on("changeColumns",function(){
      $("#btnSave").prop("disabled",false);
    });
    
});
