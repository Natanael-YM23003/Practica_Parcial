<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Cafeteria\Controladores\PedidoControlador;

$controlador = new PedidoControlador();

$error = '';
$dato = [];

$controlador->manejarPeticion();

include __DIR__ . '/../vistas/formulario.php';
