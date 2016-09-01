$(document).on("ready",function(){

	// función para mostrar el footer de las notificaciones
	$(function(){
		$('.panel').hover(function(){
        $(this).find('.panel-footer').slideDown(200);
    	},function(){
        	$(this).find('.panel-footer').slideUp(200); //.fadeOut(205)
    	});
	});
<<<<<<< HEAD
	
	// MODULO DE NOVEDADES DEL PAPÁ
	
	// Validaciones del formulario 
	
	var form_nov_papa = $('#agregarNovedad_papa');
	var form_nov_papaEdit = $('#editarNovedad_papa');
	
	form_nov_papa.validate({
		rules:{
			titulo_papa:{
				required:true,
				remote:{
					url:"/tituloRemoto_papa",
					type:"POST",
					data:{
						function(){
							return $("#titulo_papa");
						}
					}
				}
			},
			pdf:{required:true}
		},
		
		messages:{
			titulo_papa:{required:'Ingresa un titulo', remote:'Este titulo ya existe'},
			pdf:{required:'Selecciona el archivo PDF'}
		}
	});
	
	form_nov_papaEdit.validate({
		rules:{
			tituloEditar_papa:{
				required:true,
				remote:{
					url:"/tituloRemoto_papa",
					type:"POST",
					data:{
						function(){
							return $("#tituloEditar_papa");
						}
					}
				}
			},
			pdf_edit:{required:true}
		},
		
		messages:{
			tituloEditar_papa:{required:'Ingresa un titulo', remote:'Este titulo ya existe'},
			pdf_edit:{required:'Selecciona el archivo PDF'}
		}
	});
	
	// Sumit de los formularios
	
	$("#pdf").on('change', function(){
		var pesoMaximo = 2048000;
		var extension = new Array(".pdf");
		var documento = $('#pdf');
		
		if($curiosity.comprobarFile(documento.val(), extension)){
			var archivo_peso = document.getElementById("pdf").files;
			if(archivo_peso[0].size > pesoMaximo){
				documento.val();
				$curiosity.noty("Atención, el documento excede el peso máximo de 2 MB",'warning');
			}
		}else{
			documento.val("");
			
		}
	});
	
	$('#btn_add_papa').click(function(e){
		e.preventDefault();
		
		if(form_nov_papa.valid()){
			var formdata = new FormData(form_nov_papa[0]);
			console.log("cualquier");
			$.ajax({
				url:'/add_papaNovedad',
				type:"POST",
				data:formdata,
				cache:false,
				contentType:false,
				processData:false
			}).done(function(response){
				console.log(response);
				$curiosity.noty('Novedad guardada exitosamente','success');
			}).fail(function(){
				$curiosity.noty('Error al intentar guardar','error');
			});
		};
		
		$(this).click(function(){
			$('.close').trigger('click');
		});
	});
	
	$('#btn_edit_papa').click(function(){
		if(fom_nov_papaEdit.valid()){
			var novedadEdit ={
				tituloEditar_papa:$('#tituloEditar_papa').val(),
				pdf:$('#pdf_edit').val()
			};
			
			$.ajax({
				url:'/edit_papaNovedad',
				type:"POST",
				data:{data:novedadEdit}
			}).done(function(response){
				$curiosity.noty('Novedad editada','success');
			}).fail(function(){
				$curiosity.noty('Error al intentar editar','error');
			});
		};
	});
	
	// Funciones extras
	
	/*$('.formularios').hide();
	
=======

	/* funciones para mostrar los formularios
		según sea el de agregar o editar. */

	$('.formularios').hide();

>>>>>>> 74c8aae6fcbfb63f892beb29183fcd1076b05963
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
<<<<<<< HEAD
	}); */
	
	
	
	// CIERRE DEL MODULO DE NOVEDADES DEL PAPÁ
	
	/******************************************************************/
	
	// MODULO DE NOVEDADES DEL HIJO
	
	// Validaciones del formulario 
	
	var form_nov_hijo = $("#agregarNovedad_hijo");
	var form_nov_hijoEdit = $("#editarNovedad_hijo");
	
	form_nov_hijo.validate({
		rules:{
			tituloNov_hijo:{
				required:true,
				remote:{
					url:"/tituloRemoto_hijo",
					type:"POST",
					data:{
						function(){
							return $("#titulo_hijo");
						}
					}
				}
			},
			link:{required:true}
		},
		
		messages:{
			tituloNov_hijo:{required:'Ingresa un titulo', remote:'Este titulo ya existe'},
			link:{required:'Ingresa el link'}
		}
	});
	
	form_nov_hijoEdit.validate({
		rules:{
			tituloEditar_hijo:{
				required:true,
				remote:{
					url:"/tituloRemoto_hijo",
					type:"POST",
					data:{
						function(){
							return $("#titulo_hijo");
						}
					}
				}
			},
			link_edit:{required:true}
		},
		
		messages:{
			tituloEditar_hijo:{required:'Ingresa un titulo', remote:'Este titulo ya existe'},
			link_edit:{required:'Ingresa el link'}
		}
	});
	
	// Sumit de los formularios
	
	$('#btn_add_hijo').click(function(){
		if(fom_nov_hijo.valid()){
			var novedad_hijo ={
				titulo_hijo:$('#titulo_hijo').val(),
				link:$('#link').val()
			};
			
			$.ajax({
				url:'/add_hijoNovedad',
				type:"POST",
				data:{data:novedad_hijo}
			}).done(function(response){
				$curiosity.noty('Novedad guardada','success');
			}).fail(function(){
				$curiosity.noty('Error al intentar guardar','error');
			});
		};
	});
	
	$('#btn_edit_hijo').click(function(){
		if(form_nov_hijoEdit.valid()){
			var novedad_hijoEdit ={
				tituloEditar_hijo:$('#tituloEditar_hijo').val(),
				link_edit:$('#link_edit').val()
			};
			
			$.ajax({
				url:'/edit_hijoNovedad',
				type:"POST",
				data:{data:novedad_hijoEdit}
			}).done(function(response){
				$curiosity.noty('Novedad editada','success');
			}).fail(function(){
				$curiosity.noty('Error al intentar editar','error');
			});
		};
	});
	
	// Funciones extras
	
	// CIERRE DEL MODULO DE NOVEDADES DEL HIJO
});
=======
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
>>>>>>> 74c8aae6fcbfb63f892beb29183fcd1076b05963
