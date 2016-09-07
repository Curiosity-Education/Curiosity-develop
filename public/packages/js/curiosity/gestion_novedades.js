$(document).on("ready",function(){

	// Funcionalidad de el panel de novedad
	$(document).on('click', '.panel-heading span.clickable', function (e) {
		var $this = $(this);
		if (!$this.hasClass('panel-collapsed')) {
			$this.parents('.panel').find('.panel-body').slideUp();
			$this.addClass('panel-collapsed');
			$this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
		} else {
			$this.parents('.panel').find('.panel-body').slideDown();
			$this.removeClass('panel-collapsed');
			$this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
		}
	});
	$(document).on('click', '.panel div.clickable', function (e) {
		var $this = $(this);
		if (!$this.hasClass('panel-collapsed')) {
			$this.parents('.panel').find('.panel-body').slideUp();
			$this.addClass('panel-collapsed');
			$this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
		} else {
			$this.parents('.panel').find('.panel-body').slideDown();
			$this.removeClass('panel-collapsed');
			$this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
		}
	});

	$('.panel-heading span.clickable').click();
    $('.panel div.clickable').click();


	// Limpiar los inputs para una vez que se cierra el modal para agregar o editar
	$('.close').click(function(){
		$('input').val("");
		$('#mostrar_input').show();
		$('#input_pdfEditar').hide();
	});

	$("#cancelar, #cancelarH").click(function(){
		$('.close').trigger('click');
	});

	// MODULO DE NOVEDADES DEL PAPÁ

	// Validaciones del formulario

	var form_nov_papa = $('#agregarNovedad_papa');
	var form_nov_papaEdit = $('#editarNovedad_papa');
	var tituloEditar_papa;
	var pdf_edit;

	form_nov_papa.validate({
		rules:{
			titulo_papa:{
				required:true,
				remote:{
					url:"/tituloRemoto_papa",
					type:"POST",
					data:{
						function(){
							return $("#titulo_papa").val();
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

	$("input[name='tituloEditar_papa'], input[name='pdf_edit']").keyup(function(e){
		if($("input[name='tituloEditar_papa']").val() != tituloEditar_papa || $("input[name='pdf_edit']").val() != pdf_edit){

			form_nov_papaEdit.validate({
				rules:{
					tituloEditar_papa:{
						required:true,
						remote:{
							url:"/tituloRemoto_papa",
							type:"POST",
							data:{
								function(){
									return $("#tituloEditar_papa").val();
								}
							}
						}
					}
				},

				messages:{
					tituloEditar_papa:{required:'Ingresa un titulo', remote:'Este titulo ya existe'},
				}
			});
		}else{
			form_nov_papaEdit.validate({
				rules:{
					tituloEditar_papa:{
						required:true
					}
				},

				messages:{
					tituloEditar_papa:{required:'Ingresa un titulo'},
				}
			});
		}
	});

	// Sumit de los formularios

	$('#btn_add_papa').click(function(e){
		e.preventDefault();

			var formdata_papa = new FormData(form_nov_papa[0]);

		if(form_nov_papa.valid()){
			$.ajax({
				url:'/add_papaNovedad',
				type:"POST",
				data:formdata_papa,
				cache:false,
				contentType:false,
				processData:false
			}).done(function(response){
				console.log(response);
				$curiosity.noty('Novedad guardada exitosamente','success');
				window.location.href = "/vistaNovedades";
			}).fail(function(){
				$curiosity.noty('Error al intentar guardar','error');
			});

			$('.close').trigger('click');

		};

	});

	$('#btn_edit_papa').click(function(e){
		e.preventDefault();

		var formdata_papaEdit = new FormData(form_nov_papaEdit[0]);
		var id = $('#id_novpapa').val();

		if(form_nov_papaEdit.valid()){
			$.ajax({
				url:'/edit_papaNovedad'+'/'+id,
				type:"POST",
				data:formdata_papaEdit,
				cache:false,
				contentType:false,
				processData:false
			}).done(function(response){
				$curiosity.noty('Novedad editada','success');
				window.location.href = "/vistaNovedades";
			}).fail(function(){
				$curiosity.noty('Error al intentar editar','error');
			});
		};

		$('.close').trigger('click');
	});

	$('.eliminar_nov_papaClass').click(function(e){
		e.preventDefault();

		var id_novedad = $(this).data("yd"); // obtenemos el id de la novedad
		var uri = '/delete_papaNovedad'+'/'+id_novedad; // creamos una ruta y adjunto el id

		var elimNov_papa = function(){
			window.location.href = uri;
		}; // función de confirmación de borrar la novedad

		$curiosity.notyConfirm(elimNov_papa);

	});

	// Funciones extras

		/* Vaciar datos en form de editar */

	$('.editar_nov_papaClass').click(function(e){
		e.preventDefault();

		var id_novedad = $(this).data("yd");
		var titulo = $(this).data("tit");
		var pdf_edit = $(this).data("arc");
		tituloEditar_papa = titulo;
		pdf_edit = pdf_edit;

		$("#id_novpapa").val(id_novedad);
		$("#tituloEditar_papa").val(titulo);

		console.log(titulo);

	});

		/* Validación de extensión y peso del pdf */

	var pesoMaximo = 2048000;
	var extension = new Array(".pdf");

	$("#pdf").on('change', function(){

		var documento = $(this);

		if($curiosity.comprobarFile(documento.val(), extension)){
			var archivo_peso = document.getElementById('pdf').files;
			if(archivo_peso[0].size > pesoMaximo){

					$('.close').trigger('click');
					$('input').val("");

				documento.val("");
				$curiosity.noty("Atención, el documento excede el peso máximo de 2 MB",'warning');
			}
		}else{
			documento.val("");
			$('.close').trigger('click');
			$('input').val("");
		}
	}); // validación para input de agregar

	$("#pdf_edit").on('change', function(){

		var documento_edit = $(this);

		if($curiosity.comprobarFile(documento_edit.val(), extension)){
			var archivo_pesos = document.getElementById('pdf_edit').files;
			if(archivo_pesos[0].size > pesoMaximo){

					$('.close').trigger('click');
					$('input').val("");

				documento_edit.val("");
				$curiosity.noty("Atención, el documento excede el peso máximo de 2 MB",'warning');
			}
		}else{
			documento_edit.val("");
			$('.close').trigger('click');
			$('input').val("");
		}
	}); // validación para input de editar


		/* funciones para mostrar los formularios
			según sea el de agregar o editar. */

	$("#agregar_nov_papa").click(function(){
		$("#editarNovedad_papa").hide();
		$("#agregarNovedad_papa").show();
	});

	$("#editar_nov_papa").click(function(){
		$("#agregarNovedad_papa").hide();
		$("#editarNovedad_papa").show();
	});



		/* Mostrar el input de pdf, en
			caso que quiera cambiar el pdf ya existente */

	$('#input_pdfEditar').hide();
	$('#mostrar_input').click(function(){
		$('#input_pdfEditar').show();
		$(this).hide();
	});


	// CIERRE DEL MODULO DE NOVEDADES DEL PAPÁ



	/******************************************************************/



	// MODULO DE NOVEDADES DEL HIJO

	// Validaciones del formulario

	var form_nov_hijo = $("#agregarNovedad_hijo");
	var form_nov_hijoEdit = $("#editarNovedad_hijo");
	var tituloEditar_hijo;
	var link_edit;


	form_nov_hijo.validate({
		rules:{
			tituloNov_hijo:{
				required:true,
				remote:{
					url:"/tituloRemoto_hijo",
					type:"POST",
					data:{
						function(){
							return $("#tituloNov_hijo").val();
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

	$("input[name='tituloEditar_hijo'], input[name='link_edit']").keyup(function(e){
		if($("input[name='tituloEditar_hijo']").val() != tituloEditar_hijo || $("input[name='link_edit']").val() != link_edit){
			//alert("los campos han cambiado");
			form_nov_hijoEdit.validate({
				rules:{
					tituloEditar_hijo:{
						required:true,
						remote:{
							url:"/tituloRemoto_hijo",
							type:"POST",
							data:{
								function(){
									return $("#tituloEditar_hijo").val();
								}
							}
						}
					},
					link_edit:{
						required:true,
						remote:{
							url:"/linkRemoto_hijo",
							type:"POST",
							data:{
								function(){
									return $("#link_edit").val();
								}
							}
						}
					}
				},

				messages:{
					tituloEditar_hijo:{required:'Ingresa un titulo', remote:'Este titulo ya existe'},
					link_edit:{required:'Ingresa el link', remote:'Este link ya esta en uso'}
				}
			});
		}else{
			//alert("los campos son iguales");
			form_nov_hijoEdit.validate({
				rules:{
					tituloEditar_hijo:{
						required:true
					}
				},

				messages:{
					tituloEditar_hijo:{required:'Ingresa un titulo'},
				}
			});
		}
	});


	// Sumit de los formularios

	$('#btn_add_hijo').click(function(e){
		e.preventDefault();

		var formdata_hijo = new FormData(form_nov_hijo[0]);

		if(form_nov_hijo.valid()){

			$.ajax({
				url:'/add_hijoNovedad',
				type:"POST",
				data:formdata_hijo,
				cache:false,
				contentType:false,
				processData:false
			}).done(function(response){
				$curiosity.noty('Novedad guardada','success');
				window.location.href = "/vistaNovedades";
			}).fail(function(){
				$curiosity.noty('Error al intentar guardar','error');
			});

			$('.close').trigger('click');
		};
	});

	$('#btn_edit_hijo').click(function(e){
		e.preventDefault();

		var formdata_hijo_edit = new FormData(form_nov_hijoEdit[0]);
		var id = $('#id_novhijo').val();

		if(form_nov_hijoEdit.valid()){
			$.ajax({
				url:'/edit_hijoNovedad'+'/'+id,
				type:"POST",
				data:formdata_hijo_edit,
				cache:false,
				contentType:false,
				processData:false
			}).done(function(response){
				$curiosity.noty('Novedad editada','success');
				window.location.href = "/vistaNovedades";
			}).fail(function(){
				$curiosity.noty('Error al intentar editar','error');
			});

			$('.close').trigger('click');
		};
	});

	$('.eliminar_nov_hijoClass').click(function(e){
		e.preventDefault();

		var id_novedad = $(this).data("yd"); // obtenemos el id de la novedad
		var uri = '/delete_hijoNovedad'+'/'+id_novedad; // creamos una ruta y adjunto el id

		var elimNov_hijo = function(){
			window.location.href = uri;
		}; // función de confirmación de borrar la novedad

		$curiosity.notyConfirm(elimNov_hijo);

	});

	// Funciones extras

		/* Vaciar datos en form de editar */

	$('.editar_nov_hijoClass').click(function(e){
		e.preventDefault();

		var id = $(this).data("yd");
		var titulo = $(this).data("tit");
		var link = $(this).data("lk");

		link_edit = link;
		tituloEditar_hijo = titulo;

		$("#id_novhijo").val(id);
		$("#tituloEditar_hijo").val(titulo);
		$("#link_edit").val(link);

	});

		/* funciones para mostrar los formularios
			según sea el de agregar o editar. */

	$("#agregar_nov_hijo").click(function(){
		$("#editarNovedad_hijo").hide();
		$("#agregarNovedad_hijo").show();
	});

	$("#editar_nov_hijo").click(function(){
		$("#agregarNovedad_hijo").hide();
		$("#editarNovedad_hijo").show();
	});


	// CIERRE DEL MODULO DE NOVEDADES DEL HIJO


});
