$(document).on('ready',__init);

function __init(){

	// Tour del perfil
	var tour_perfil = new Tour({


	  storage: false, /* desactivamos el guardado
	  					en el local.storage para poder inicarlo de nuevo. */

	  steps: [
	  {
		element: "#tit-imgprofile",
		title: "Cambiar imagen de perfil",
		content: "Al dar click en la imagen, se abrirá una ventana donde podrás elegir una nueva imagen.",
		placement: "right"
	  },

	  {
		element: "#tit-secdata",
		title: "Editar mis datos",
		content: "Al dar click en el boton verde, se abrirá una ventana donde podrás editar todos tus datos que ofreciste al registrarte.",
		placement: "right"
	  },

	  {
		element: "#tit-news",
		title: "Cosas interesantes para ti",
		content: "En esta sección mostramos Articulos y novedades sobre aspectos que podrían ser de tu interes, solo con dar click en la zona color verde.",
		placement: "right"
	  },

	  {
		element: "#info-uso",
		title: "Información de sección",
		content: "Todas aquellas secciones que tengan este icono <i class='fa fa-info-circle'></i> y al hacer click en él, te mostrarán la información de su respectiva sección.",
		placement: "left"
	  },

	  {
		element: "#img-hijo-inicio",
		title: "Estadísticas de tu hijo",
		content: "Al dar click en la imagen de perfil de tu hijo, se mostrará un panel con los datos del día, como las actividades que realizó",
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
        				"<button class='btn separacion' data-role='next' style='background-color:#2d96ba; color:#fff;'>Siguiente »</button>"+
    				"</div></center>"+
    					"<center><button class='btn endTour' data-role='end' style='background-color:#585d66; color:#fff;'> Terminar</button></center><br>"+
  				"</div>"

	});

	// Tour de vista mis hijos
	var tour_misHijos = new Tour({

	  storage: false,

	  steps: [
	  {
		element: "#tit-hijos",
		title: "Mis hijos registrados",
		content: "En esta sección aparece tu hijo o hijos que están registrados en la plataforma. <br> Se muestra su imagen de perfil, nombre completo y su nombre de usuario. ",
		placement: "bottom"
	  },

	  {
		element: "#tabRegHijos",
		title: "Genial !!, Un nuevo hijo curiosity.",
		content: "Al dar click en este boton, te aparecerá un panel donde podrás registrar a un nuevo hijo, llena los todos los campos, da click en guardar registro y listo.",
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

	  storage: false,

	  steps: [
	  {
		element: "#tit-grafica",
		title: "Gráficas de avance",
		content: "Seguimiento de actividades diarias. <br> La gráfica muestra el desempeño de  los últimos 7 días de tu hijo dentro de Curiosity.<br> Recuerda que es muy importante monitorear el desempeño y esfuerzo de tus hijos.",
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




	// inicializamos los tours

	$('#start-tour-perfil').click(function(){

		if(tour_perfil.ended()){ //comprobamos si ya se inicio, de ser true lo reiniciamos
			tour_perfil.restart();
		}else{
			tour_perfil.init();
			tour_perfil.start(); // arrancar el tour del la vista de perfil
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


	// Evitar el choque de la popover al abrir otra ventana o panel
	$('#tabRegHijos, .sidebar-toggle').click(function(){
		$('.endTour').trigger('click');
	});
}
