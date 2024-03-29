
<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------

| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Correccion de password de manera manual
Route::get('/newpass', function(){
  return "El pass es: nayzaa258  - ( ".Hash::make('nayzaa258')." )";
});

Route::match(['POST','GET'],'/pay-suscription/{user_id?}/{cupon?}','userController@pay_card_suscription');
// ---./ Webhooks para saber quien ha pagado y quien no
Route::post('/webhook/check-suscription','userController@webhook_check_pay');
Route::get('/', 'principalController@verPagina');
Route::get('/nosotros', 'principalController@verNosotros');
Route::get('/proximamente',function(){
    return View::make('aviso_beta');
});
Route::get('/missedSession','sesionInfoController@missedSession');
Route::post('/last-session','sesionInfoController@getLastSession');
Route::get('/terminos-y-condiciones',function(){
    return View::make('terminos');
});
Route::get('/aviso-privacidad',function(){
    return View::make('aviso-privacidad');
});

Route::get('/nuestro-equipo',function(){
	return View::make('nuestro-equipo');
});
Route::get('/mentores',function(){
	return View::make('mentores');
});
Route::get('/preguntas-frecuentes',function(){
	return View::make('preguntas-frecuentes');
});

Route::get('/registro-exitoso',function(){
    return View::make('registro_exitoso');
});


// registro
Route::post('/remote-email','padreController@remoteEmail');
Route::get('/confirmar/{token}','padreController@confirmar');
Route::match(array('GET','POST'),'/suscripcion','suscripcionController@suscripcion');
Route::match((array('GET','POST')),'/regPadre','padreController@addPadre');
// Facebook user
Route::group(array('before' => 'unauth'), function(){
    Route::match(array('GET','POST'),'/login', 'loginController@verPagina');
    Route::match(array('GET','POST'),'/olvide-mi-contrasena/{token?}', 'loginController@recuperarCont');
    Route::match(array('GET','POST'),'/login-fb', 'loginController@loginFB');
    Route::post('/verificarUsuario', 'loginController@verificarUsuario');
});
// Route::get('/getCiudades','ciudadController@getCiudades');
Route::post('/remote-username','userController@remoteUsername');
// Route::post('/sendMensaje','padreController@sendMensaje');
Route::group(array('before' => 'auth'), function(){
        /* Rutas para obtencion de datos de direccion por AJAX */
        Route::post('/getByEstados-{pais}', 'direccionController@getEstados');
        Route::post('/getByCiudades', 'direccionController@getCiudades');
        /*Rutas para subir y ver juego*/
        Route::post('/actividad/setdata','actividadController@setDataActivity');
        Route::match(array('GET','POST'),'/asignar/juego/{idActividad}', 'actividadController@subirJuego');
        Route::group(array('before' => 'only_session'), function(){
        Route::get('/figuras',function(){
          return View::make('juegos.figuras');
        });
        Route::post('/buscarTema', 'temaController@temasFound');
        // padres
        Route::group(array('before' => 'gestion_data_padre'), function(){
          Route::get('/puntajes', 'padreController@getPuntajes');
          Route::get('/alertas', 'padreController@getAlertasNow');
          Route::get('/misHijos', 'hijoController@info');
          Route::get('/gethijos','padreController@gethijos');
          Route::post('/desgloce/hijo/{idHijo}','hijoController@desgloceJuegos');
          Route::post('/getMeta/hijo/{idHijo}','hijoController@getMeta');
          Route::post('/obtenerUsoPlataforma','padreController@getUsoPlataforma');
          Route::post('/regHijo','hijoController@addHijo');
          Route::post('/cotarhijos','padreController@getCountHijos');
          Route::post('/getsegs','padreController@seguimientoHijo');
          Route::post('/tour-first','padreController@tourFirst');
        });
        // salir (cerrar sesion)
        Route::get('/logout', 'loginController@salir');
        // Acceder a juego
        Route::post('/hasgame','actividadController@hasGame');
        Route::post("/actividad-save-cali","actividadController@saveCalificationActivity");
        Route::post("/actividad-get-cali","actividadController@getCalificacionActivity");
        // Route::get('/recordatorio','hijoController@recordatorio');
        Route::get('/bloques', 'bloqueController@verPagina');
        Route::get('/perfil', 'userController@verPagina');
        Route::post('/updatePerfil','perfilController@update');
        Route::post('/updatePerfilUser','perfilController@updateUser');
        Route::post('/checkPassword','perfilController@checkPassword');
        Route::post('/remote-username-update','userController@remoteUsernameUpdate');
        Route::post('/remote-password-update','userController@remotePasswordUpdate');
      	Route::post('/remote-username-hijo','userController@remoteUsernameHijo');
        Route::post('/remote-username-admin','userController@remoteUsernameAdmin');
        Route::post('/foto','perfilController@cutImage');
        Route::post('/regAdmin','userController@saveAdmin');
        // Realizar Actividades
        Route::group(array('before' => 'realizar_actividades'),function(){
          Route::group(array('before' => 'utilizar_tienda'), function(){
            Route::get('/tienda', 'tiendaController@viewPage');
          });
          Route::post('/cambiarSkin', 'tiendaController@cambiarSkin');
          Route::post('/comprarSkin', 'tiendaController@comprarSkin');
          Route::post('/cambiarAvatar', 'tiendaController@cambiarAvatar');
          Route::get('/inicio', 'contenidoController@getInicio');
          Route::post('/asignAvatar', 'hijoController@asignAvatar');
          Route::get('/juego/{idActividad}/{nombre}','actividadController@getViewJuego');
          Route::get('/nivel', 'nivelController@verPaginaInWeb');
          Route::get('/inteligencia{idNivel}', 'inteligenciaController@verPaginaInWeb');
          Route::get('/bloque{id}', 'bloqueController@verPaginaInWeb');
          Route::get('/tema{id}', 'temaController@verPaginaInWeb');
          Route::get('/actividad{id}', 'actividadController@verPaginaInWeb');
          Route::post('/metaChange', 'hijoController@changeMeta');
          Route::post('/getSpriteselected-{nameType}', 'secuenciaController@getSelectedSprite');
          Route::post('/getVideos', 'contenidoController@getAllVideos');
        });

		// NOVEDADES

		Route::group(array('before' => 'gestionar_novedades'),function(){
			// Validaciones remotas
			Route::match(array('GET','POST'), '/tituloRemoto-papa', 'novedadesController@tituloNov_papa');
			Route::match(array('GET','POST'), '/tituloRemoto-hijo', 'novedadesController@tituloNov_hijo');
      		Route::match(array('GET','POST'), '/linkRemoto-hijo', 'novedadesController@linkNov_hijo');

			// Gestión Novedades
			Route::match(array('GET','POST'), '/vistaNovedades', 'novedadesController@getViewNovedad');

			Route::match(array('GET','POST'), '/add-papaNovedad', 'novedadesController@add_papaNovedad');
			Route::match(array('GET','POST'), '/edit-papaNovedad/{id}', 'novedadesController@edit_papaNovedad');
			Route::match(array('GET','POST'), '/delete-papaNovedad/{id}', 'novedadesController@delete_papaNovedad');
			Route::match(array('GET','POST'), '/add-hijoNovedad', 'novedadesController@add_hijoNovedad');
			Route::match(array('GET','POST'), '/edit-hijoNovedad/{id}', 'novedadesController@edit_hijoNovedad');
			Route::match(array('GET','POST'), '/delete-hijoNovedad/{id}', 'novedadesController@delete_hijoNovedad');

		});


        Route::group(array('before' => 'gestionar_niveles'),function(){
          // Niveles
          Route::match(array('GET', 'POST'), '/adminNivel', 'nivelController@verPagina');
          Route::post('/updateNivel', 'nivelController@update');
          Route::post('/removeNivel', 'nivelController@remove');
          Route::post('/changeImageNivel{id}', 'nivelController@changeImage');
        });
        Route::group(array('before' => 'gestionar_inteligencias'),function(){
          // Inteligencias
          Route::match(array('GET', 'POST'), '/adminInteligencia{nivel}', 'inteligenciaController@verPagina');
          Route::post('/updateInteligencia', 'inteligenciaController@update');
          Route::post('/removeInteligencia', 'inteligenciaController@remove');
          Route::post('/changeImageInteligencia{id}', 'inteligenciaController@changeImage');
        });
        Route::group(array('before' => 'gestionar_bloques'),function(){
          // Bloques
          Route::match(array('GET', 'POST'), '/admin-bloque-{id}{nivelID}', 'bloqueController@verPagina');
          Route::post('/updateBloque', 'bloqueController@update');
          Route::post('/removeBloque', 'bloqueController@remove');
          Route::post('/changeImageBloque{id}', 'bloqueController@changeImage');
        });
        Route::group(array('before' => 'gestionar_temas'),function(){
          // Temas
          Route::match(array('GET', 'POST'), '/admin-tema-{id}-{inteligencia}-{nivel}', 'temaController@verPagina');
          Route::post('/updateTema', 'temaController@update');
          Route::post('/removeTema', 'temaController@remove');
          Route::post('/changeImageTema{id}', 'temaController@changeImage');
        });
        Route::group(array('before' => 'gestionar_actividades'),function(){
          // Actividades
          Route::match(array('GET', 'POST'), '/admin-actividad-{id}-{bloque}-{inteligencia}-{nivel}', 'actividadController@verPagina');
          Route::post('/updateActividad', 'actividadController@update');
          Route::post('/removeActividad', 'actividadController@remove');
          Route::post('/changeImageActividad{id}', 'actividadController@changeImage');
          Route::post('/move/game','actividadController@moveGame');
          Route::post('/delete/game','actividadController@disabledGame');
        });
        // Escuelas
        Route::group(array('before' => 'gestionar_escuelas'), function(){
          Route::match(array('GET', 'POST'), '/adminEscuela', 'escuelaController@verPagina');
          Route::post('/updateEscuela', 'escuelaController@update');
          Route::post('/removeEscuela', 'escuelaController@remove');
          /* SE COLOCAN LOS VENDEDORES EN ESTE APARTADO MIENTRAS SE REESTRUCTURAN LOS PERMISOS Y ROLES */
          Route::get('/lista-vendedores', 'vendedorController@verPagina');
          Route::post('/vendedorGuardar', 'vendedorController@guardar');
          Route::post('/vendedorActualizar', 'vendedorController@actualizar');
          Route::post('/vendedorEliminar', 'vendedorController@eliminar');
          Route::post('/vendedorActualizarFoto', 'vendedorController@guardarFoto');
          Route::post('/obtenerVendedores', 'vendedorController@obtenerActivos');
        });
        // profesores
        Route::match(array('GET', 'POST'), '/adminProfesor', 'profesorController@verPagina');
        Route::post('/updateProfesor', 'profesorController@update');
        Route::post('/removeProfesor', 'profesorController@remove');
        Route::post('/getProfeInfo', 'profesorController@getProfeInfo');
        // Estadisticas
        Route::post('/grafPuntajes', 'actividadController@grafPuntajes');
        Route::post('/getEstandarte', 'actividadController@getEstandarte');
        Route::post('/getEstadisticasHijo', 'actividadController@getEstadisticasHijo');
        // Obtener Inteligencias
        Route::get('/edu-{idGrade}-inteligencia', 'contenidoController@getInteligencias');
        // Filtro para la gestion de Avatar
        Route::group(array('before' => 'gestionar_avatar'), function(){
          // Administrar Avatar
          Route::get('/adminavatar', 'avatarController@gestionar');
          Route::post('/registrarAvatar', 'avatarController@registrarAvatar');
          Route::post('/eliminarAvatar', 'avatarController@eliminarAvatar');
          Route::post('/actualizarAvatar', 'avatarController@actualizarAvatar');
          // Administrar estilos
          Route::post('/getEstilos', 'avatarestilosController@getById');
          Route::post('/registrarEstilo', 'avatarestilosController@registrarEstilo');
          Route::post('/eliminarEstilo', 'avatarestilosController@eliminarEstilo');
          Route::post('/actualizarEstilo', 'avatarestilosController@actualizarEstilo');
          // Secuencias
          Route::post('/getSecuencias', 'secuenciaController@getById');
          Route::post('/getTiposSecuencia', 'secuenciaController@getTiposSecuencia');
          Route::post('/resgistrarSecuencia', 'secuenciaController@guardar');
          Route::post('/actualizarSecuencia', 'secuenciaController@actualizar');
          Route::post('/eliminarSecuencia', 'secuenciaController@eliminar');
        });
        //Monitoreo de Navegadores
        Route::match(array('GET','POST'),'/getBrowsers/{limit?}','sesionInfoController@getBrowsers');

        //Gestión de módulo de pagos
        //Route::group(['before' => 'gestionar_pagos'],function(){
            /*Vista administrar planes*/
            Route::get('/gestion-de-planes','planController@showView');
            Route::post('/crear-plan','planController@createPlan');
            Route::post('/actualizar-plan','planController@updatePlan');
            Route::post('/eliminar-plan','planController@deletePlan');
            Route::post('/leer-planes','planController@getPlanes');
        //});
    });

    Route::group(array('before' => 'gestionar_actividades'), function(){
      Route::get('/videoInicio', 'contenidoController@adminVideos');
      Route::post('/getAllVideosAdmin', 'contenidoController@myVideos');
      Route::post("/reindexarVideos",'contenidoController@reindexar');
    });


});
