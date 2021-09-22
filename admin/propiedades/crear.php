<?php
//base de datos
require '../../includes/funciones.php';
$auth = estaAutenticado();

if(!$auth){
    header('Location: /');
}


require '../../includes/config/database.php';

$db = conectarDB();

// Consultar para obtener a los vendedores.
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db,$consulta);

// Mensajes de errores.
$errores = [];


$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';


// Ejecutar el codigo despues de que el usuario envia el formulario.
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";
    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";

    $titulo = mysqli_real_escape_string( $db ,$_POST['titulo']);
    $precio = mysqli_real_escape_string( $db ,$_POST['precio']);
    $descripcion = mysqli_real_escape_string( $db ,$_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string( $db ,$_POST['habitaciones']);
    $wc = mysqli_real_escape_string( $db ,$_POST['wc']);
    $estacionamiento = mysqli_real_escape_string( $db ,$_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string( $db ,$_POST['vendedor']);
    $creado = date('Y/m/d');

    // Asirgnar files hacia una variable
    $imagen = $_FILES['imagen'];

    // var_dump($imagen['name']);

    

    // Verifica si hay errores
    if (!$titulo) {
        $errores[] = "Debes añadir un titulo";
    }
    if (!$precio) {
        $errores[] = "Debes añadir un precio, campo obligatorio";
    }
    if (strlen($descripcion < 50)) {
        $errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
    }
    if (!$habitaciones) {
        $errores[] = "Debes añadir un número de habitaciones, campo obligatorio";
    }
    if (!$wc) {
        $errores[] = "Debes añadir un número de baños, campo obligatorio";
    }
    if (!$estacionamiento) {
        $errores[] = "Debes añadir un número de estacionamientos, campo obligatorio";
    }
    if (!$vendedorId) {
        $errores[] = "Seleccione un vendedor, campo obligatorio";
    }
    if (!$imagen['name']){
        $errores[] = "La imagen es obligatoria";
    }

    // Validar por tamaño (bites) de una imgaen 
    $medida = 1000 * 100;
    if ($imagen['size'] > $medida || $imagen['error']){
        $errores[] = "La imagen es muy pesada o grande";
    }
    // echo "<pre>";
    // var_dump($errores);
    // echo "</pre>";


    // Revisa si hay errores en el arreglo

    if (empty($errores)) {
        // Subida de Archivos

        // Crear carpeta
        $carpetaImagenes = '../../imagenes/';

        if(!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        // Preparar nombre del archivo para que no se sobreescriba
        $nombreImagen = md5( uniqid( rand(), true ) ). "_id" .$vendedorId . ".jpg";

        // Subir imagen
        move_uploaded_file($imagen['tmp_name'],$carpetaImagenes ."/" .$nombreImagen);

        // Insertar en la base de datos.
        $query = "INSERT INTO propiedades (titulo, precio, imagen ,descripcion, habitaciones, wc, establecimiento,creado,vendedorId) VALUES ('$titulo','$precio', '$nombreImagen' ,'$descripcion', '$habitaciones', '$wc','$estacionamiento','$creado','$vendedorId')";

        // echo $query;

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            // echo "Insertado correctamente";
            header('Location: /admin?r=1');
        }
    }
}


incluirTemplate('header');
?>

<main class="contenedor">
    <h1>Crear</h1>

    <a class="boton boton-verde" href="/admin">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach ?>

    <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">

        <fieldset>
            <legend>Informacion General</legend>


            <label for="titulo">Título:</label>
            <input id="titulo" name="titulo" type="text" placeholder="Título de la propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input id="precio" name="precio" type="number" placeholder="Precio de la propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input id="imagen" type="file" accept="image/jpeg, image/png" name="imagen">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" placeholder="Descripción de la propiedad"><?php echo $descripcion; ?></textarea>

        </fieldset>

        <fieldset>
            <legend>Información Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input id="habitaciones" name="habitaciones" type="number" min="1" placeholder="Número de habitaciones" max="9" value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños:</label>
            <input id="wc" name="wc" type="number" placeholder="Número de baños" min="1" max="9" value="<?php echo $wc; ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input id="estacionamiento" name="estacionamiento" type="number" placeholder="Número de baños" min="1" max="9" value="<?php echo $estacionamiento; ?>">


        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedor">
                <option value="">-- Selecione --</option>
                <?php while($row = mysqli_fetch_assoc($resultado)) :  ?>
                    <option  <?php echo $vendedorId === $row['id'] ? 'selected' : ''  ?>   value="<?php echo $row['id']; ?>"><?php echo $row['nombre']. ' ' .$row['apellido']; ?></option>
                <?php endwhile; ?>
            </select>
        </fieldset>

        <input class="boton boton-verde" type="submit" value="Crear Propiedad">

    </form>
</main>

<?php
incluirTemplate('footer');
?>