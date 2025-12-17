<?php

namespace App;

class Propiedad extends ActiveRecord
{
    public string $creado;
    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

    public function __construct(
        public ?int $id = null,
        public ?string $titulo = null,
        public ?float $precio = null,
        public ?string $imagen = null,
        public ?string $descripcion = null,
        public ?int $habitaciones = null,
        public ?int $wc = null,
        public ?int $estacionamiento = null,
        public ?int $vendedorId = null
    ) {
        $this->creado = date('Y/m/d');
    }
}
