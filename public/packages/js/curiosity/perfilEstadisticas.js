$(document).ready(function(){

  var datos = {
    id : $("#data").data('id')
  }

  $.ajax({
    url: "/getEstadisticasHijo",
    type: "post",
    data: {data : datos}
  })
  .done(function(response){
    if(response[0] == 'success'){
      $setHtml = "<div class='felicitacionHijos text-center'>"+
                    "<h1>¡Felicidades Papá!</h1>"+
                    "<p>"+
                      "Todos sus hijos se encuentran con un nivel excelente. "+
                      "Es por esto que <b>Curiosity</b> le quiere dar las gracias "+
                      "y enviarle una grata felicitación, esperando así que se mantenga "+
                      "este compromiso en la educación.<br><br>"+
                      "<small><i>(Cualquier cambio se hará notar en esta sección)</i></small>"+
                    "</p>"+
                  "</div>";
      $(".alertaBox").html($setHtml);
    }
    else{
      $.each(response, function(index){
          $setHtml = "<div class='alertaHijo'>"+
                        "<h4><b>"+response[index].usernameHijo+"</b></h4>"+
                        "<h5><b>Tema: </b class='temanombre'>"+response[index].ayuda[0].tema_nombre+"</h5>"+
                        "<h5><b>Actividad: </b class='actividadnombre'>"+response[index].actividadNombre+"</h5>"+
                        "<a href='/packages/docs/"+response[index].ayuda[0].pdf+"' class='btn btn-success guiapdf' target='_blank'>"+
                          "<i class='fa fa-download'> Guía PDF</i>"+
                        "</a>"+
                        "<a href='javascript:void(0)' class='btn btn-danger guiavideo' data-embed='"+response[index].ayuda[0].code_embed+"'>"+
                          "<i class='fa fa-youtube-play'> Video de ayuda</i>"+
                        "</a>"+
                      "</div>";
          $(".alertaBox").append($setHtml);
      });
    }
  })
  .fail(function(error){
    console.log(error);
  });

  $(".alertaBox").on('click', '.alertaHijo > .guiavideo', function(){
    $("#videoAyuda").attr('src', $(this).data('embed'));
    $("#modalVideo").modal('show');
  });

  $.ajax({
    url: "/grafPuntajes",
    type: "post",
    data: {data : datos}
  })
  .done(function(response){
    var datos = [];
    var datosMin = [];
    $.each(response, function(index, obj){
      datos.push([obj.hijo+" (actividad: )", obj.maximo]);
      datosMin.push([obj.hijo+" (actividad: )", obj.minimo]);
    });

    $(".grafMax").highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Puntaje Máximo Obtenido'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Máximos Puntajes'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Máximo Puntaje: {point.y:.1f} Pts'
        },
        series: [{
            name: 'Hijos',
            data: datos,
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });

    $(".grafMin").highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Puntaje Mínimo Obtenido'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Minimos Puntajes'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Minimo Puntaje: {point.y:.1f} Pts'
        },
        series: [{
            name: 'Hijos',
            data: datosMin,
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#ff8888',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'tahoma, calibri'
                }
            }
        }]
    });
  })
  .fail(function(error){
    console.log(error);
  });

  // for (var i = 0; i < 3; i++) {
  //   $(".graf").append("<center><div class='graficaBox grafica"+i+"'></div></center>");
  // }

});
