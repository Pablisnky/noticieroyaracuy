<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Efemeride_C;
use App\Http\Controllers\Eventos_C;
use App\Http\Controllers\Clasificados_C;
use App\Http\Controllers\GaleriaArte_C;
use App\Http\Controllers\Inicio_C;
use App\Http\Controllers\Login_C;
use App\Http\Controllers\Noticias_C;
use App\Http\Controllers\PanelPeriodista_C;
use App\Http\Controllers\PanelSuscriptor_C;
use App\Http\Controllers\Registro_C;
use App\Http\Controllers\PagesController; 

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

// Efemeride_C ******************************************************
Route::get('efemeride', Efemeride_C::class)->name('Efemeride');

// Login_C ******************************************************
// Muestra formulario de login 
Route::get("login/{id_noticia}/{bandera}/{id_comentario}", [Login_C::class, 'index'])->name('Login');
Route::post('login/inicioSesion', [Login_C::class, 'ValidarSesion'])->name('IniciarSesion'); 
Route::get('login/cerrarSesion', [Login_C::class, 'cerrar_Sesion'])->name('CerrarSesion');

// PanelPeriodista_C ******************************************************
Route::get('panelPeriodista', [PanelPeriodista_C::class, 'index'])->name('Index');     
Route::get('panelPeriodista/noticiasGenerales', [PanelPeriodista_C::class, 'not_Generales'])->name('NoticiasGenerales');
Route::get('panelPeriodista/agenda', [PanelPeriodista_C::class, 'agenda'])->name('Agenda');  
Route::get('panelPeriodista/efemeride', [PanelPeriodista_C::class, 'efemerides'])->name('Efemerides');  
Route::get('panelPeriodista/publicidad', [PanelPeriodista_C::class, 'publicidad'])->name('Publicidad');
Route::get('panelPeriodista/agregar', [PanelPeriodista_C::class, 'agregar_noticia'])->name('AgregarNoticia');
Route::get('panelPeriodista/agregarEfemeride', [PanelPeriodista_C::class, 'agregar_efemeride'])->name('AgregarEfemeride');
Route::get('panelPeriodista/actualizar/{id_noticia}/{bandera}', [PanelPeriodista_C::class, 'actualizar_noticia'])->name('ActualizarNoticia');
Route::post('panelPeriodista/recibeActualizar/', [PanelPeriodista_C::class, 'recibeNoti_actualizada'])->name('SendActualizarNoticia');
Route::post("panelPeriodista/recibeAgregar", [PanelPeriodista_C::class, 'recibeAgregarNoticia'])->name('RecibeAgregarNoticia'); 
Route::post("panelPeriodista/recibeEfemeride", [PanelPeriodista_C::class, 'recibeEfemerideAgregada'])->name('RecibeEfemerideAgregada');
// llamada desde js via Ajax
Route::get('panelPeriodista/secciones', [PanelPeriodista_C::class, 'secciones'])->name('SeccionesNoticia');
Route::get('panelPeriodista/eliminaNoticia/{id_noticia}', [PanelPeriodista_C::class, 'eliminar_noticia'])->name('EliminarNoticia');  

// PanelSuscriptor_C ******************************************************
Route::get('panelSuscriptor', [PanelSuscriptor_C::class, 'accesoSuscriptor'])->name('DashboardPanelSuscriptor');

// Registro_C ******************************************************
Route::get("regis", [Registro_C::class, 'suscripcion'])->name('registro');
Route::post("regis", [Registro_C::class, 'recibeRegistroSuscriptor'])->name('RecibeRegistro');

// Noticias_C ******************************************************
// Route::get('noticia', [Noticias_C::class, 'index']);
Route::controller(Noticias_C::class)->group(function(){

    Route::get('noticias', 'index')->name('Noticias');
    
    // Route::get('noticia/noticias_V', '');

    // Muestra una noticia especifica
    Route::get('noticias/detalleNoticia/{id_noticia}', 'detalleNoticia')->name('DetalleNoticia');

    // Route::get('noticia/{detalle}', 'detalleNoticia');

    // llamada desde js via Ajax
    Route::get('noticia/verificaLogin/{ID_Noticia}/{bandera}/{ID_Comentario}','Verificar_Login')->name('NoticiaLogin');

    Route::get('noticia/{id_noticia}/{comentario}', 'recibeComentario');

    // Route::get('noticia/verificaLogin/{id_noticia}/{bandera}/{id_comentario}','Verificar_Login')->name('noticiaLogin');
});

// Clasificados_C ******************************************************
Route::get("marketplace", [Clasificados_C::class, 'index'])->name('Marketplace');
Route::get("marketplace/productoAmpliado/{ID_Producto}", [Clasificados_C::class, 'productoAmpliado'])->name('ProductoAmpliado');
Route::get("marketplace/catalogo/{ID_Suscriptor}/{pseudonimoSuscripto}", [Clasificados_C::class, 'catalogo'])->name('Catalogo'); 
Route::post('marketplace/pedido', [Clasificados_C::class, 'recibePedido'])->name('RecibePedido'); 
// llamada desde js via Ajax desde A_Catalogo.js
Route::get("marketplace/carrito/{ID_Suscriptor}/{dolar}", [Clasificados_C::class, 'verCarrito'])->name('VerCarrito');
// llamada desde js via Ajax desde A_Catalogo.js con ruta absoluta escrita explicitamente porque se necesita un parametro para psar a la respuesta de la funcion
Route::get('/marketplace/mostrarUsuario/{Cedula}', [Clasificados_C::class, 'mostrarUsuario']);

// GaleriaArte_C ******************************************************
Route::get("galeriaArte", [GaleriaArte_C::class, 'index'])->name('GaleriaArte');
Route::get("galeriaArte/artista/{ID_Suscriptor}", [GaleriaArte_C::class, 'artistas'])->name('Artista');
// llamada desde js desde E_Artista.js con ruta absoluta escrita explicitamente porque se necesita un parametro para psar a la respuesta de la funcion
Route::get("galeriaArte/obras/{ID_Obra}", [GaleriaArte_C::class, 'detalleObra']);
// llamada desde js via Ajax desde A_DetalleObra.js
Route::get("galeriaArte/obras/{ID_Obra}/{ID_Suscriptor}/{posicion}", [GaleriaArte_C::class, 'diapositivaObra'])->name('DiapositivaObra');

// Eventos_C ****************************************************** 
Route::get("eventos", [Eventos_C::class, 'index'])->name('Eventos');

// TRAITS ****************************************************** 
Route::get('trait', [PagesController::class, 'index'])->name('Trait');