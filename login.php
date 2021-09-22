<?php 
    require 'includes/config/database.php';
    $db = conectarDB();

    // Autenticar el usuario

    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        $email =  mysqli_real_escape_string($db,filter_var($_POST['email'],FILTER_VALIDATE_EMAIL));

        $password = mysqli_real_escape_string($db,$_POST['password']);

        if(!$email){
            $errores[] = "El correo es obligatorio o no es valido";
        }
        if(!$password){
            $errores[] = "El password es obligatorio";
        }

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        if(empty($errores)){
            // Revisar si el usuario existe.
            $query = "SELECT * FROM usuarios WHERE email = '${email}'";
            $resultado = mysqli_query($db,$query);


            // echo "<pre>";
            // var_dump($resultado);
            // echo "</pre>";


            if($resultado->num_rows){
                // Revisar si el password es correcto:
                $usuario = mysqli_fetch_assoc($resultado);

                // Verificar si el password es correcto o no
                $auth = password_verify($password,$usuario['password']);
                if ($auth){
                    // El usuario está autenticado
                    session_start();

                    // LLenar el arreglo de la sesión
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;


                    header('Location: admin/');
                    
                } else {
                    $errores[] = "Contraseña incorrecta";
                }
            } else {
                $errores[] = "El usuario no existe";
            }
        }
    }


    // Incluye el HEADER
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class = "contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>
        <?php foreach($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>

        <?php endforeach; ?>

        <form class="formulario" method="POST" novalidate>
            <fieldset>
                <legend>Email y Password</legend>
            
                <label for="email">Email:</label>
                <input id="email" name="email"type="email" placeholder="Tu Email" required>

                <label for="password">Contraseña: </label>
                <input id="password" name="password" type="password" placeholder="Tu contraseña" required>
            </fieldset>

            <input class="boton boton-verde" type="submit" value="Iniciar Sesión">
        </form>

    </main>

<?php   
    incluirTemplate('footer');
?>
