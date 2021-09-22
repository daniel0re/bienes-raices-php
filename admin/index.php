<?php 
    require '../includes/funciones.php';
    $auth = estaAutenticado();
    
    // echo "<pre>";
    // var_dump($auth);
    // echo "</pre>";

    if(!$auth){
        header('Location: /');
    }

    // Importar la conexion
    require '../includes/config/database.php';

    $db = conectarDB();
    
    // Escribir el Query
    $query = "SELECT * FROM propiedades";

    // Consultar la base de datos (DB)
    $resultadoConsultas = mysqli_query($db , $query);


    // $propiedad  =  mysqli_fetch_assoc($resultadoConsultas); 

    // echo "<pre>";
    // echo $propiedad['precio'];
    // echo "</pre>";

    // Muestra mensajes condicionales
    $respuesta = $_GET['r'] ?? null;


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id,FILTER_VALIDATE_INT);

        if($id){
            // Consultar a la base de datos para eliminar la imagen

            $consulta = "SELECT * FROM propiedades WHERE id = ${id}";
            $resultado = mysqli_query($db,$consulta);
            
            // Uso de los datos de la consutal
            $propiedad = mysqli_fetch_assoc($resultado);

            // Eliminar el archivo de imagenes

            $carpetaImagenes = '../imagenes/';

            $nombreImagen = $propiedad['imagen'];
    
            unlink($carpetaImagenes . $propiedad['imagen']);
            

            // Eliminar la propiedad en la bases de datos
            $query = "DELETE FROM propiedades WHERE id = ${id}";

            $respuesta = mysqli_query($db,$query);

            if($respuesta){
                header('location: /admin?r=3');
            }
        }
    }
    
    incluirTemplate('header');
?>

    <main class = "contenedor">
        <h1>Administrador de Bienes Raices</h1>

        <?php if($respuesta == 1) : ?>
            <p class="alerta exito">Anuncio creado correctamente</p>
        <?php elseif($respuesta == 2) : ?>
            <p class="alerta exito">Anuncio actualizado correctamente</p>
        <?php elseif($respuesta == 3) : ?>
            <p class="alerta exito">Anuncio eliminado correctamente</p>
        <?php endif; ?>

        <a class="boton boton-verde" href="/admin/propiedades/crear.php" >Nueva Propiedad</a>


        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

                <?php while( $propiedad  =  mysqli_fetch_assoc($resultadoConsultas) ) : ?>

               

                <tr class="borde-abajo"> <!-- Mostrar los resultados de la base de datos -->
                    <td><?php echo $propiedad['id']; ?></td>
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <td><img class="imagen-tabla" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="imagen tabla"></td>
                    <td>S/. <?php echo $propiedad['precio']; ?></td>
                    <td>
                        <form class="w-100" method="POST">

                            <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                            <input class="boton-rojo-block" type="submit" value="Eliminar">
                        </form>
                        <a 
                            class="boton-amarillo-block" 
                            href="propiedades/actualizar.php?id=<?php echo $propiedad['id'];?>"
                            > Actualizar
                        </a>
                    </td>
                </tr>

                <?php endwhile;  ?>


            </tbody>
        </table>

    </main>

<?php   

    // Cerrar la conexión
    mysqli_close($db);

    incluirTemplate('footer');
?>
