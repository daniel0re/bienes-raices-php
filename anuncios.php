<?php 
    require 'includes/funciones.php';
    
    incluirTemplate('header');
?>

    <main class = "contenedor">
        <section class="seccion contenedor">
            <h2>Casas y Depas en Venta</h2>
    
            <?php 
                $limite = 10;
                include 'includes/templates/anuncions_main.php'
            ?>
    
    
    </main>

<?php   
    incluirTemplate('footer');
?>
