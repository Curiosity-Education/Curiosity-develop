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

Route::get('/', 'principalController@verPagina');

/* ------------------------------------------------- */

/* ------------------------------------------------- */
Route::group(array('before' => 'unauth'), function(){
    Route::match(array('GET','POST'),'/login', 'loginController@verPagina');
    Route::post('/verificarUsuario', 'loginController@verificarUsuario');
});
Route::get('/confirmar/{token}','padreController@confirmar');
Route::match(array('GET','POST'),'/suscripcion','suscripcionController@suscripcion');
Route::match((array('GET','POST')),'/regPadre','padreController@addPadre');
Route::get('/getCiudades','ciudadController@getCiudades');
Route::post('/remote-username','userController@remoteUsername');
Route::post('/remote-email','padreController@remoteEmail');

Route::group(array('before' => 'auth'), function(){
    /*Rutas para subir y ver juego*/
    Route::get('/juego/{idActividad}/{nombre}','actividadController@getViewJuego');
    Route::post('/actividad/setdata','actividadController@setDataActivity');
    Route::match(array('GET','POST'),'/asignar/juego/{idActividad}', 'actividadController@subirJuego');
    Route::group(array('before' => 'only_session'), function(){
        // salir (cerrar sesion)
        Route::get('/logout', 'loginController@salir');

        // Acceder a juego
        Route::post('/hasgame','actividadController@hasGame');

        Route::get('/cursos', 'cursoController@verPagina');
        Route::get('/cursosAdmin', 'cursoController@verPaginaAdmin');
        Route::get('/bloques', 'bloqueController@verPagina');
        Route::get('/perfil', 'userController@verPagina');
        Route::post('/updatePerfil','perfilController@update');
        Route::post('/updatePerfilUser','perfilController@updateUser');
        Route::post('/checkPassword','perfilController@checkPassword');
        Route::post('/remote-username-update','userController@remoteUsernameUpdate');
        Route::post('/remote-password-update','userController@remotePasswordUpdate');
      	Route::post('/remote-username-hijo','userController@remoteUsernameHijo');
        Route::post('/remote-username-admin','userController@remoteUsernameAdmin');
        Route::post('/regHijo','hijoController@addHijo');
        Route::post('/foto','perfilController@cutImage');
        Route::post('/regAdmin','userController@saveAdmin');
        Route::group(array('before' => 'realizar_actividades'),function(){
        Route::get('/nivel', 'nivelController@verPaginaInWeb');
        Route::get('/inteligencia{idNivel}', 'inteligenciaController@verPaginaInWeb');
        Route::get('/bloque{id}', 'bloqueController@verPaginaInWeb');
        Route::get('/tema{id}', 'temaController@verPaginaInWeb');
        Route::get('/actividad{id}', 'actividadController@verPaginaInWeb');
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
          Route::match(array('GET', 'POST'), '/adminBloque{id}_{nivelID}', 'bloqueController@verPagina');
          Route::post('/updateBloque', 'bloqueController@update');
          Route::post('/removeBloque', 'bloqueController@remove');
          Route::post('/changeImageBloque{id}', 'bloqueController@changeImage');
        });
        Route::group(array('before' => 'gestionar_temas'),function(){
          // Temas
          Route::match(array('GET', 'POST'), '/adminTema{id}_{inteligencia}_{nivel}', 'temaController@verPagina');
          Route::post('/updateTema', 'temaController@update');
          Route::post('/removeTema', 'temaController@remove');
          Route::post('/changeImageTema{id}', 'temaController@changeImage');
        });
        Route::group(array('before' => 'gestionar_actividades'),function(){
          // Actividades
          Route::match(array('GET', 'POST'), '/adminActividad{id}_{bloque}_{inteligencia}_{nivel}', 'actividadController@verPagina');
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
    });


});
