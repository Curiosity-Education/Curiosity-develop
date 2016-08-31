$(document).ready(function(){

  var indexCurrent = 0;
  var countCurrent = 0;
  var vueltas = 1;

  $curiosity.menu.setPaginaId("#menuPerfil");

  $("#edit_datos").click(function(event) {
    $("#editar_datos_papa").modal('show');
  });

  $("#slider-ul").find('li').first().addClass('slide-current');


    $(".img-hijo").on('click',function(){
        $("#nom_hijo_s_est").empty();
        crearGraficaJuegosJugados($(this).attr('data-id'));
        crearGraficaAvanceMeta($(this).attr('data-id'));
        $("#nom_hijo_s_est").append($("#name_hijo_s_mis_hijos").text());
        $(".container-estadisticas").show('slow');
        $("html,body").animate({scrollTop:$(".container-estadisticas").offset().top});
    });
    
    $(".back-misHijos").on('click',function(){
        $(".container-estadisticas").hide('slow');

    });
    
    $(".info-progress-day").click(function(){
        var infoJSON = JSON.parse($(this).attr('data-info'));
        infoJSON.miMeta = JSON.parse(JSON.stringify(infoJSON.miMeta));
        data = {
            tituloHelp:'Progreso de la meta diaria',
            description_helper:'El progreso del cumplimiento de la meta diaria de cada hijo se muestra en una gráfica donde se puede observar el porcentaje de avance que lleva en el día',
            subtitle_1:'Meta',
            description_subtitle:'La meta se compone de los siguientes elementos <br> <b>Nombre: </b>'+infoJSON.miMeta.nombre+'<br> <b>Meta:</b> '+infoJSON.miMeta.meta+' actividades <br> <b>Actividades realizadas: </b>'+(infoJSON.porcAvanceMeta*infoJSON.miMeta.meta/100)+'/'+infoJSON.miMeta.meta,
            note_helper:'El total de actividades a realizar depende de la meta seleccionada por el alumno'     
        };
        llenarHelper(data);
        
        
    });
    $(".info-uso-plataform").click(function(){
    
        data = {
            tituloHelp:'Estado de uso de la plataforma',
            description_helper:'Muestra el porcentaje de uso de la plataforma basado en las metas del día de cada uno de sus hijos. Esta gráfica se relaciona con el cumpliento de metas, recuerde que cuando la aguja se encuentre en color rojo, alguno o todos sus hijos no esta cumpliendo con todas sus metas del día',
            subtitle_1:'Estados de uso',
            description_subtitle:'<b>Rojo: </b> El uso de la plataforma es muy bajo y no se obtendran buenos resultados.<br> <b>Amarillo: </b> El uso de la plataforma es suficiente y en ocasiones se obtendran buenos resultados.<br> <b>Verde: </b> El uso de la plataforma es bueno  y hay mas posibilidades que se obtengan buenos resultados.<br>',
            note_helper:'Si sus hijos han cumplido con todas sus metas del día la aguja marcará en verde.'     
        };
        llenarHelper(data);
        
        
    });
    
    $(".info-uso-misHijos").click(function(){
    
        data = {
            tituloHelp:'Mis hijos',
            description_helper:'En esta sección se encuentra tus hijos registrados y su progreso en el día',
            subtitle_1:'Estadisticas',
            description_subtitle:'Puedes acceder a las estadisticas de cada uno de tus hijos dando un click en la imagen correspondiente a tu hijo',
            note_helper:'Las estadisticas de esta sección se generan con las actividades realizadas de tus hijos'     
        };
        llenarHelper(data);
        
        
    });
    
    $(".info-progress-game").click(function(){
        var infoJSON = JSON.parse($(this).attr('data-info'));
        
        var act_real = function(){
            var text='';
            var table = $('<table/>').addClass('table table-bordered table-hover col-md-12');
            var tbody = $('<tbody/>');
            table.append($('<thead/>').append($('<tr/>').append('<td>Actividad</td><td>Total de veces jugados</td><td>Porcentaje de los juegos totales</td>')));
            $.each(infoJSON,function(i,objeto){
                var tr = $('<tr/>');
                $.each(objeto,function(i,o){
                    var td = $('<td/>');
                    if(i == 'y')
                        td.append(parseFloat(o).toFixed(2)+'%');
                    else 
                        td.append(o);
                    tr.append(td);
                });
                tbody.append(tr);
            });
            return table.append(tbody);
        }
        data = {
            tituloHelp:'Desglose de las actividades realizadas',
            description_helper:'El desglose de las actividades se observa en una gráfica de pie la cual se muestra dividida en porcentajes ej. Si su hijo ha jugado 10 veces y de esas 10 veces a jugado 5 veces el tema sumas y restas entonces este aparecera con un porcentaje de 50% ',
            subtitle_1:'Actividades Realizadas',
            description_subtitle:act_real(),
            note_helper:'Las actividades que se muestran son las que el alumno ha realizado durante el transcurso del día'     
        };
        llenarHelper(data);
        
        
    });
    //Graficación juegos jugados!
    function crearGraficaJuegosJugados(idHijo){
        var ruta = '/desgloce/hijo/'+idHijo;
        $.ajax({
            url:'/desgloce/hijo/'+idHijo,
            method:'POST',
            dataType:'JSON'
        }).done(function(response){
            $(".info-progress-game").attr('data-info', JSON.stringify(response));
            var seriesGET = {
                name: 'Porcentaje',
                data: []
            };
            $.each(response,function(index,object){
                var yData = parseFloat(object.y).toFixed(2);
                var dataResponse = {
                    name : object.name,
                    y : yData - 0
                }
                seriesGET.data.push(dataResponse);
            });
            $curiosityCharts.pieMonoChrome('#des_jue',{
                title:'',
                series: seriesGET
            });
        }).fail(function(error){

        });
    }
    
    //Crear grafica avance meta 
    function crearGraficaAvanceMeta(idHijo){
        $.ajax({
            url:'getMeta/hijo/'+idHijo,
            method:'POST',
            dataType:'JSON'
        }).done(function(response){

            $(".info-progress-day").attr('data-info', JSON.stringify(response));
            $(".dial").val(response.porcAvanceMeta+'%');
            $(".dial").knob({
                readOnly:true,
                fgColor:"#f2dd49",
                angleOffset:0,
                font:'Helvetica'
            });
            $(".dial").val(response.porcAvanceMeta+'%');
        }).fail(function(error){
            
        });
    }
    
    function llenarHelper(data){
        $("#tituloHelp").text(data.tituloHelp);
        $(".description-helper").text(data.description_helper);
        $('#subtitle-1').text(data.subtitle_1);
        $('.description-subtitle').empty();
        $('.description-subtitle').append(data.description_subtitle);
        $('.note-helper').text(data.note_helper);
        $("#helper").modal('show');
    }
    crearGraficaUsoPlataforma();
    function crearGraficaUsoPlataforma(){
        $.ajax({
            url:'/obtenerUsoPlataforma',
            method:'POST',
            dataType:'JSON'
        }).done(function(response){
            $(".info-uso-plataform").attr('data-info',response);
            $.each(response,function(i,object){
                var dataResponse = (object.total_jugados*100)/object.meta;
                $curiosityCharts.gauge('#status',{
                name: 'Status',
                data: [dataResponse],
                tooltip: {
                    valueSuffix: '%'
                }
            });
        });
        }).fail(function(error){
            
        });
        
    }
    
    //$curiosityCharts.column();
    

});
