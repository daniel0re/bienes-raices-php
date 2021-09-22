<?php
    // Importar la conexion
    require __DIR__ . '/../config/database.php';

    $db = conectarDB();
    
    // Escribir el Query
    $query = "SELECT * FROM propiedades LIMIT ${limite}";

    // Consultar la base de datos (DB)
    $resultadoConsultas = mysqli_query($db , $query);
    
?>
<div class="contenedor-anuncios">
            
    <?php while(  $propiedad  =  mysqli_fetch_assoc($resultadoConsultas)) : ?>

    <div class="anuncio">
        
        <img 
            loading="lazy" 
            src="imagenes/<?php echo $propiedad['imagen']; ?>" 
            alt="Imagen Anuncio"
        >
 
        <div class="contenido-anuncio">
            <h3> <?php echo $propiedad['titulo'];?> </h3>
            <p><?php echo $propiedad['descripcion'];?></p>
            <p class="precio">S/. <?php echo $propiedad['precio'];?></p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono-anuncio" loading="lazy" src="build/img/icono_wc.svg" alt="Icono WC">
                    <p><?php echo $propiedad['wc'];?></p>
                    
                </li>
                <li>
                    <img class="icono-anuncio" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento">
                    <p><?php echo $propiedad['establecimiento'];?></p>

                </li>
                <li>
                    <img class="icono-anuncio" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono Dormitorio">
                    <p><?php echo $propiedad['habitaciones'];?></p>

                </li>
            </ul>

            <a 
                class="boton-amarillo-block"
                href="anuncio.php?id=<?php echo $propiedad['id'];?>">
                Ver Propiedad
            </a>
        </div> <!-- contenido-Anuncio -->
    </div>  <!-- anuncio -->

    <?php endwhile; ?>

</div> <!-- contenedor-anuncios -->

<?php 
    // Cerrar la conexion
    mysqli_close($db);
?>