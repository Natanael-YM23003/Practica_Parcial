<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Cafeteria\Controladores\PedidoControlador;

$controlador = new PedidoControlador();
$controlador->cargarListado();