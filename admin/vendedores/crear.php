<?php

require '../../includes/app.php';

use App\Vendedor;

estaAutenticado();

// Instanciamos la clase Vendedor vacía (Necesario para el formulario si falla)
$vendedor = new Vendedor;

// Obtenemos errores
$errores = Vendedor::getErrores();

// Ejecutar el código después de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $args = $_POST['vendedor'];

    $vendedor->sincronizar($args);

    $errores = $vendedor->validar();

    if (empty($errores)) {
        $vendedor->guardar();
    }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Registrar Vendedor(a)</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/vendedores/crear.php">
        <?php include '../../includes/templates/formulario_vendedores.php' ?>

        <input type="submit" value="Registrar Vendedor(a)" class="boton boton-verde">
    </form>

</main>

<?php
incluirTemplate('footer');
?>