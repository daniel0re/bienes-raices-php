<?php 

    require 'includes/funciones.php';
    
    $inicio = true;
    incluirTemplate('header', $inicio);

?>


    <main class = "contenedor">
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad"  loading="lazy">
                <h3>Seguridad</h3>
                <p>Suspendisse blandit, ipsum at sagittis egestas, tellus leo laoreet risus, auctor tempor purus libero eu nisl.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono precio"  loading="lazy">
                <h3>Precio</h3>
                <p>Suspendisse blandit, ipsum at sagittis egestas, tellus leo laoreet risus, auctor tempor purus libero eu nisl.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono tiempo"  loading="lazy">
                <h3>A Tiempo</h3>
                <p>Suspendisse blandit, ipsum at sagittis egestas, tellus leo laoreet risus, auctor tempor purus libero eu nisl.</p>
            </div>
        </div>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y Depas en Venta</h2>

            <?php 
                $limite = 3;
                include 'includes/templates/anuncions_main.php'
            ?>

        <div class="alinear-derecha">
            <a class="boton-verde" href="anuncios.php">Ver todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo en brevedad.</p>
        <a class="boton-amarillo" href="contacto.php">Contactanos</a>
    </section>


    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h2>Nuestro Blog</h2>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset= "build/img/blog1.webp" type="image/webp">
                        <source srcset= "build/img/blog1.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
                        <p>
                            Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero.
                        </p>
                    </a>
                </div>

            </article>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset= "build/img/blog2.webp" type="image/webp">
                        <source srcset= "build/img/blog2.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Guía para la decoración de tu hogar</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
                        <p>
                            Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio.
                        </p>
                    </a>
                </div>
            </article>
        </section>
        <section class="testimoniales">
            <h3>Testimoniales</h3>

            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.
                </blockquote>

                <p>- Daniel Ore</p>
            </div>
        </section>
    </div>

<?php   
    incluirTemplate('footer');
?>
