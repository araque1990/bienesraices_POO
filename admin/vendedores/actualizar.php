<?php

require '../../includes/app.php';

use App\Vendedor;

estaAutenticado();

// Validar la URL por ID válido
$id = $_GET['id'] ?? null;
$id = filter_var($id, FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: /admin');
    exit;
}

// Obtener los datos de la propiedad
$vendedor = Vendedor::find($id);
//debuguear($vendedor);
$errores = Vendedor::getErrores();

// Ejecutar el código después de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Limpieza de Tipos 
    $args = $_POST['vendedor'];

    // USAMOS ACTIVE RECORD PARA LLENAR LOS DATOS
    $vendedor->sincronizar($args);
    $errores = $vendedor->validar();

    if (empty($errores)) {
        $vendedor->guardar();
    }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Actualizar Vendedor(a)</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST">
        <input type="hidden" name="vendedor[id]" value="<?php echo s($vendedor->id); ?>"> 
        <?php include '../../includes/templates/formulario_vendedores.php' ?>

        <input type="submit" value="Guardar Cambios" class="boton boton-verde">
    </form>

</main>

<?php
incluirTemplate('footer');
?>