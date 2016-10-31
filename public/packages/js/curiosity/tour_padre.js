$(document).on('ready',__init);

function __init(){
	
	var longitudPerfil = 4;
	
	// Tour del perfil
	var tour_perfil = new Tour({
	
	  name: "tour_perfil",
		
	  storage: false, /* desactivamos el guardado 
	  					en el local.storage para poder inicarlo de nuevo. */
		
	  steps: [
	  /*{
		element: "#tit-imgprofile",
		title: "Cambia tu imagen de perfil",
		content: "Al dar click en la imagen, se abrirá una ventana donde podrás elegir una nueva imagen.",
		placement: "right"
	  },*/
		  
	  {
		element: "#tit-secdata",
		title: "Edita tus datos",
		content: "Al dar click en el botón verde, se abrirá una ventana donde podrás editar todos tus datos.",
		placement: "right"
	  },
		  
	  {
		element: "#tit-news",
		title: "¿Sabías que...?",
		content: "En esta sección podrás encontrar artículos, datos u opiniones de especialistas sobre temas que podrían ser de tu interés, solo da click en la zona de color verde.",
		placement: "right"
	  },
		  
	  {
		element: "#info-uso",
		title: "¿Dudas en una sección?",
		content: "Todas aquellas secciones que tengan este icono <i class='fa fa-info-circle'></i> y al hacer click en él, te mostrarán la información de su respectiva sección.",
		placement: "left"
	  },
		  
	  {
		element: "#img-hijo-inicio",
		title: "Estadísticas de tu hijo",
		content: "Al dar click en la imagen de perfil de tu hijo, se mostrará un panel con los datos del día, así como las actividades que realizó.",
		placement: "top"
	  }
	],
		
	  template: "<div class='popover tour'>"+
    				"<div class='arrow'></div>"+
    				"<h3 class='popover-title text-center' style='background-color: #ed6922; color:#fff; border-bottom: 1px solid #ed6922'></h3>"+
    				"<div class='popover-content'></div>"+
    				"<center><div class='popover-navigation'>"+
        				"<button class='btn separacion' data-role='prev' style='background-color:#2d96ba; color:#fff;'>« Anterior</button>"+
        				" <span data-role='separator'> | </span> "+
        				"<button class='btn separacion siguiente' data-role='next' style='background-color:#2d96ba; color:#fff;'>Siguiente »</button>"+
    				"</div></center>"+
    					"<center><button class='btn endTour' data-role='end' style='background-color:#585d66; color:#fff;'> Terminar</button></center><br>"+
  				"</div>",
		
		onPrev: function(){
			var elemento = tour_perfil.getCurrentStep() - 1; // obtenemos el elemento actual que tiene la popover con la información
			changeColor(tour_perfil, elemento, longitudPerfil);
			
		},
		
		onNext: function(){
			var elemento = tour_perfil.getCurrentStep() + 1;
			changeColor(tour_perfil, elemento, longitudPerfil);
			
		}
		
	});
	
	// Tour de vista mis hijos
	var tour_misHijos = new Tour({
	
	  name: "tour_misHijos",
		
	  storage: false,
		
	  steps: [
	  {
		element: "#tit-hijos",
		title: "Mis hijos registrados",
		content: "En esta sección, aparecen tus hijos que ya están registrados en la plataforma. <br> Se muestra su imagen de perfil, nombre completo y su nombre de usuario. ",
		placement: "bottom"
	  },
		  
	  {
		element: "#tabRegHijos",
		title: "¿Necesitas registrar a otro hijo?",
		content: "Al dar click en este botón, te aparecerá un panel donde podrás registrar a un nuevo hijo, llena todos los campos, da click en guardar registro y listo.",
		placement: "bottom"  
	  }
		  
	],
		
		template: "<div class='popover tour'>"+
    				"<div class='arrow'></div>"+
    				"<h3 class='popover-title text-center' style='background-color: #ed6922; color:#fff; border-bottom: 1px solid #ed6922'></h3>"+
    				"<div class='popover-content'></div>"+
    				"<center><div class='popover-navigation'>"+
        				"<button class='btn' data-role='prev' style='background-color:#2d96ba; color:#fff;'>« Anterior</button>"+
        				" <span data-role='separator'> | </span> "+
        				"<button class='btn' data-role='next' style='background-color:#2d96ba; color:#fff;'>Siguiente »</button>"+
    				"</div></center>"+
    					"<center><button class='btn endTour' data-role='end' style='background-color:#585d66; color:#fff;'> Terminar</button></center><br>"+
  				"</div>"
		
		
	});
	
	// Tour de vista puntajes
	var tour_puntajes = new Tour({
		
	  name: "tour_puntajes",
		
	  storage: false,
		
	  steps: [
	  {
		element: "#tit-grafica",
		title: "Gráficas de avance",
		content: "Aquí podrás seguir las actividades diarias de tus hijos. <br> La gráfica muestra el desempeño de  los últimos 7 días dentro de Curiosity.<br> Recuerda que es muy importante monitorear el desempeño y esfuerzo de tus hijos.",
		placement: "bottom"
	  }
		  
	],
		
		template: "<div class='popover tour'>"+
    				"<div class='arrow'></div>"+
    				"<h3 class='popover-title text-center' style='background-color: #ed6922; color:#fff; border-bottom: 1px solid #ed6922'></h3>"+
    				"<div class='popover-content'></div>"+
    				"<center><div class='popover-navigation'>"+
        				"<button class='btn' data-role='prev' style='background-color:#2d96ba; color:#fff;'>« Anterior</button>"+
        				" <span data-role='separator'> | </span> "+
        				"<button class='btn' data-role='next' style='background-color:#2d96ba; color:#fff;'>Siguiente »</button>"+
    				"</div></center>"+
    					"<center><button class='btn endTour' data-role='end' style='background-color:#585d66; color:#fff;'> Terminar</button></center><br>"+
  				"</div>"
		
	});
	
	// Obscurecer los elementos para resaltar el step actual del tour
	function changeColor(tour, el, longitud){
		
		for(var i = 0; i < longitud; i++){
			if( i == el){
				
				var clear = $(tour.getStep(el).reflexElement).parent();
				var ultimo = $(tour.getStep(el).reflexElement).parent().parent().parent();
				clear.removeClass('tourDark');
				ultimo.removeClass('tourDark');
				
			}else{
				
				var dark = $(tour.getStep(i).reflexElement).parent();
				var ultimo = $(tour.getStep(3).reflexElement).parent().parent().parent();
				dark.addClass('tourDark');
				ultimo.addClass('tourDark');
			
			}
		}
		
	}
	
	// Retiramos lo obscuro de todos los elementos una vez terminado el Tour
	$('body').on('click', '.endTour',function(){
		var elemento = tour_perfil.getCurrentStep();
		
		for(var i = 0; i < longitudPerfil; i++){
				var clear = $(tour_perfil.getStep(i).reflexElement).parent();
				var ultimo = $(tour_perfil.getStep(i).reflexElement).parent().parent().parent();
				clear.removeClass('tourDark');
				ultimo.removeClass('tourDark');
				$('#secimgperf').removeClass('tourDark');/* se obscurece el panel de foto de perfil harcodeado mientras se corrige el poder cambiar la foto */
			
		}
	});
	
	// inicializamos los tours
	
	$('#start-tour-perfil').click(function(){
		
		if(tour_perfil.ended()){ //comprobamos si ya se inicio, de ser true lo reiniciamos
			tour_perfil.restart();
			var elemento = tour_perfil.getCurrentStep();
			changeColor(tour_perfil, elemento, longitudPerfil);
			$('#secimgperf').addClass('tourDark'); /* se obscurece el panel de foto de perfil harcodeado mientras se corrige el poder cambiar la foto */
			
		}else{
			tour_perfil.init();
			tour_perfil.start(); // arrancar el tour del la vista de perfil	
			var elemento = tour_perfil.getCurrentStep();
			changeColor(tour_perfil, elemento, longitudPerfil);
			$('#secimgperf').addClass('tourDark'); /* se obscurece el panel de foto de perfil harcodeado mientras se corrige el poder cambiar la foto */
		}
	
	});
	
	$('#start-tour-misHijos').click(function(){
		
		if(tour_misHijos.ended()){
			tour_misHijos.restart();
		}else{
			tour_misHijos.init();
			tour_misHijos.start(); // tour vista mis hijos
		}
		
	});
	
	$('#start-tour-puntajes').click(function(){
		
		if(tour_puntajes.ended()){
			tour_puntajes.restart();
		}else{
			tour_puntajes.init();
			tour_puntajes.start(); // tour vista de puntajes
		}
		
	});
	
	
	// Evitar el choque de la popover del tour al abrir otra ventana o panel	
	$('#tabRegHijos, .sidebar-toggle').click(function(){
		$('.endTour').trigger('click');
	});
	
	// INICIAR EL TOUR AUTOMATICAMENTE SI ES LA PRIMERA VEZ QUE INICIA SESIÓN
	
	
/*	function primeraVez(){
		
		$.ajax({
			url:'/tour_first',
			type:'POST',
		}).done(function(response){
			
			if(response.respuesta == "true"){
				//$("#start-tour-perfil").trigger('click');
				
				tour_perfil.init();
				tour_perfil.start();
				var elemento = tour_perfil.getCurrentStep();
				changeColor(tour_perfil, elemento, longitudPerfil);
				
				$('#secimgperf').addClass('tourDark'); /* se obscurece el panel de foto de perfil harcodeado mientras se corrige el poder cambiar la foto 
				
			}else{
				
			}
			
			
		}).fail(function(res){
			//console.log(e);
		});
	}*/ 
	
	 // primeraVez();
	
}