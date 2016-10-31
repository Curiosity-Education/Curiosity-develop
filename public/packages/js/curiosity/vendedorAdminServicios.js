var $servicio_v = {
  direccion : {
    makeEstados : function (pais){
      $.ajax({
        url: "/getByEstados-"+pais+"",
        type: 'POST'
      })
      .done(function(r) {
        if (localStorage.getItem("estados-"+pais) == null){
          localStorage.setItem("estados-"+pais, JSON.stringify(r));
        }
      })
      .fail(function(e) {
        console.log(e);
      });
    },
    makeCiudades : function (estado, pais){
      var data = {'estado':estado, 'pais':pais};
      $.ajax({
        url: "/getByCiudades",
        type: 'POST',
        data: data
      })
      .done(function(r) {
        if (localStorage.getItem("ciudades-"+estado+"-"+pais) == null){
          localStorage.setItem("ciudades-"+estado+"-"+pais, JSON.stringify(r));
        }
      })
      .fail(function(e) {
        console.log(e);
      });
    },
    getEstados : function(pais){
      $servicio_v.direccion.makeEstados(pais);
      return JSON.parse(localStorage.getItem("estados-"+pais));
    },
    getCiudades : function (estado, pais){
      $servicio_v.direccion.makeCiudades(estado, pais);
      return JSON.parse(localStorage.getItem("ciudades-"+estado+"-"+pais));
    }
  },
  vendedor : {
    getActivos : function(){
      $.ajax({
        url: '/obtenerVendedores',
        type: 'POST'
      })
      .done(function(r) {
        var datos = [];
        $.each(r, function(index, obj){
          datos.push({
            'nombre' : obj['nombre'] + " " + obj['apellidos'],
            'email' : obj['correo'],
            'tel' : obj['telefono'],
            'codigo' : obj["codigo"],
            'datos' : JSON.stringify(obj)
          });
        });
        $('#tabla-vendedores').bootstrapTable({
          data : datos
        });
      })
      .fail(function(e) {
        console.log(e);
      });
    },
    guardar : function (datos){
      $.ajax({
        url: '/vendedorGuardar',
        type: 'POST',
        data: datos
      })
      .done(function(r) {
        if($.isPlainObject(r)){
          $.each(r,function(index,value){
            $.each(value,function(i, message){
              $curiosity.noty(message, 'warning');
            });
          });
        }
        else {
          $curiosity.noty("Registrado Correctamente", "success");
          window.location.reload();
        }
      })
      .fail(function(e) {
        console.log(e);
        $curiosity.alertaSistemaError();
      });
    },
    actualizar : function (datos){
      $.ajax({
        url: '/vendedorActualizar',
        type: 'POST',
        data: datos
      })
      .done(function(r) {
        if($.isPlainObject(r)){
          $.each(r,function(index,value){
            $.each(value,function(i, message){
              $curiosity.noty(message, 'warning');
            });
          });
        }
        else {
          $curiosity.noty("Actualizado Correctamente", "success");
          window.location.reload();
        }
      })
      .fail(function(e) {
        console.log(e);
        $curiosity.alertaSistemaError();
      });
    },
    eliminar : function(id){
      var funcionRemover = function(){
        $.ajax({
          url: '/vendedorEliminar',
          type: 'POST',
          data: {'id' : id}
        })
        .done(function(r) {
          window.location.reload();
        })
        .fail(function(e) {
          console.log(e);
          $curiosity.alertaSistemaError();
        });
      }
      $curiosity.notyConfirm(funcionRemover);
    },
    actualizarFoto : function(foto){
      $.ajax({
        url: '/vendedorActualizarFoto',
        type: 'POST',
        data: foto,
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function(r) {
        $curiosity.noty("Foto Guardada Correctamente", "success");
        window.location.reload();
      })
      .fail(function(e) {
        console.log(e);
        $curiosity.alertaSistemaError();
      });
    }
  }
};
