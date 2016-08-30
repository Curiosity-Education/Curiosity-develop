$(document).on("ready",function(){
	
	// función para mostrar el footer de las notificaciones
	$(function(){
		$('.panel').hover(function(){
        $(this).find('.panel-footer').slideDown(250);
    	},function(){
        	$(this).find('.panel-footer').slideUp(250); //.fadeOut(205)
    	});
	});
	
	/* funciones para mostrar los formularios
		según sea el de agregar o editar. */
	
	$('.formularios').hide();
	
	$('#agregar_nov_papa').click(function(event){
		event.preventDefault();
		$('#agregarNovedad_papa').show();
		$('#editarNovedad_papa').hide();
	});
	
	$('#editar_nov_papa').click(function(event){
		event.preventDefault();
		$('#editarNovedad_papa').show();
		$('#agregarNovedad_papa').hide();
	});
	
	$('#agregar_nov_hijo').click(function(event){
		event.preventDefault();
		$('#agregarNovedad_hijo').show();
		$('#editarNovedad_hijo').hide();
	});
	
	$('#editar_nov_hijo').click(function(event){
		event.preventDefault();
		$('#editarNovedad_hijo').show();
		$('#agregarNovedad_hijo').hide();
	});
	
	
	// MODULO DE NOVEDADES DEL HIJO
	
	// Validaciones del formulario 
	// Validaciones remotas
	// funciones necesarias
	
	// CIERRE DEL MODULO DE NOVEDADES DEL HIJO
	
	/******************************************************************/
	
	// MODULO DE NOVEDADES DEL PAPÁ
	
	// Validaciones del formulario 
	// Validaciones remotas
	// funciones necesarias
	
	// CIERRE DEL MODULO DE NOVEDADES DEL PAPÁ
});