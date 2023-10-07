<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\Efemeride_C;
use App\Http\Controllers\EventosController;
use App\Http\Controllers\GaleriaArte_C;
use App\Http\Controllers\Inicio_C;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Noticias_C;
use App\Http\Controllers\PagesController; 
use App\Http\Controllers\PanelArtistaController;
use App\Http\Controllers\Panel_Denuncias_C;
use App\Http\Controllers\PanelPeriodistaController;
use App\Http\Controllers\PanelMarketplaceController;
use App\Http\Controllers\PanelSuscriptor_C; 
use App\Http\Controllers\Registro_C;
use App\Http\Controllers\RolController;
use App\Http\Controllers\Suscriptor_C;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Se utiliza el metodo view cuando se va a mostrar una pagina estatica, se carga sin pasar por el controlador 
// (url dada a criterio personal, ruta del archivo en la carpeta views, nombre de la ruta conectda al enlace del menu)
Route::view('nuestroADN', 'nuestroADN_V')->name('nuestroADN');
Route::view("/homepage", "homepage");

// ******************************************************  
Route::get('/', Inicio_C::class)->name('NoticiasPortada');
Route::get("roles/{correo}", RolController::class)->name('Roles');

// Efemeride_C ******************************************************
Route::get('efemeride', Efemeride_C::class)->name('Efemeride');

// LoginController ******************************************************   
Route::get("login/{id_noticia}/{bandera}/{id_comentario}", [LoginController::class, 'index'])->name('Login');
Route::post('login/inicioSesion', [LoginController::class, 'ValidarSesion'])->name('IniciarSesion'); 
Route::get('login/cerrarSesion', [LoginController::class, 'cerrar_Sesion'])->name('CerrarSesion');
Route::get('login/solicitarClave', [LoginController::class, 'solicitudNuevaCLave'])->name('SolicitudNuevaCLave');
Route::post('login/recuperarClave', [LoginController::class, 'recuperar_Clave'])->name('RecuperarClave'); 
Route::post('login/recibeClave', [LoginController::class, 'recibeCodigoRecuperacion'])->name('RecibeCodigoRecuperacion');
Route::post('login/recibeNuevaClave', [LoginController::class, 'recibeCambioClave'])->name('RecibeCambioClave');

// Registro_C ******************************************************
Route::get("regis", [Registro_C::class, 'suscripcion'])->name('registro');
Route::post("regis", [Registro_C::class, 'recibeRegistroSuscriptor'])->name('RecibeRegistro');

// Noticias_C ******************************************************
Route::controller(Noticias_C::class)->group(function(){
    Route::get('noticias', 'index')->name('Noticias');   
    Route::get('noticias/detalleNoticia/{id_noticia}', 'detalleNoticia')->name('DetalleNoticia');
    // via Ajax
    Route::get('noticia/verificaLogin/{ID_Noticia}/{bandera}/{ID_Comentario}','Verificar_Login')->name('NoticiaLogin');
    Route::get('noticia/{id_noticia}/{comentario}', 'recibeComentario');
    Route::get('noticia/detalleNoticia/miniatura/{id_imagen}','muestraImagenSeleccionada')->name('VerMiniatura');
});

// MarketplaceController ******************************************************
Route::get("marketplace", [MarketplaceController::class, 'index'])->name('Marketplace');
Route::get("marketplace/productoAmpliado/{ID_Producto}", [MarketplaceController::class, 'productoAmpliado'])->name('ProductoAmpliado');
Route::get("marketplace/catalogo/{ID_Suscriptor}", [MarketplaceController::class, 'catalogo'])->name('Catalogo'); 
Route::post('marketplace/pedido', [MarketplaceController::class, 'recibePedido'])->name('RecibePedido'); 
// via Ajax desde A_Catalogo.js
Route::get("marketplace/carrito/{id_comerciante}/{dolar}", [MarketplaceController::class, 'verCarrito'])->name('VerCarrito');
Route::get("marketplace/dolar", [MarketplaceController::class, 'dolarHoy']);
// via Ajax desde A_Catalogo.js con ruta absoluta escrita explicitamente porque se necesita un parametro para psar a la respuesta de la funcion
Route::get('/marketplace/mostrarUsuario/{Cedula}', [MarketplaceController::class, 'mostrarUsuario']);
Route::get('marketplace/miniatura/{id_imagen}', [MarketplaceController::class, 'muestraImagenSeleccionada'])->name('VerMiniaturaProducto');

// GaleriaArte_C ******************************************************
Route::get("galeriaArte", [GaleriaArte_C::class, 'index'])->name('GaleriaArte');
Route::get("galeriaArte/artista/{id_artista}", [GaleriaArte_C::class, 'artistas'])->name('Artista');
// desde E_Artista.js con ruta absoluta escrita explicitamente porque se necesita un parametro para psar a la respuesta de la funcion
Route::get("galeriaArte/obras/{ID_Obra}", [GaleriaArte_C::class, 'detalleObra']);
// via Ajax desde A_DetalleObra.js
Route::get("galeriaArte/obras/{ID_Obra}/{ID_Suscriptor}/{posicion}", [GaleriaArte_C::class, 'diapositivaObra'])->name('DiapositivaObra');

// EventosController ********************************************************** 
Route::get("eventos", [EventosController::class, 'index'])->name('Eventos');
Route::get("eventos/{id_agenda}", [EventosController::class, 'redes_sociales'])->name('EventoAgendado');

// Suscriptor_C *******************************************************
Route::get("suscriptor/{ID_Suscriptor}", [Suscriptor_C::class, 'accesoSuscriptor'])->name('DashboardSuscriptor');
Route::get("suscriptor/perfil/{ID_Suscriptor}", [Suscriptor_C::class, 'perfil_suscriptor'])->name('PerfilSuscriptor');
Route::post("suscriptor/actualizarPerfil", [Suscriptor_C::class, 'actualizarPerfilSuscriptor'])->name('ActualizaPerfilSuscriptor');



// RUTAS PRIVADAS
// PanelSuscriptor_C ******************************************************
Route::get('panelSuscriptor/{id_suscriptor}', [PanelSuscriptor_C::class, 'accesoSuscriptor'])->name('DashboardPanelSuscriptor');

// Panel_Denuncias_C **************************************************
Route::get("denuncias/{ID_Suscriptor}", [Panel_Denuncias_C::class, 'index'])->name('SuscriptorDenuncias'); 

// PanelMarketplaceController *****************************************
Route::get("marketplace/{id_comerciante}", [PanelMarketplaceController::class, 'index'])->name('PanelProducto');
Route::get("marketplace/actualizar/{id_producto}/{opcion}", [PanelMarketplaceController::class, 'actualizarProducto'])->name('ActualizarProducto');
Route::get("marketplace/agregarProducto/{id_comerciante}", [PanelMarketplaceController::class, 'agregar'])->name('AgregarProducto');
Route::post("marketplace/productoAgregar", [PanelMarketplaceController::class, 'recibeProductoAgregar'])->name('RecibeProductoAgregado');
Route::post("marketplace/datosActualizar", [PanelMarketplaceController::class, 'recibeAtualizarProducto'])->name('RecibeAtualizarProducto');
Route::get('marketplace/eliminaProducto/{id_producto}/{id_opcion}', [PanelMarketplaceController::class, 'eliminarProducto'])->name('EliminarProducto'); 
Route::get('marketplace/eliminarImgProducto/{id_imagenSec}', [PanelMarketplaceController::class, 'eliminar_imagenSecundariaProducto'])->name('EliminarImgSecundariaPRoducto');  

// PanelArtistaController ****************************************************    
Route::get("artista/{id_artista}", [PanelArtistaController::class, 'index'])->name('PanelArtista');
Route::get("artista/actualizar/{id_obra}", [PanelArtistaController::class, 'actualizarObra'])->name('ActualizarObra');
Route::get("artista/agregarObra/{id_artista}", [PanelArtistaController::class, 'CargarObras'])->name('AgregarObra'); 
Route::get("artista/perfil/{id_artista}", [PanelArtistaController::class, 'perfil_artista'])->name('PerfilArtista');

// PanelPeriodistaController ******************************************************
Route::get('panelPeriodista', [PanelPeriodistaController::class, 'index'])->name('Index');     
Route::get('panelPeriodista/noticiasGenerales', [PanelPeriodistaController::class, 'not_Generales'])->name('NoticiasGenerales');
Route::get('panelPeriodista/agenda', [PanelPeriodistaController::class, 'agenda'])->name('Agenda');  
Route::get('panelPeriodista/efemeride', [PanelPeriodistaController::class, 'efemerides'])->name('Efemerides');  
Route::get('panelPeriodista/publicidad', [PanelPeriodistaController::class, 'publicidad'])->name('Publicidad');
Route::get('panelPeriodista/agregar', [PanelPeriodistaController::class, 'agregar_noticia'])->name('AgregarNoticia');
Route::get('panelPeriodista/agregarAgenda', [PanelPeriodistaController::class, 'agregar_agenda'])->name('AgregarAgenda');
Route::get('panelPeriodista/agregarEfemeride', [PanelPeriodistaController::class, 'agregar_efemeride'])->name('AgregarEfemeride');
Route::get('panelPeriodista/actualizar/{id_noticia}/{bandera}', [PanelPeriodistaController::class, 'actualizar_noticia'])->name('ActualizarNoticia');
Route::post('panelPeriodista/recibeActualizar/', [PanelPeriodistaController::class, 'recibeNoti_actualizada'])->name('RecibeActualizarNoticia');
Route::post("panelPeriodista/recibeAgregar", [PanelPeriodistaController::class, 'recibeAgregarNoticia'])->name('RecibeAgregarNoticia'); 
Route::post("panelPeriodista/recibeEfemeride", [PanelPeriodistaController::class, 'recibeEfemerideAgregada'])->name('RecibeEfemerideAgregada');
Route::post("panelPeriodista/recibeAgenda", [PanelPeriodistaController::class, 'recibeAgendaAgregada'])->name('RecibeAgendaAgregada');
// via Ajax
Route::get('panelPeriodista/secciones', [PanelPeriodistaController::class, 'secciones'])->name('SeccionesNoticia'); 
Route::get('panelPeriodista/eliminaNoticia/{id_noticia}', [PanelPeriodistaController::class, 'eliminar_noticia'])->name('EliminarNoticia');  
Route::get('panelPeriodista/eliminaEfemeride/{id_efemeride}', [PanelPeriodistaController::class, 'eliminar_efemeride'])->name('EliminarEfemeride');   
Route::get('panelPeriodista/eliminaAgenda/{id_agenda}', [PanelPeriodistaController::class, 'eliminar_agenda'])->name('EliminarAgenda'); 
Route::get('panelPeriodista/actualizarNoticia/{id_imagenSec}', [PanelPeriodistaController::class, 'eliminar_imagenSecundariaNoticia'])->name('EliminarImgSecundaria');  

// TRAITS ************************************************************* 
Route::get('trait', [PagesController::class, 'index'])->name('Trait');