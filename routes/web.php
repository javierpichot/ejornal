<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group whComprendo los derechos de privacidad y me responsabilizo de las acciones que se ich
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/', 'Auth\LoginController@showLoginForm')->name('home');

Route::get('/2fa/enable', 'Backend\Google2FAController@enableTwoFactor')->middleware('auth');
Route::get('/2fa/disable', 'Backend\Google2FAController@disableTwoFactor')->middleware('auth');
Route::get('/2fa/validate', 'Auth\LoginController@getValidateToken');
Route::post('/2fa/validate', ['middleware' => 'throttle:5', 'uses' => 'Auth\LoginController@postValidateToken']);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/reportes/{empresa_id}/{nombre}', 'ReporteController@index')->name('reportes.index');
Route::post('/reportes/downloadReporteComunicacion', 'ReporteController@downloadReporteComunicacion')->name('reporte.downloadReporteComunicacion');
Route::post('/reportes/downloadReporteDocumetacionEmpresa', 'ReporteController@downloadReporteDocumetacionEmpresa')->name('reporte.downloadReporteDocumetacionEmpresa');
Route::post('/reportes/downloadReporteDocumetacionTrabajadores', 'ReporteController@downloadReporteDocumetacionTrabajadores')->name('reporte.downloadReporteDocumetacionTrabajadores');

Route::post('/reportes/downloadReporteConsultas', 'ReporteController@downloadReporteConsultas')->name('reporte.downloadReporteConsultas');
/**
 * Impersonate User. Requires authentication.
 */
Route::post('impersonate/{id}', 'Backend\ImpersonateController@impersonate')->name('impersonate');
/**
 * Stop Impersonate. Requires authentication.
 */
Route::get('impersonate/stop', 'Backend\ImpersonateController@stopImpersonate')->name('impersonate.stop');


Route::get('medico-domicilio/{trabajador_id}/{prestacion_id}', 'Trabajador\MedicoDomicilioController@show')->name('medico.domicilio.show');
Route::patch('medico-domicilio/enviar-info-reporte/{prestacion_id}', 'Trabajador\MedicoDomicilioController@sendInfoReportService')->name('medico.domicilio.store');

//Messeger
Route::get('messages/', 'MessageController@index')->name('messages@index');



Route::namespace('Backend')
    ->prefix('administrador')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/sms', 'TwilioController@recordatorio_sms')->name('twilio.index');

        Route::get('/ajustes', 'ProveedorController@ajustes')->name('ajustes.index');

        Route::get('/dashboard', 'ProveedorController@dashboard')->name('dashboard.index');


        Route::get('/proveedores', 'ProveedorController@index')->name('proveedores.index');
        Route::get('/proveedor/create', 'ProveedorController@create')->name('proveedor.create');
        Route::post('/proveedor/store', 'ProveedorController@store')->name('proveedor.store');
        Route::get('/proveedor/{id}/edit', 'ProveedorController@edit')->name('proveedor.edit');
        Route::patch('/proveedor/{id}/update', 'ProveedorController@update')->name('proveedor.update');


        Route::get('/diagnosticos', 'DiagnosticoController@index')->name('diagnostico.index');
        Route::get('/diagnostico/create', 'DiagnosticoController@create')->name('diagnostico.create');
        Route::post('/diagnostico/store', 'DiagnosticoController@store')->name('diagnostico.store');
        Route::get('/diagnostico/{id}/edit', 'DiagnosticoController@edit')->name('diagnostico.edit');
        Route::patch('/diagnostico/{id}/update', 'DiagnosticoController@update')->name('diagnostico.update');




        Route::get('/empresas', 'EmpresaController@index')->name('empresa.index');
        Route::get('/empresa/{id}/show', 'EmpresaController@show')->name('empresa.show');
        Route::get('/empresa/{id}/edit', 'EmpresaController@edit')->name('empresa.edit');
        Route::patch('/empresa/{id}/update', 'EmpresaController@update')->name('empresa.update');
        Route::get('/empresa/create', 'EmpresaController@create')->name('empresa.create');
        Route::post('/empresa/store', 'EmpresaController@store')->name('empresa.store');
        Route::delete('/empresa/{id}/destroy', 'EmpresaController@destroy')->name('empresa.destroy');

        //Documentos internos
        Route::get('/documentacion-jornals', 'DocumentacionJornalController@index')->name('documento_jornal.index');
        Route::get('/documentacion-jornal/{id}/show', 'DocumentacionJornalController@show')->name('documento_jornal.show');
        Route::get('/documentacion-jornal/{id}/edit', 'DocumentacionJornalController@edit')->name('documento_jornal.edit');
        Route::patch('/documentacion-jornal/{id}/update', 'DocumentacionJornalController@update')->name('documento_jornal.update');
        Route::get('/documentacion-jornal/create', 'DocumentacionJornalController@create')->name('documento_jornal.create');
        Route::post('/documentacion-jornal/store', 'DocumentacionJornalController@store')->name('documento_jornal.store');
        Route::delete('/documentacion-jornal/{id}/destroy', 'DocumentacionJornalController@destroy')->name('documento_jornal.destroy');
        //Route::delete('/tarea/{id}/destroy', 'TareaController@destroy')->name('tarea.destroy');

        //Documentacion Tipo empresa
        Route::get('/documentacion-tipo-empresa', 'DocumentacionTipoEmpresaController@index')->name('documentacion_tipo_empresa.index');
        Route::get('/documentacion-tipo-empresa/{id}/show', 'DocumentacionTipoEmpresaController@show')->name('documentacion_tipo_empresa.show');
        Route::get('/documentacion-tipo-empresa/{id}/edit', 'DocumentacionTipoEmpresaController@edit')->name('documentacion_tipo_empresa.edit');
        Route::patch('/documentacion-tipo-empresa/{id}/update', 'DocumentacionTipoEmpresaController@update')->name('documentacion_tipo_empresa.update');
        Route::get('/documentacion-tipo-empresa/create', 'DocumentacionTipoEmpresaController@create')->name('documentacion_tipo_empresa.create');
        Route::post('/documentacion-tipo-empresa/store', 'DocumentacionTipoEmpresaController@store')->name('documentacion_tipo_empresa.store');
        Route::delete('/documentacion-tipo-empresa/{id}/destroy', 'DocumentacionTipoEmpresaController@destroy')->name('documentacion_tipo_empresa.destroy');

        //Fichada profesional
        Route::get('/profesional-fichada', 'ProfesionalFichadaController@index')->name('profesional-fichada.index');
        Route::get('/profesional-fichar', 'ProfesionalFichadaController@store')->name('profesional-fichar.index');
        Route::post('/profesional-fichar-entrada', 'ProfesionalFichadaController@getEntradas')->name('profesional.getEntradas');
        Route::post('/profesional-fichar-salida', 'ProfesionalFichadaController@getSalidas')->name('profesional.getSalidas');


        //Prestaciones empresas
        Route::get('/gestion-pedidos', 'PrestacionPedidoController@index')->name('gestion-pedidos.index');




        //Sucursales
        Route::get('/sucursales', 'SucursalController@index')->name('sucursales.index');
        Route::get('/sucursal/create', 'SucursalController@create')->name('sucursal.create');
        Route::post('/sucursal/store', 'SucursalController@store')->name('sucursal.store');
        Route::get('/sucursal/{id}/edit', 'SucursalController@edit')->name('sucursal.edit');
        Route::patch('/sucursal/{id}/update', 'SucursalController@update')->name('sucursal.update');


        Route::get('/tipo-incidencias', 'TipoIncidenciaController@index')->name('tipo-incidencias.index');
        Route::get('/tipo-incidencia/create', 'TipoIncidenciaController@create')->name('tipo-incidencia.create');
        Route::post('/tipo-incidencia/store', 'TipoIncidenciaController@store')->name('tipo-incidencia.store');
        Route::get('/tipo-incidencia/{id}/edit', 'TipoIncidenciaController@edit')->name('tipo-incidencia.edit');
        Route::patch('/tipo-incidencia/{id}/update', 'TipoIncidenciaController@update')->name('tipo-incidencia.update');

        Route::get('/profesionales', 'ProfesionalController@index')->name('profesional.index');
        Route::get('/profesional/create', 'ProfesionalController@create')->name('profesional.create');
        Route::post('/profesional/store', 'ProfesionalController@store')->name('profesional.store');
        Route::get('/profesional/{id}/edit', 'ProfesionalController@edit')->name('profesional.edit');
        Route::get('/profesional/{id}/show', 'ProfesionalController@show')->name('profesional.show');
        Route::patch('/profesional/{id}/update', 'ProfesionalController@update')->name('profesional.update');
        Route::get('/profesional/movimientos', 'ProfesionalController@movimientos')->name('profesional.movimientos');


        Route::delete('profesional/{profesional_id}/destroy', 'ProfesionalController@destroy')->name('profesional.destroy');


        Route::get('/tipo-prestaciones', 'PrestacionTipoController@index')->name('tipo-prestacion.index');
        Route::get('/tipo-prestacion/create', 'PrestacionTipoController@create')->name('tipo-prestacion.create');
        Route::post('/tipo-prestacion/store', 'PrestacionTipoController@store')->name('tipo-prestacion.store');
        Route::get('/tipo-prestacion/{id}/edit', 'PrestacionTipoController@edit')->name('tipo-prestacion.edit');
        Route::patch('/tipo-prestacion/{id}/update', 'PrestacionTipoController@update')->name('tipo-prestacion.update');


        Route::get('/proveedores', 'ProveedorController@index')->name('proveedores.index');
        Route::get('/proveedor/create', 'ProveedorController@create')->name('proveedor.create');
        Route::post('/proveedor/store', 'ProveedorController@store')->name('proveedor.store');
        Route::get('/proveedor/{id}/edit', 'ProveedorController@edit')->name('proveedor.edit');
        Route::patch('/proveedor/{id}/update', 'ProveedorController@update')->name('proveedor.update');

        //Roles
        Route::get('/roles', 'RoleController@index')->name('roles.index');
        Route::get('/role/create', 'RoleController@create')->name('role.create');
        Route::post('/role/store', 'RoleController@store')->name('role.store');
        Route::get('/role/{id}/edit', 'RoleController@edit')->name('role.edit');
        Route::delete('/role/{id}/destroy', 'RoleController@destroy')->name('role.destroy');
        Route::patch('/role/{id}/update', 'RoleController@update')->name('role.update');

        //permissos
        Route::get('/permissions', 'PermissionController@index')->name('permissions.index');
        Route::get('/permission/create', 'PermissionController@create')->name('permission.create');
        Route::post('/permission/store', 'PermissionController@store')->name('permission.store');
        Route::get('/permission/{id}/edit', 'PermissionController@edit')->name('permission.edit');
        Route::patch('/permission/{id}/update', 'PermissionController@update')->name('permission.update');


        /*Route::get('/user-empresa', 'UserEmpresaController@index')->name('user-empresa.index');
        Route::get('/user-empresa/create', 'UserEmpresaController@create')->name('user-empresa.create');
        Route::post('/user-empresa/store', 'UserEmpresaController@store')->name('user-empresa.store');
        Route::get('/user-empresa/{id}/edit', 'UserEmpresaController@edit')->name('user-empresa.edit');
        Route::get('/user-empresa/{id}/show', 'UserEmpresaController@show')->name('user-empresa.show');
        Route::patch('/user-empresa/{id}/update', 'UserEmpresaController@update')->name('user-empresa.update');*/


        Route::get('/users', 'UsuarioController@index')->name('users.index');
        Route::get('/user/create', 'UsuarioController@create')->name('user.create');
        Route::post('/user/store', 'UsuarioController@store')->name('user.store');
        Route::get('/user/{id}/edit', 'UsuarioController@edit')->name('user.edit');
        Route::get('/user/{id}/show', 'UsuarioController@show')->name('user.show');
        Route::patch('/user/{id}/update', 'UsuarioController@update')->name('user.update');
        Route::delete('/user/{id}/destroy', 'UsuarioController@destroy')->name('user.destroy');
        Route::get('/user/movimientos', 'UsuarioController@movimientos')->name('user.movimientos');

        Route::resource('remitente', 'RemitenteController');

        Route::resource('comunicacion-tipo', 'ComunicacionTipoController');
        Route::resource('consulta-motivo', 'ConsultaMotivoController');
        Route::resource('consulta-tipo', 'ConsultaTipoController');
        //Route::resource('user-empresa',  'UserEmpresaController');
    });

    Route::namespace('Empresa')
        ->prefix('empresa')
        ->name('empresa.')
        ->middleware(['guest'])
        ->group(function () {
            Route::get('mailing-domicilios/{id}/{token}/show', 'PrestacionApprovedController@show')->name('mailing.show');
        });

Route::namespace('Empresa')
    ->prefix('empresa')
    ->name('empresa.')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/export-excel/exportsTrabajadores/{type}/{empresa_id}', 'ExportListTrabajadorsController@exportsTrabajadores')->name('exportsTrabajadores');

        //WEbMail
        Route::get('/{id}/{name}/mails/{folder}', 'WebMailController@index')->name('mails.index');
        Route::get('/{id}/{name}/mail/send/create', 'WebMailController@create')->name('mails.create');
        Route::post('/{id}/{name}/mail/send/store', 'WebMailController@store')->name('mail.store');
        Route::get('/{id}/{name}/mail/{folder}/{message_id}', 'WebMailController@show')->name('mail.show');
        Route::delete('/{id}/{name}/mail/{folder}/{message_id}', 'WebMailController@destroy')->name('mail.destroy');

        Route::get('/{id}/{name}/show', 'EmpresaController@show')->name('show');

        //Tickets
        Route::get('/{id}/{name}/ticket-empresa', 'EmpresaController@getTicketEmpresa')->name('ticket-empresa.index');
        Route::get('/{id}/{id_empresa}/ticket-empresa/edit', 'EmpresaController@editTicketEmpresa')->name('ticket-empresa.edit');
        Route::patch('/{id}/{id_empresa}/ticket-empresa/update', 'EmpresaController@updateTicketEmpresa')->name('ticket-empresa.update');
        Route::post('ticket-empresa/store', 'TicketController@store')->name('ticket-empresa.store');

        Route::get('/ticket/{id}/{id_empresa}/comentarios', 'TicketComentarioController@show')->name('ticket.comentario.view');

        Route::post('/ticket/comentario/store', 'TicketComentarioController@store')->name('ticket.comentario.store');
        Route::post('/ticket/upload-files', 'TicketComentarioController@getUploadFiles')->name('ticket.uploadfiles.store');
        Route::get('/ticket/{id}/comentarios', 'TicketComentarioController@getComments')->name('ticket.comentarios.store');
        Route::patch('/ticket/comentario/{id}/update', 'TicketComentarioController@update')->name('ticket.comentario.update');

        Route::patch('/ticket/comentario/{id}/open-ticket', 'TicketComentarioController@openTicket')->name('ticket.comentario-open.update');

        Route::delete('ticket/{id}/destroy', 'TicketComentarioController@destroy')->name('ticket.destroy');


        Route::get('/{id}/{name}/movimientos', 'MovimientoEmpresaController@show')->name('movimientos.show');

        //Medico a domicilio
        Route::get('/{id}/{name}/medicos-a-domicilio', 'MedicoDomicilioController@index')->name('medicos_domicilio.index');



        //Trabajadores listado
        Route::get('/{id}/{name}/trabajadores', 'EmpresaController@getTrabajadores')->name('trabajadores.index');
        Route::post('trabajador/store', 'TrabajadorController@store')->name('trabajadores.store');
        Route::get('{id}/{name}/trabajadores/import-cvs', 'ImportTrabajadoresController@index')->name('trabajadores.import.index');
        Route::post('trabajadores/import-cvs', 'ImportTrabajadoresController@store')->name('trabajadores.import');

        Route::get('/{trabajador_id}/{id_empresa}/trabajador/edit', 'TrabajadorController@edit')->name('trabajadores.edit');
        Route::patch('/{trabajador_id}/{id_empresa}/trabajador/update', 'TrabajadorController@update')->name('trabajadores.update');
        Route::delete('trabajador/{trabajador_id}/destroy', 'TrabajadorController@destroy')->name('trabajadores.destroy');

        //comunicaciones
        Route::get('/{id}/{name}/comunicaciones', 'ComunicacionController@index')->name('comunicaciones.index');

        //Certificados entregados
        Route::get('/{id}/{name}/certificaciones-entregadas', 'CertificadoEntregadoController@index')->name('certificaciones.index');

        //Revision Periodica entidades
        Route::get('/{id}/{name}/revision-entidades', 'RevisionPeriodicaEntidadController@index')->name('revisiones.index');
        Route::get('/{revision_id}/{id_empresa}/revision-entidades/edit', 'RevisionPeriodicaEntidadController@edit')->name('revision.edit');
        Route::patch('/{revision_id}/{id_empresa}/revision-entidades/update', 'RevisionPeriodicaEntidadController@update')->name('revision.update');
        Route::delete('revision-entidades/{revision_id}/destroy', 'RevisionPeriodicaEntidadController@destroy')->name('revision.destroy');
        Route::post('revision-entidades/store', 'RevisionPeriodicaEntidadController@store')->name('revision.store');

        //REvisiones periodicas
        Route::get('/{id}/{name}/revision-periodicas', 'RevisionPeriodicaController@index')->name('revision-periodicas.index');
        Route::get('/{revision_periodica_id}/{id_empresa}/revision-periodica/edit', 'RevisionPeriodicaController@edit')->name('revision-periodica.edit');
        Route::patch('/{revision_periodica_id}/{id_empresa}/revision-periodica/update', 'RevisionPeriodicaController@update')->name('revision-periodica.update');
        Route::delete('revision-periodica/{revision_periodica_id}/destroy', 'RevisionPeriodicaController@destroy')->name('revision-periodica.destroy');
        Route::post('revision-periodica/store', 'RevisionPeriodicaController@store')->name('revision-periodica.store');


        //Incidencias
        Route::get('/{id}/{name}/incidencias', 'IncidenciaController@index')->name('incidencias.index');
        Route::get('/{incidencia_id}/{id_empresa}/incidencia/edit', 'IncidenciaController@edit')->name('incidencias.edit');
        Route::get('/{incidencia_id}/{id_empresa}/incidencia/show', 'IncidenciaController@show')->name('incidencias.show');
        Route::patch('/{incidencia_id}/{id_empresa}/incidencia/update', 'IncidenciaController@update')->name('incidencias.update');
        Route::delete('incidencia/{incidencia_id}/destroy', 'IncidenciaController@destroy')->name('incidencias.destroy');
        Route::post('incidencia/store', 'IncidenciaController@store')->name('incidencia.store');

        //presatacion pedidos
        Route::get('/{id}/{name}/prestacion-pedidos', 'PrestacionPedidoController@index')->name('prestacion.pedido.index');
        Route::get('/{prestacion_id}/{id_empresa}/prestacion-pedido/edit', 'PrestacionPedidoController@edit')->name('prestacion.pedido.edit');
        Route::patch('/{prestacion_id}/{id_empresa}/prestacion-pedido/update', 'PrestacionPedidoController@update')->name('prestacion.pedido.update');
        Route::delete('prestacion-pedido/{prestacion_id}/destroy', 'PrestacionPedidoController@destroy')->name('prestacion.pedido.destroy');
        Route::post('prestacion-pedido/store', 'PrestacionPedidoController@store')->name('prestacion.pedido.store');
        Route::get('/prestacion-pedido/{id}/{id_empresa}/detalles', 'PrestacionPedidoController@show')->name('prestacion.pedido.show');

        //Cotizacion
        Route::post('cotizacion/store', 'PrestacionCotizacionController@store')->name('cotizacion.pedido.store');
        Route::patch('/{cotizacion_id}/{id_empresa}/cotizacion/update', 'PrestacionCotizacionController@update')->name('cotizacion.pedido.update');
        Route::get('/{cotizacion_id}/{id_empresa}/cotizacion/{pedido_id}/edit', 'PrestacionCotizacionController@edit')->name('cotizacion.pedido.edit');
        Route::delete('cotizacion/{cotizacion_id}/destroy', 'PrestacionCotizacionController@destroy')->name('cotizacion.pedido.destroy');
        //Presupuesto
        Route::post('presupuesto/store', 'PrestacionPresupuestoController@store')->name('presupuesto.pedido.store');
        Route::patch('/{presupuesto_id}/{id_empresa}/presupuesto/update', 'PrestacionPresupuestoController@update')->name('presupuesto.pedido.update');
        Route::get('/{presupuesto_id}/{id_empresa}/presupuesto/{pedido_id}/edit', 'PrestacionPresupuestoController@edit')->name('presupuesto.pedido.edit');
        Route::delete('presupuesto/{presupuesto_id}/destroy', 'PrestacionPresupuestoController@destroy')->name('presupuesto.pedido.destroy');

        //Orden servicio
        Route::post('orden/store', 'OrdenServicioController@store')->name('orden.pedido.store');
        Route::patch('/{orden_id}/{id_empresa}/orden/update', 'OrdenServicioController@update')->name('orden.pedido.update');
        Route::get('/{orden_id}/{id_empresa}/orden/{pedido_id}/edit', 'OrdenServicioController@edit')->name('orden.pedido.edit');
        Route::delete('orden/{orden_id}/destroy', 'OrdenServicioController@destroy')->name('orden.pedido.destroy');

        //Reporte de servicio
        Route::patch('/{prestacion_id}/{id_empresa}/prestacion/update', 'PrestacionPedidoController@getUpdateReporte')->name('reporte.pedido.update');
        Route::patch('/{prestacion_id}/{id_empresa}/pedido-close/update', 'PrestacionPedidoController@getClosePedido')->name('close.pedido.update');

        //ausentismo
        Route::get('/{id}/{name}/ausentismos', 'AusentismoController@index')->name('ausentismos.index');
        
        Route::get('/{ausentismo_id}/{id_empresa}/ausentismo/edit', 'AusentismoController@edit')->name('ausentismos.edit');
        Route::patch('/{ausentismo_id}/{id_empresa}/ausentismo/update', 'AusentismoController@update')->name('ausentismos.update');
        Route::delete('ausentismo/{ausentismo_id}/destroy', 'AusentismoController@destroy')->name('ausentismos.destroy');

        //Consultas
        Route::get('/{id}/{name}/consultas', 'ConsultaController@index')->name('consultas.index');
        Route::get('/{consulta_id}/{id_empresa}/consulta/edit', 'ConsultaController@edit')->name('consultas.edit');
        Route::patch('/{consulta_id}/{id_empresa}/consulta/update', 'ConsultaController@update')->name('consultas.update');
        Route::delete('consulta/{consulta_id}/destroy', 'ConsultaController@destroy')->name('consultas.destroy');

        //Documentacion
        Route::get('/{id}/{name}/documentos', 'DocumentacionController@index')->name('documentos.index');
        Route::post('/documentacion/store', 'DocumentacionController@store')->name('documentacion.store');
        Route::get('/documentacion/{id}/{id_empresa}/edit', 'DocumentacionController@edit')->name('documentacion.edit');
        Route::patch('/documentacion/{id}/{id_empresa}/update', 'DocumentacionController@update')->name('documentacion.update');
        Route::delete('/documentacion/{id}/destroy', 'DocumentacionController@destroy')->name('documentacion.destroy');

        Route::get('/documentacion/{empresa_id}/{filename}/{prestacion_pedido_id}/{type}/generate', 'DocumentacionController@generateUrl')->name('documentacion.generate');



        Route::get('/documentacion/{empresa_id}/{filename}/{prestacion_pedido_id}/{type}/download', 'DocumentacionController@download')->name('documentacion.download')->middleware('signedurl');

        Route::get('/documentacion-empresa/{empresa_id}/{filename}/{documento_id}/{type}/generate', 'DocumentacionController@generateUrlDocmunetacion')->name('documentacion.empresa.generate');
        Route::get('/documentacion-empresa/{empresa_id}/{filename}/{documento_id}/{type}/download', 'DocumentacionController@downloadDocumentacionEmpresa')->name('documentacion.empresa.download')->middleware('signedurl');


        //Estadisticas
        Route::get('/{id}/{name}/estadisticas/', 'EstadisticasController@show')->name('estadisticas.show');
        Route::post('/{id}/{name}/estadisticas/', 'EstadisticasController@show')->name('estadisticas.show');
        //Famarcia
        Route::get('/{id}/{name}/farmacos', 'FarmaciaDrogaController@index')->name('farmacos.index');
        Route::post('/farmaco/store', 'FarmaciaDrogaController@store')->name('farmacos.store');
        Route::post('/{farmaco_id}/{id_empresa}/farmaco/update', 'FarmaciaDrogaController@update')->name('farmacos.update');
        Route::get('/{id}/{name}/farmacos/stock', 'FarmaciaDrogaController@stockFamarcos')->name('farmacos.stock');
        Route::get('/{id_empresa}/farmacos/get', 'FarmaciaDrogaController@stockFamarcos')->name('farmacos.stock');
        Route::delete('farmaco/{id}/destroy', 'FarmaciaDrogaController@destroy')->name('farmacos.destroy');
        Route::get('/{id}/{empresa_id}/farmaco', 'FarmaciaDrogaController@edit')->name('farmacos.edit');
        Route::patch('/farmaco/{id}/{empresa_id}/update', 'FarmaciaDrogaController@getUpdate')->name('farmacos.getUpdate');
        Route::post('/export/exportsFarmacos', 'ExportFarmacosController@exportsFarmacos')->name('exportsFarmacos');
        Route::post('/export/exportsFarmacos/{id}/{empresa_id}', 'ExportFarmacosController@index')->name('exportsFarmacos.index');
        Route::post('/export/exportsFarmacosHistorico', 'ExportFarmacosController@exportsFarmacosHistoricos')->name('exportsFarmacosHistoricos');

        //Categorias empresa
        Route::delete('categoria/{empresa_id}/destroy', 'CategoriaController@destroy')->name('categoria.destroy');
        Route::delete('sector/{empresa_id}/destroy', 'SectorController@destroy')->name('sector.destroy');
        Route::delete('turno/{empresa_id}/destroy', 'TurnoController@destroy')->name('turno.destroy');
        Route::delete('tarea/{empresa_id}/destroy', 'TareaController@destroy')->name('tarea.destroy');

        //usuarios
        Route::get('/{id}/{name}/usuarios', 'UserEmpresaController@index')->name('usuarios.index');
        Route::post('/usuario/store', 'UserEmpresaController@store')->name('usuario.store');
        Route::get('/usuario/{id}/{id_empresa}/edit', 'UserEmpresaController@edit')->name('usuario.edit');
        Route::patch('/usuario/{id}/update', 'UserEmpresaController@update')->name('usuario.update');
        Route::delete('/usuario/{id}/destroy', 'UserEmpresaController@destroy')->name('usuario.destroy');
        Route::get('/usuario/{id}/{empresa_id}/show', 'UserEmpresaController@show')->name('usuario.show');
        Route::get('/usuario/create', 'UserEmpresaController@create')->name('usuario.create');


        //Tareas
        Route::get('/{id}/{name}/tareas-agentes-riesgo', 'TareaController@index')->name('tarea.agentes.index');
        Route::post('/usuario/tarea-agentes-riesgo', 'TareaController@store')->name('tarea.agentes.store');
        Route::get('/tarea-agentes-riesgo/{id}/{id_empresa}/edit', 'TareaController@edit')->name('tarea.agentes.edit');
        Route::patch('/tarea-agentes-riesgo/{id}/update', 'TareaController@update')->name('tarea.agentes.update');
        Route::get('/tarea-agentes-riesgo/create', 'TareaController@create')->name('tarea.agentes.create');
    });
    Route::namespace('Empresa')->prefix('api')
        ->name('api.')->middleware('auth')->group(function () {
            Route::get('/{id_empresa}/farmacos/get', 'FarmaciaDrogaController@getFarmacos')->name('getFarmacos.show');
        });

        Route::namespace('Empresa')->prefix('api')
            ->name('api.')->middleware('auth')->group(function () {
                Route::get('/trabajadores/{id_empresa}/get', 'EmpresaController@getTrabajadoresEmpresa')->name('show');
                Route::get('/movimientos-empresa/{empresa_id}/get', 'MovimientoEmpresaController@getMovimientos')->name('movimientos.show');
            });
        Route::namespace('Trabajador')->prefix('api')
            ->name('api.')->middleware('auth')->group(function () {
                Route::get('/movimientos-trabajador/{empresa_id}/{trabajador_id}/get', 'MovimientosTrabajadorControntroller@getMovimientos')->name('movimientos.show');
            });


Route::namespace('Backend')->prefix('api')
    ->name('api.')->middleware('auth')->group(function () {
        Route::get('/movimientos-profesionales/get', 'ProfesionalController@getMovimientos')->name('getMovimientos.show');
        Route::get('/movimientos-users/get', 'UsuarioController@getMovimientos')->name('getUsersMovimientos.show');
    });


Route::namespace('Trabajador')->prefix('trabajador')
    ->name('trabajador.')->middleware('auth')->group(function () {
        Route::get('/{id}/{name}/profile/{id_empresa}', 'TrabajadorController@show')->name('show');

        Route::get('/{id}/{name}/estadisticas/{id_empresa}', 'EstadisticasController@show')->name('estadisticas.show');
        Route::post('/{id}/{name}/estadisticas/{id_empresa}', 'EstadisticasController@show')->name('estadisticas.show_post');

        //Reportes
        Route::post('/reportes/comunicacion', 'ComunicacionController@getReporteComunicacion')->name('getReporteComunicacion');



        //tickets trabajadores
        //Cita
        Route::post('/trabajador/nueva-cita', 'CitaController@store')->name('cita.store');


        Route::get('/{id}/{name}/profile/{id_empresa}/ticket', 'TicketController@show')->name('ticket.show');

        Route::post('/ticket/store', 'TicketController@store')->name('ticket.store');
        Route::get('/ticket/{id}/{id_empresa}/edit', 'TicketController@edit')->name('ticket.edit');
        Route::patch('/ticket/{id}/{id_empresa}/update', 'TicketController@update')->name('ticket.update');
        Route::delete('/ticket/{id}/destroy', 'TicketController@destroy')->name('ticket.destroy');

        Route::get('/ticket/{id}/{id_empresa}/comentarios/{trabajador_id}', 'TicketComentarioController@show')->name('ticket.comentario.view');

        Route::post('/ticket/comentario/store', 'TicketComentarioController@store')->name('ticket.comentario.store');
        Route::post('/ticket/upload-files', 'TicketComentarioController@getUploadFiles')->name('ticket.uploadfiles.store');
        Route::get('/ticket/{id}/comentarios', 'TicketComentarioController@getComments')->name('ticket.comentarios.store');
        Route::patch('/ticket/comentario/{id}/destroy', 'TicketComentarioController@update')->name('ticket.comentario.update');

        Route::get('/documentacion/{trabajador_id}/{empresa_id}/{filename}/generate', 'DocumentacionController@generateUrl')->name('documentacion.generate');

        Route::get('/documentacion/{empresa_id}/{filename}/download', 'DocumentacionController@download')->name('documentacion.download')->middleware('signedurl');


        Route::get('/{id}/{name}/profile/{id_empresa}/prestacion-pedidos', 'PrestacionPedidoController@index')->name('prestacion.pedido.index');
        Route::get('/{prestacion_id}/{id_empresa}/prestacion-pedido/{trabajador_id}/edit', 'PrestacionPedidoController@edit')->name('prestacion.pedido.edit');
        Route::patch('/{prestacion_id}/{id_empresa}/prestacion-pedido/update', 'PrestacionPedidoController@update')->name('prestacion.pedido.update');
        Route::delete('prestacion-pedido/{prestacion_id}/destroy', 'PrestacionPedidoController@destroy')->name('prestacion.pedido.destroy');
        Route::post('prestacion-pedido/store', 'PrestacionPedidoController@store')->name('prestacion.pedido.store');
        Route::get('/prestacion-pedido/{id}/{name}/{trabajador_id}/detalles/{empresa_id}', 'PrestacionPedidoController@show')->name('prestacion.pedido.show');

        //Cotizacion
        Route::post('cotizacion/store', 'PrestacionCotizacionController@store')->name('cotizacion.pedido.store');
        Route::patch('/{cotizacion_id}/{id_empresa}/cotizacion/update', 'PrestacionCotizacionController@update')->name('cotizacion.pedido.update');
        Route::get('/{cotizacion_id}/{id_empresa}/cotizacion/{pedido_id}/edit', 'PrestacionCotizacionController@edit')->name('cotizacion.pedido.edit');
        Route::delete('cotizacion/{cotizacion_id}/destroy', 'PrestacionCotizacionController@destroy')->name('cotizacion.pedido.destroy');
        //Presupuesto
        Route::post('presupuesto/store', 'PrestacionPresupuestoController@store')->name('presupuesto.pedido.store');
        Route::patch('/{presupuesto_id}/{id_empresa}/presupuesto/update', 'PrestacionPresupuestoController@update')->name('presupuesto.pedido.update');
        Route::get('/{presupuesto_id}/{id_empresa}/presupuesto/{pedido_id}/edit', 'PrestacionPresupuestoController@edit')->name('presupuesto.pedido.edit');
        Route::delete('presupuesto/{presupuesto_id}/destroy', 'PrestacionPresupuestoController@destroy')->name('presupuesto.pedido.destroy');

        //Orden servicio
        Route::post('orden/store', 'OrdenServicioController@store')->name('orden.pedido.store');
        Route::patch('/{orden_id}/{id_empresa}/orden/update', 'OrdenServicioController@update')->name('orden.pedido.update');
        Route::get('/{orden_id}/{id_empresa}/orden/{pedido_id}/edit', 'OrdenServicioController@edit')->name('orden.pedido.edit');
        Route::delete('orden/{orden_id}/destroy', 'OrdenServicioController@destroy')->name('orden.pedido.destroy');

        //Reporte de servicio
        Route::patch('/{prestacion_id}/{id_empresa}/prestacion/update', 'PrestacionPedidoController@getUpdateReporte')->name('reporte.pedido.update');
        Route::patch('/{prestacion_id}/{id_empresa}/pedido-close/update', 'PrestacionPedidoController@getClosePedido')->name('close.pedido.update');


        //Comunicaciones
        Route::get('/{id}/{name}/profile/{id_empresa}/comunicaciones', 'ComunicacionController@show')->name('comunicacion.show');
        Route::post('/comunicacion/store', 'ComunicacionController@store')->name('comunicacion.store');
        Route::get('/comunicacion/{id}/{id_empresa}/{id_empleado}/edit', 'ComunicacionController@edit')->name('comunicacion.edit');
        Route::patch('/comunicacion/{id}/{id_empresa}/update', 'ComunicacionController@update')->name('comunicacion.update');
        Route::delete('/comunicacion/{id}/destroy', 'ComunicacionController@destroy')->name('comunicacion.destroy');

        //incidencias
        Route::get('/{id}/{name}/profile/{id_empresa}/incidencias', 'IncidenciaController@show')->name('incidencia.show');
        Route::post('/incidencia/store', 'IncidenciaController@store')->name('incidencia.store');
        Route::get('/incidencia/{id}/{id_empresa}/{id_empleado}/edit', 'IncidenciaController@edit')->name('incidencia.edit');
        Route::patch('/incidencia/{id}/{id_empresa}/update', 'IncidenciaController@update')->name('incidencia.update');
        Route::delete('/incidencia/{id}/destroy', 'IncidenciaController@destroy')->name('incidencia.destroy');
        Route::get('/{incidencia_id}/{trabajador_id}/incidencia/{id_empresa}show', 'IncidenciaController@view')->name('incidencias.view');

        //EXpedientes
        Route::get('/{id}/profile/{id_empresa}/expedientes', 'ExpedienteController@show')->name('expediente.show');
        Route::post('/expediente/store', 'ExpedienteController@store')->name('expediente.store');
        Route::get('/expediente/{id}/{id_empresa}/{id_empleado}/edit', 'ExpedienteController@edit')->name('expediente.edit');
        Route::patch('/expediente/{id}/{id_empresa}/update', 'ExpedienteController@update')->name('expediente.update');
        Route::delete('/expediente/{id}/destroy', 'ExpedienteController@destroy')->name('expediente.destroy');


        Route::get('/ausentismo/{id}/{id_empresa}/dossier/{trabajador_id}', 'DossierAusentismoController@show')->name('ausentismo.dossier.view');

        //Consultas
        Route::get('/{id}/{name}/profile/{id_empresa}/consultas', 'ConsultaController@show')->name('consulta.show');
        Route::post('/consulta/store', 'ConsultaController@store')->name('consulta.store');
        Route::get('/consulta-show/{id}/{id_empresa}/{id_empleado}/view', 'ConsultaController@getConsulta')->name('consulta.view');
        Route::get('/consulta/{id}/{id_empresa}/{id_empleado}/edit', 'ConsultaController@edit')->name('consulta.edit');
        Route::patch('/consulta/{id}/{id_empresa}/update', 'ConsultaController@update')->name('consulta.update');
        Route::delete('/consulta/{id}/destroy', 'ConsultaController@destroy')->name('consulta.destroy');

        //Diagnosticos
        Route::post('/diagnoticos/consultas', 'DiagnoticoController@show')->name('diagnotico.consulta.show');
        Route::post('/diagnotico/guia', 'DiagnoticoController@guia')->name('diagnotico.consulta.guia');


        //Documentacion
        Route::get('/{id}/{name}/profile/{id_empresa}/documentaciones', 'DocumentacionController@show')->name('documentacion.show');
        Route::post('/documentacion/store', 'DocumentacionController@store')->name('documentacion.store');
        Route::get('/documentacion/{id}/{id_empresa}/{id_empleado}/edit', 'DocumentacionController@edit')->name('documentacion.edit');
        Route::patch('/documentacion/{id}/{id_empresa}/update', 'DocumentacionController@update')->name('documentacion.update');
        Route::delete('/documentacion/{id}/destroy', 'DocumentacionController@destroy')->name('documentacion.destroy');

        Route::get('/documentacion/{empresa_id}/{trabajador_id}/{filename}/{documento_id}/{type}/generate/', 'TrabajadorController@generateUrl')->name('documentacion.generate');

        Route::get('/documentacion/{trabajador_id}/{empresa_id}/{filename}/{documento_id}/{type}/download/', 'TrabajadorController@download')->name('documentacion.download')->middleware('signedurl');

        //Reportes
        Route::get('/{id}/{name}/generar-reporte/{id_empresa}', 'ReporteController@index')->name('reporte.index');
        
        Route::get('/cita/{id}', 'CitaController@getGeneratePdfCita')->name('cita.pdf');
    });


//Calendario
Route::get('/calendario/{id_empresa}/{nombre}', 'EventController@index')->name('calendario.index');
Route::post('/events/modal_form', 'EventController@modal_form')->name('events.modal_form');
Route::get('/events/calendar_events/{id_empresa}/', 'EventController@show')->name('events.show');
Route::post('/events/view', 'EventController@view')->name('events.view');
Route::post('/events/save', 'EventController@store')->name('events.store');
Route::post('/events/update/event_status', 'EventController@update')->name('events.update');
Route::post('/event/destroy', 'EventController@destroy')->name('event.destroy');
Route::post('/leaves/application_details', 'DetalleCitaController@show')->name('application_details.show');





//Calendario jornal
Route::get('/calendario/jornals', 'EventsJornalController@index')->name('events_jornal.index');
Route::post('/events_jornal/modal_form', 'EventsJornalController@modal_form')->name('events_jornal.modal_form');
Route::get('/events_jornal/calendar_events', 'EventsJornalController@show')->name('events_jornal.show');
Route::post('/events_jornal/view', 'EventsJornalController@view')->name('events_jornal.view');
Route::post('/events_jornal/save', 'EventsJornalController@store')->name('events_jornal.store');
Route::post('/events_jornal/update/event_status', 'EventsJornalController@update')->name('events_jornal.update');
Route::post('/events_jornal/destroy', 'EventsJornalController@destroy')->name('events_jornal.destroy');
Route::post('/events_jornal/application_details', 'AusenciaDetallesController@show')->name('events_jornal.show');

Route::post('/messages/list_data/inbox', 'MessageController@getMessages')->name('messages.inbox');
Route::get('/message/{id}/inbox/{reply}', 'MessageController@getMessage')->name('message.show');
Route::patch('/message/reply/{id}', 'MessageController@update')->name('message.update');
Route::post('/message/validate_files', 'MessageController@validateFiles')->name('message.validateFiles');
Route::post('/message/upload_files', 'MessageController@uploadFiles')->name('message.uploadFiles');
Route::post('/message/create', 'MessageController@create')->name('message.create');
Route::post('/message/store', 'MessageController@store')->name('message.store');

Route::post('/message/get_active_chat', 'MessageController@get_active_chat')->name('message.get_active_chat');

Route::get('/message/chat_list', 'MessageController@chatList')->name('message.chatList');
Route::post('/message/view', 'MessageController@view')->name('message.view');
Route::post('/message/view_chat', 'MessageController@view_chat')->name('message.view_chat');

Route::post('/todo/save_status', 'TodoController@save_status')->name('todo.save_status');


//Tickets Jornals
Route::get('/tickets-jornals', 'TicketsJornalController@getTickets')->name('ticket-jornals.index');
Route::get('/{id}/ticket-jornals/edit', 'TicketsJornalController@editTicketEmpresa')->name('ticket-jornals.edit');
Route::patch('/{id}/ticket-jornals/update', 'TicketsJornalController@updateTicketEmpresa')->name('ticket-jornals.update');
Route::post('ticket-jornals/store', 'TicketsJornalController@store')->name('ticket-jornals.store');
Route::delete('ticket-jornals/{id}/destroy', 'TicketsJornalController@destroy')->name('ticket-jornals.destroy');

Route::get('/ticket-jornals/{id}/comentarios', 'TicketComentarioJornalsController@show')->name('ticket-jornals.comentarios.view');

Route::post('/ticket-jornals/comentario/store', 'TicketComentarioJornalsController@store')->name('ticket-jornals.comentario.store');
Route::post('/ticket-jornals/upload-files', 'TicketComentarioJornalsController@getUploadFiles')->name('ticket-jornals.uploadfiles.store');
Route::get('/ticket-jornals/{id}/comentarios/load', 'TicketComentarioJornalsController@getComments')->name('ticket-jornals.comentarios.store');
Route::patch('/ticket-jornals/comentario/{id}/update', 'TicketComentarioJornalsController@update')->name('ticket-jornals.comentario.update');

Route::patch('/ticket-jornals/comentario/{id}/open-ticket', 'TicketComentarioJornalsController@openTicket')->name('ticket-jornals.comentario-open.update');

Route::delete('ticket-jornals/{id}/destroy', 'TicketComentarioJornalsController@destroy')->name('ticket-jornals.destroy');


/**
 * Nuevos routes en json para la api en VueJS 
 * Mejorando la carga del sistema 
 */

Route::namespace('Empresa')->prefix('api')->middleware('auth')->group(function () { 
  Route::get('/tickets/{empresa_id}/json', 'TicketController@getTicketsJson')->name('tickets.json');
  Route::delete('/tickets/{ticket_id}/destroy', 'TicketController@destroy')->name('tickets.destroy');
  Route::put('/tickets/{id}/update', 'TicketController@update')->name('tickets.update');
  Route::get('/roles/json', 'TicketController@getRolesJson')->name('roles.json');

  Route::get('/ausentismos', 'AusentismoController@getAusentismoJson')->name('getAusentismoJson');
  Route::get('/comunicaciones', 'ComunicacionController@getComTrabajadorJson')->name('comunicaciones.json');
});


Route::namespace('Trabajador')->prefix('api')->middleware('auth')->group(function () { 

    
    Route::get('/trabajador/{trabajador_id}/{empresa_id}/edit', 'TrabajadorController@edit')->name('trabajador.edit.json');

    Route::get('/comunicaciones', 'ComunicacionController@getComTrabajadorJson')->name('comunicaciones.json');
    Route::patch('/comunicaciones/{id}/update', 'ComunicacionController@update')->name('comunicaciones.update');
    Route::delete('/comunicaciones/{comunicacion_id}/destroy', 'ComunicacionController@destroy')->name('comunicaciones.destroy');
    Route::get('/modo-comunicaciones/json', 'ComunicacionController@getModoComunicacion')->name('modo-comunicaciones.json');
    Route::get('/motivo-comunicaciones/json', 'ComunicacionController@getMotivoComunicacion')->name('motivo-comunicaciones.json');

    

    Route::get('/ausentismos/{id}/json', 'ComunicacionController@getAusentismoTrabajadorJson')->name('ausentismos-comunicaciones.json');
    Route::get('/documentos/{id}/son', 'ComunicacionController@getDocumentosTrabajadorJson')->name('documentos-comunicaciones.json');
});

Route::namespace('Backend')->prefix('api')->middleware('auth')->group(function () { 
    
    Route::get('/remitentes/json', 'RemitenteController@getRemitentesJson')->name('remitentes.json');
});

Route::namespace('Api')->prefix('api')->middleware('auth')->group(function () { 
    
    Route::post('/cita/store', 'CitaApiController@store')->name('cita.store');

    Route::get('/consultas/trabajador', 'ConsultaApiController@index')->name('consulta.trabajador.json');
    Route::post('/consultas/store', 'ConsultaApiController@store')->name('consulta.trabajador.store');
    Route::patch('/consultas/{id}/update', 'ConsultaApiController@update')->name('consulta.trabajador.update');
    Route::delete('/consultas/{id}/destroy', 'ConsultaApiController@destroy')->name('consulta.trabajador.destroy');

    Route::get('/consulta-reposo/json', 'ConsultaReposoApiController@index')->name('consulta-reposo.json');
    Route::get('/consulta-motivo/json', 'ConsultaMotivoApiController@index')->name('consulta-motivo.json');
    Route::get('/consulta-tipo/json', 'ConsultaTipoApiController@index')->name('consulta-tipo.json');
    Route::get('/prestacion-farmacia/empresa/json', 'PrestacionFarmaciaDrogaApiController@getPrestacionFarmacoEmpresa')->name('getPrestacionFarmacoEmpresa.json');
    Route::get('/ausentismo-trabajador/json', 'AusentismoApiController@getAusentismoTrabajador')->name('getAusentismoTrabajador.json');
    Route::get('/diagnostico/{id}/json', 'DiagnosticoApiController@show')->name('diagnostico.json');


    Route::get('/movimientos/json', 'MovimentosProfesionalApiController@index')->name('movimientos.profesional.json');

});