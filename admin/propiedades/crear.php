<?php

require '../../includes/app.php';

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

estaAutenticado();

// Modificado
$propiedad = new Propiedad;

// Consulta para obtener todos los vendedores
$vendedores = Vendedor::all();

// Arreglo con mensajes de errores
$errores = Propiedad::getErrores();

// Ejecutar el código después de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // admin/propiedades/crear.php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Instanciamos el objeto VACÍO (usando los nulls por defecto del constructor)
        $propiedad = new Propiedad;

        // Limpieza de Tipos 
        $args = $_POST['propiedad'];
        $args['precio'] = filter_var($args['precio'], FILTER_VALIDATE_FLOAT) ?: null;
        $args['habitaciones'] = filter_var($args['habitaciones'], FILTER_VALIDATE_INT) ?: null;
        $args['wc'] = filter_var($args['wc'], FILTER_VALIDATE_INT) ?: null;
        $args['estacionamiento'] = filter_var($args['estacionamiento'], FILTER_VALIDATE_INT) ?: null;
        $args['vendedorId'] = filter_var($args['vendedorId'], FILTER_VALIDATE_INT) ?: null;

        // USAMOS ACTIVE RECORD PARA LLENAR LOS DATOS
        $propiedad->sincronizar($args);
    }

    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    if ($_FILES['propiedad']['tmp_name']['imagen']) {
        $manager = new Image(Driver::class);
        $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
        $propiedad->setImagen($nombreImagen);
    }

    $errores = $propiedad->validar();

    if (empty($errores)) {

        // Crear carpeta si no existe
        if (!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES, 0777, true);
        }

        // Guardar en BD
        $imagen->save(CARPETA_IMAGENES . $nombreImagen);

        $propiedad->guardar();
    }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Crear</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php' ?>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>

</main>

<?php
incluirTemplate('footer');
?>