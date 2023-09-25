<?php
namespace App\Traits;

trait Comprimir_Imagen{
        
        public function imagen_comprimir($Bandera, $Servidor, $Nombre_Imagen, $Tipo_Imagen, $Tamanio_Imagen, $Temporal_Imagen, $ID_Suscriptor = null, $NombreArtista = null, $ApellidoArtista = null){
            // echo 'Bandera: ' . $Bandera . '<br>';
            // echo 'Servidor: ' . $Servidor. '<br>';
            // echo 'Nombre_Imagen: ' .  $Nombre_Imagen . '<br>';
            // echo 'Tipo_Imagen: ' .  $Tipo_Imagen . '<br>';
            // echo 'Tamanio_Imagen: ' .  $Tamanio_Imagen . '<br>';
            // echo 'Temporal_Imagen: ' .  $Temporal_Imagen . '<br>';
            // echo 'ID_Suscriptor: ' .  $ID_Suscriptor . '<br>';
            // echo 'NombreArtista: ' .  $NombreArtista . '<br>';
            // echo 'ApellidoArtista: ' .  $ApellidoArtista . '<br>';
            // echo '<br>';
            // exit;
            
            if($Bandera == 'ImagenPublicidad'){
                
                if($Servidor == 'Remoto'){
                    // Usar en remoto
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . '/images/publicidad/';
                }
                else{
                    // usar en local
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . 'images/publicidad/';
                }
            } 
            else if($Bandera == 'ImagenPerfilArtista'){
                
                if($Servidor == 'Remoto'){
                    // Usar en remoto
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . '/images/galeria/'. $ID_Suscriptor . '_' . $NombreArtista . '_' . $ApellidoArtista. '/perfil/';
                }
                else{
                    // usar en local
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . 'images/galeria/' . $ID_Suscriptor . '_' . $NombreArtista . '_' . $ApellidoArtista . '/perfil/';
                }
            }
            else if($Bandera == 'imagenProducto'){ 
                
                if($Servidor == 'Remoto'){
                    //Usar en remoto         
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . '/images/clasificados/'. $_SESSION['ID_Suscriptor'] . '/productos/';
                }
                else{
                    //usar en local        
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . 'images/clasificados/'. $_SESSION['ID_Suscriptor'] . '/productos/';             
                }
            }
            else if($Bandera == 'imagenSecundariiaProducto'){
                
                if($Servidor == 'Remoto'){
                    //Usar en remoto         
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . '/images/clasificados/'. $_SESSION['ID_Suscriptor'] . '/productos/';
                }
                else{
                    // usar en local        
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . 'images/clasificados/'. $_SESSION['ID_Suscriptor'] . '/productos/';             
                }
            }
            else if($Bandera == 'imagenAgenda'){
                
                if($Servidor == 'Remoto'){
                    // Usar en remoto        
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . '/images/agenda/';
                }
                else{
                    //usar en local         
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . 'images/agenda/';             
                }
            } 
            else if($Bandera == 'imagenCatalogo'){
                
                if($Servidor == 'Remoto'){
                    //Usar en remoto        
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . '/images/clasificados/' . $_SESSION['ID_Suscriptor'] . '/';
                }
                else{
                    //usar en local         
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . 'images/clasificados/' . $_SESSION['ID_Suscriptor'] . '/';             
                }
            }
            else if($Bandera == 'imagenSecundariiaProdActualizar'){  
                
                if($Servidor == 'Remoto'){              
                    //Usar en remoto        
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . '/images/clasificados/'. $_SESSION['ID_Suscriptor'] . '/productos/';
                }
                else{
                    //usar en local         
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . 'images/clasificados/'. $_SESSION['ID_Suscriptor'] . '/productos/'; 
                }
            }  
            else if($Bandera == 'imagenPortafolio'){
                
                if($Servidor == 'Remoto'){
                    //Usar en remoto        
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . '/images/galeria/' . $ID_Suscriptor . '_' . $NombreArtista . '_' . $ApellidoArtista . '/perfil/';
                }
                else{
                    //usar en local         
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . 'images/galeria/' . $ID_Suscriptor . '_' . $NombreArtista . '_' . $ApellidoArtista . '/perfil/';
                }
            } 
            else if($Bandera == 'imagenObra'){
                
                if($Servidor == 'Remoto'){
                    //Usar en remoto        
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . '/images/galeria/' . $ID_Suscriptor . '_' . $NombreArtista . '_' . $ApellidoArtista . '/';
                }
                else{
                    //usar en local         
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . 'images/galeria/' . $ID_Suscriptor . '_' . $NombreArtista . '_' . $ApellidoArtista . '/';
                }
            } 
            else if($Bandera == 'ImagenDenuncia'){
                
                if($Servidor == 'Remoto'){
                    //Usar en remoto        
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . '/images/denuncias/';
                }
                else{
                    //usar en local         
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . 'images/denuncias/';
                }
            } 
            else if($Bandera == 'ImagenEfemeride'){
                
                if($Servidor == 'Remoto'){
                    //Usar en remoto        
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . '/images/efemerides/';
                }
                else{
                    //usar en local         
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . 'images/efemerides/';
                }
            }
            else if($Bandera == 'ImagenNoticia'){
                
                if($Servidor == 'Remoto'){
                    // Usar en remoto        
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . '/images/noticias/';
                }
                else{
                    // usar en local        
                    $Patch = $_SERVER['DOCUMENT_ROOT'] . 'images/noticias/';
                }
            }

            if(isset($Nombre_Imagen)){
                // echo $Patch . $Nombre_Imagen . '<br>';  

                //Parámetros optimización, resolución máxima permitida
                $max_ancho = 1280;
                $max_alto = 900;  
                
                if($Tipo_Imagen == 'image/png' || $Tipo_Imagen == 'image/jpeg' || $Tipo_Imagen == 'image/jpg' || $Tipo_Imagen == 'image/gif' || $Tipo_Imagen == 'image/webp'){
                
                    $medidasimagen= getimagesize($Temporal_Imagen);
            
                    //Si las imagenes tienen una resolución y un peso aceptable se suben tal cual
                    if($medidasimagen[0] < 1280 && $Tamanio_Imagen < 300000){
                     
                        move_uploaded_file($Temporal_Imagen, $Patch . $Nombre_Imagen);	
                    }
                    else{
                        
                        //Redimensionar
                        $rtOriginal = $Temporal_Imagen;
            
                        if($Tipo_Imagen == 'image/jpeg'){
                            $original = imagecreatefromjpeg($rtOriginal);
                        }
                        else if($Tipo_Imagen =='image/png'){
                            $original = imagecreatefrompng($rtOriginal);
                        }	
                        else if($Tipo_Imagen =='image/gif'){
                            $original = imagecreatefromgif($rtOriginal);
                        }
                        else if($Tipo_Imagen =='image/webp'){
                            $original = imagecreatefromwebp($rtOriginal);
                        }	
            
                        list($ancho,$alto) = getimagesize($rtOriginal);
            
                        $x_ratio = $max_ancho / $ancho;
                        $y_ratio = $max_alto / $alto;
            
            
                        if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
                            $ancho_final = $ancho;
                            $alto_final = $alto;
                        }
                        elseif (($x_ratio * $alto) < $max_alto){
                            $alto_final = ceil($x_ratio * $alto);
                            $ancho_final = $max_ancho;
                        }
                        else{
                            $ancho_final = ceil($y_ratio * $ancho);
                            $alto_final = $max_alto;
                        }
            
                        $lienzo = imagecreatetruecolor($ancho_final, $alto_final); 
            
                        imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
                            
                        $cal = 8;
                        
                        if($Tipo_Imagen == 'image/jpeg'){
                            imagejpeg($lienzo, $Patch . $Nombre_Imagen);
                        }
                        else if($Tipo_Imagen=='image/jpg'){
                            imagegif($lienzo, $Patch . $Nombre_Imagen);
                        }
                        else if($Tipo_Imagen == 'image/png'){
                            imagepng($lienzo, $Patch . $Nombre_Imagen);
                        }
                        else if($Tipo_Imagen=='image/gif'){
                            imagegif($lienzo, $Patch . $Nombre_Imagen);
                        }
                        else if($Tipo_Imagen=='image/webp'){
                            imagewebp($lienzo, $Patch . $Nombre_Imagen);
                        }
                        // echo 'fichero comprimido exitosamente';
                        // exit;
                    }
                }
                else{
                    echo 'fichero no soportado';
                    exit;
                } 
            }
        }
    }
