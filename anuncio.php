<?php 

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /');
    }

    
    require 'includes/config/database.php';

    $db = conectarDB();


    
    // Escribir el Query
    $query = "SELECT * FROM propiedades WHERE id = $id";

    // Consultar la base de datos (DB)
    $resultadoConsultas = mysqli_query($db , $query);
    
    // echo "<pre>";
    // var_dump( $resultadoConsultas->num_rows);
    // echo "</pre>";

    if($resultadoConsultas->num_rows === 0){
        header('Location: /');
    }

    $propiedad = mysqli_fetch_assoc($resultadoConsultas);

    require 'includes/funciones.php';
    
    incluirTemplate('header');
?>

    <main class = "contenedor contenido-centrado">
        <h1>Casa en Venta frente al bosque</h1>
        
        <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="Imagen de la propiedad">

        <div class="resumen-propiedad">
            <p class="precio">$ <?php echo $propiedad['precio']; ?></p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono-anuncio" loading="lazy" src="build/img/icono_wc.svg" alt="Icono WC">
                    <p><?php echo $propiedad['wc']; ?></p>
                    
                </li>
                <li>
                    <img class="icono-anuncio" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento">
                    <p><?php echo $propiedad['establecimiento']; ?></p>

                </li>
                <li>
                    <img class="icono-anuncio" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono Dormitorio">
                    <p><?php echo $propiedad['habitaciones']; ?></p>

                </li>
            </ul>
        
            <p><?php echo $propiedad['descripcion']; ?></p>

        </div>
    </main>

<?php   
    mysqli_close($db);
    incluirTemplate('footer');
?>
