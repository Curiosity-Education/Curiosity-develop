$(document).ready(function() {

/*
 *  ==================================================================================
 *  Estableciendo el boton del link en el menu del aside como seleccionado
 *  ==================================================================================
*/

  $curiosity.menu.setPaginaId("#linkVendedores");

/*
 *  ==================================================================================
 *  Se inicializan los componentes
 *  ==================================================================================
*/


/*
 *  ==================================================================================
 *  Declaración de variables globales
 *  ==================================================================================
*/

  var adminVisible = false;
  var tipoGuardado;
  var idSeleccionado;
  var formData;
  var fotoTemp;

/*
 *  ==================================================================================
 *  Eventos disparados por las acciones del usuario.
 *  Se mandan llamar las siguientes funciones creadas
 *  ==================================================================================
*/

  $("#btnCancelarV").click(function() { showHideAdmin(); });
  $("#registrarV").click(function() { mostrarRegistrar(); });
  $("#btnGuardarV").click(function() { guardarRegistro(); });
  $("#estadoV").change(function() { establecerCiudades($(this).val(), 'mexico'); });
  $("#actualizarV").click(function() { mostrarActualizar(); });
  $("#eliminarV").click(function() { eliminarVendedor(); });
  $("#btnImgV").click(function() { $("#imagenV").trigger('click'); });
  $("#imagenV").change(function() { seleccionarFoto(); });
  $("#btnImgVCancelar").click(function() { cancelarFoto(); });
  $("#btnImgVGuardar").click(function() { guardarFoto(); });

/*
 *  ==================================================================================
 *  Validaciones de campos de formulario para una integración correcta de la
 *  información a procesar.
 *  ==================================================================================
*/

  $("#formV").validate({
    rules:{
      nombreV : {required:true,maxlength:50},
      appellidosV : {required:true,maxlength:100},
      correoV : {email:true,required:true},
      sexoV : {required:true,maxlength:1},
      estadoV : {required:true},
      ciudadV : {required:true}
    },
    messages:{
      email:{email:"Formato de correo incorrecto"}
    }
  });

/*
 *  ==================================================================================
 *  Funciones que se harán de uso para la gestón de la información y manipulación
 *  de los elementos del DOM.
 *  Se hace uso de objetos externos para el correcto funcionamiento de la lógica
 *  del módulo desarrollado.
 *  ==================================================================================
*/

  /*
   *  Mostrar y ocultar el formulario de administración
  */
  var showHideAdmin = function(foto){
    if (adminVisible){
      $(".btnimg").hide();
      $("#gestionDatosV").hide('slow');
      $("#tablaInicialV").show('slow');
      document.getElementById('formV').reset();
      $("#btnImgVGuardar").prop('disabled', 'disabled');
      $("#btnImgVCancelar").prop('disabled', 'disabled');
      adminVisible = false;
      fotoTemp = undefined;
      formData = undefined;
    }
    else{
      if (foto == undefined || foto == null || foto == "") { foto = "foto_default.jpg"; }
      $("#imgV").attr('src', "/packages/images/perfilVendedores/"+foto);
      $("#tablaInicialV").hide('slow');
      $("#gestionDatosV").show('slow');
      adminVisible = true;
    }
  }

  /*
   *  Mostrar el formulario de administración para registrar a un nuevo
   *  vendedor
  */
  var mostrarRegistrar = function(){
    tipoGuardado = 'registrar';
    showHideAdmin();
  }

  /*
   *  Obtenemos los datos que se encuentran en nuestro formulario de administracion
   *  de informacion del vendedor.
  */
  var getDatosForm = function(){
    var data = {
      id : idSeleccionado,
      nombre : $("#nombreV").val(),
      apellidos : $("#appellidosV").val(),
      correo : $("#correoV").val(),
      telefono : $("#telV").val(),
      sexo : $("#sexoV").val(),
      ciudad : $("#ciudadV").val()
    }
    return data;
  }

  /*
   * validación de los datos y envío de petición a servidor para guardar
   * a un nuevo vendedor en el sistema de BD
  */
  var guardarRegistro = function(){
    if ($("#formV").valid()){
      $("#btnCancelarV").prop('disabled', 'disabled');
      $("#btnGuardarV").prop('disabled', 'disabled');
      $("#btnGuardarV").html("<span class='fa fa-spinner fa-pulse fa-fw'></span>&nbsp; Guardando");
      var datos = getDatosForm();
      if (tipoGuardado == 'registrar'){
        $servicio_v.vendedor.guardar(datos);
      }
      if (tipoGuardado == 'actualizar'){
        $servicio_v.vendedor.actualizar(datos);
      }
    }
  }

  /*
   *  Se obtienen los estados mediante el uso del objeto de servicios
   *  y se agrega cada uno de los estados en el input correspondiente
  */
  var establecerEstados = function(){
    var estados = $servicio_v.direccion.getEstados('mexico');
    $.each(estados, function(index, estado) {
      var option = $("<option/>");
      option.val(estado['id']);
      option.text(estado['nombre']);
      $("#estadoV").append(option);
    });
  }

  /*
   *  Se obtienen las ciudades mediante el uso del objeto de servicios
   *  y se agrega cada uno de los estados en el input correspondiente
   *  todo segun el estado seleccionado
  */
  var establecerCiudades = function(estado, pais){
    var ciudades = $servicio_v.direccion.getCiudades(estado, pais);
    $("#ciudadV").html('');
    $.each(ciudades, function(index, ciudad) {
      var option = $("<option/>");
      option.val(ciudad['id']);
      option.text(ciudad['nombre']);
      $("#ciudadV").append(option);
    });
  }

  /*
   *  Llenar el formulario segun la información del vendedor
   *  que ha sido seleccionado.
  */
  var mostrarActualizar = function(){
    var $tabla = $("#tabla-vendedores");
    if ($tabla.bootstrapTable('getSelections').length != 0){
      var datos = JSON.parse($tabla.bootstrapTable('getSelections')[0].datos);
      if (datos['id'] != 0){
        $(".btnimg").show();
        tipoGuardado = 'actualizar';
        establecerCiudades(datos['estadoId'], 'mexico');
        fotoTemp = datos['foto'];
        $("#imgV").attr('src', "/packages/images/perfilVendedores/"+datos['foto']);
        $("#nombreV").val(datos['nombre']);
        $("#appellidosV").val(datos['apellidos']);
        $("#correoV").val(datos['correo']);
        $("#telV").val(datos['telefono']);
        $("#sexoV").val(datos['sexo']);
        $("#estadoV").val(datos['estadoId']);
        $("#ciudadV").val(datos['ciudad_id']);
        idSeleccionado = datos['id'];
        showHideAdmin(datos['foto']);
      }
      else {
        $curiosity.noty("Este registro no puede ser modificado \nContacte a su administrador.", "info");
      }
    }
  }

  /*
   *  Se solicita la petición para eliminar al vendedor seleccionado
  */
  var eliminarVendedor = function(){
    if ($("#tabla-vendedores").bootstrapTable('getSelections').length != 0){
      var info = JSON.parse($("#tabla-vendedores").bootstrapTable('getSelections')[0].datos);
      if (info['id'] != 0){
        $servicio_v.vendedor.eliminar(info['id']);
      }
      else{
        $curiosity.noty("Este registro no puede ser eliminado \nContacte a su administrador.", "info");
      }
    }
  }

  /*
   *  Se establece el peso maximo de la imagen se subirá y se comprueba que el archivo
   *  sea valido segun el tipo de archivos establecidos.
   *  Si todo es correcto se crea una previsualizacion de la foto.
  */
  var seleccionarFoto = function(){
    var pesoMaximo = 2048000;
    var extensiones = new Array(".png", ".jpg", ".jpeg");
    var $archivo = $("#imagenV");
    if($curiosity.comprobarFile($archivo.val(), extensiones)){
      var archivos = document.getElementById("imagenV").files;
      if(archivos[0].size > pesoMaximo){
        $curiosity.noty("La imagen seleccionada excede el peso máximo (2 MB)", 'warning');
      }
      else {
        var navegador = window.URL || window.webkitURL;
        var objeto_url = navegador.createObjectURL(archivos[0]);
        $("#imgV").attr('src', objeto_url);
        $("#btnImgVGuardar").removeProp('disabled');
        $("#btnImgVCancelar").removeProp('disabled');
      }
    }
  }

  /*
   *  Se manda guardar la imagen que esta en el input
   *  esta funcion hace su efecto una vez que se cambio la imagen, no de otra manera
   *  ya que el boton que la manda llamar se encontrará deshabilitado.
  */
  var guardarFoto = function(){
    if ($("#imagenV").val() != ""){
      $("#btnImgVGuardar").html("<span class='fa fa-spinner fa-pulse fa-fw'></span>&nbsp;Guardando");
      formData = new FormData($("#formImagenV")[0]);
      formData.append('id', idSeleccionado);
      $("#imagenV").prop('disabled', 'true');
      $("#imagenVGuardar").prop('disabled', 'true');
      $("#imagenVCancelar").prop('disabled', 'true');
      $servicio_v.vendedor.actualizarFoto(formData);
    }
  }

  /*
   *  con esta funcion el valor del input se elimina y la imagen original
   *  se establece, haciendo el efecto que todo se encuentra como al inicio.
  */
  var cancelarFoto = function(){
    $("#btnImgVGuardar").prop('disabled', 'disabled');
    formData = undefined;
    $("#imagenV").val("");
    $("#imgV").attr('src', "/packages/images/perfilVendedores/"+fotoTemp);
  }

/*
 *  ==================================================================================
 *  Cargando la información necesaria para trabajar
 *  ==================================================================================
*/
  $servicio_v.vendedor.getActivos();
  establecerEstados();
  $("#telV").mask('(000) 000-0000', {placeholder:"Tel: (555) 555-555"});
  $("#btnImgVGuardar").prop('disabled', 'disabled');
  $("#btnImgVCancelar").prop('disabled', 'disabled');

});
