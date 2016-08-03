$(document).ready(function(){
  $myConten = $();

  //aplicar un span a los h3 que estan dentro de los cursos para lograr el efecto mecanografico
  $span = $("<span>&nbsp;</span>");
  $(".widget-user-header h3").append($span);
 //establecer backgrund del color de la cabecera donde se encuentra el span para simular efecto mecanografico
  $(".widget-user-header h3").children("span").each(function(){
	  $(this).css("background",""+$(this).parent().parent().css("background")+"");
  });


  //disparar el evento click del input tipo file cuando se le de click a la imagen
  $(".img-circle").click(function(){
	  $("#up-image").trigger("click");
  });
	//cambiar tema de la plantilla al hacer click
 $("#thems a").click(function(){
	 $("body").attr("class","hold-transition skin-"+$(this).attr("id")+ " sidebar-mini");
 });
	 /*
	 	elementos en tiempo de ejecucion por que de otra manera tenria que estar agregando todo esto que
	 	hice por cada curso y de esta manera solo lo creo una vez y lo aplico a todos los cursos
																									*/
	 $rowInputs = $("<div/>",{class:"row inputs"});
	 $coltitle  = $("<div/>",{class:"col-xs-12 border-right"});
	 $colDescripcion = $("<div/>",{class:"col-xs-12 border-right"});
	 $inDescrip = $("<textarea rows='4'/>",{type:"text", class:"form-control",name:"descrip",placeholder:"Descripcion"});
	 $intitle   = $("<input type='text' class='form-control' name='titulo' id='Titulo' placeholder='Titulo' />");
	 $coltitle.append($intitle);
	 $colDescripcion.append($inDescrip);
	 $rowInputs.append($coltitle);
	 $rowInputs.append($colDescripcion);
	 $colDescripcion.hide();
	 $row_actions = $("<div/>",{class:"row update"});
	 $btnNext = $("<i  class='btn fa fa-share bg-blue' title='siguiente modificacion'/>");
	 $btnSave = $("<i  class='btn fa fa-check bg-green ' title='guardar cambios'/>");
	 $btnCansel = $("<i  class='btn fa fa-undo bg-red' title='Canselar cambios'/>");
	 $btnPrev = $("<i  class='btn fa fa-reply bg-blue' title='anterior modificcacion'/>");
	 $colbtn1 = $("<div/>",{class:"col-xs-3"});
	 $colbtn2 = $("<div/>",{class:"col-xs-3"});
	 $colbtn3 = $("<div/>",{class:"col-xs-3"});
	 $colbtn4 = $("<div/>",{class:"col-xs-3"});
	 $rowLook = $("<div/>",{class:"row radios"});
	 $colRadios = $("<div/>",{class:"col-xs-6"});
   	 $checkbox =$("<span/>",{class:"btnlock fa fa-lock fa-3x"});
	 $colRadios.append($checkbox);
   	 $rowLook.append($("<div>",{class:"col-xs-4"}).append($("<h5>").text("desbloquear: ")),$colRadios);
	 $colbtn1.append($btnNext);
	 $colbtn2.append($btnSave);
	 $colbtn3.append($btnCansel);
	 $colbtn4.append($btnPrev);
	 $row_actions.append($colbtn1);
	 $row_actions.append($colbtn2);
	 $row_actions.append($colbtn3);
	 $row_actions.append($colbtn4);
	 $divGroup = $("<div>",{class:'divGroup1'});
	 $h4Title = $("<h4/>").text("Ingresa el nuevo titulo del curso");
	 $divGroup.append($h4Title,$rowInputs,$("<br>"),$rowLook,$("<hr>"));
	 $(".box-footer").append($divGroup);
	 $(".box-footer").append($row_actions);
	 $(".divGroup1").hide();
	 $(".update").hide();
	//->fin de creacion de elementos en tiempo de ejecucion

//transicion
	/*botom que permitira actualizar los cuross*/
 $(".fa-refresh").click(function(){
	 $cont = $(this).parent().parent().parent();//selccionar a la etiqueta row que contiene los botos(act.,elim,etc..)
	 $cont.parent().parent().css("height",""+$(".box").css("height")+"");//aplicar misma medidad a todas las cajas de los cursos
	 $(".box").children().show();//mostrar todos los elementos de la clase box
	 $(".box-footer").children().show();//mostrar los elementos de la clase footer
	 $(".divGroup1").hide();//oculatar los elementos
	 $(".update").hide();
	 $cont.hide();
	 $cont.parent().prev().hide();
     $cont.parent().prev().prev().hide();
	 $cont.parent().parent().fadeOut(300,
     function(){
       $(this).css({"-webkit-filter":"blur(2px)"});
       $(this).fadeIn(300,function(){$(this).css({"-webkit-filter":"blur(0px)"})});
       $cont.siblings().hide();
	   $cont.first().siblings().show();


     });

 });

//bloquear y desbloquear contenido
 $(".box").on("click",".btnlock",function(){
   if($(this).hasClass("fa-lock"))
   {
	  $(this).removeClass("fa-lock");
      $(this).addClass("fa-unlock");
	  $(this).parent().siblings().text("Bloquear: ");
   }
   else
    {
	 $(this).removeClass("fa-unlock");
     $(this).addClass("fa-lock");
	 $(".radios h3").text("Desbloquear: ");
	 $(this).parent().siblings().text("Desbloquear: ");
   }
 });
	 //click en el icono regresar para canselar la actualizacion del curso

 $(".box").on("click",".btn.fa-undo",function(){
	$(this).parent().next().children().first().trigger("click");
    $(this).parent().parent().hide();
    $(this).parent().parent().prev().hide();
    $(this).parent().parent().prev().prev().show();
    $(this).parent().parent().parent().siblings().show();




 });
$(".box").on("click",".btn.fa-share",function(){
	$(this).parent().parent().siblings().hide();//.prev().find(".col-xs-12").hide();
	$cont = $(this).parent().parent().prev();
	$cont.show();
	$cont.children().hide();
	$cont.children().first().text("Ingrese la nueva descripcion");
	$cont.children().first().show();
	$cont.children().last().show();
	$cont.children().first().next().show();
	$cont.children().first().next().children().first().hide();
	$cont.children().first().next().children().last().show();


});
$(".box").on("click",".btn.fa-reply",function(){
	//$(this).parent().parent().prev().children().hide();
	$(this).parent().parent().prev().children().show();
	$(this).parent().parent().prev().children().first().next().children().last().hide();
	$(this).parent().parent().prev().children().first().next().children().first().show();
	$(this).parent().parent().prev().children().first().text("Ingrese el nuevo titulo del curso");
	$(this).parent().parent().prev().show();

});
	$("div.description-block>.fa-remove").click(function(e){
		alertify.confirm("Esta seguro de que desea eliminar este curso, se perderan todos datos relevantes a él",function(){
	 if (e) {
        // user clicked "ok",
    } else {
        // user clicked "cancel"
    }
		});
	});
});
