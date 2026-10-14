<?php

namespace Cafeteria\Controladores;

use Cafeteria\Enums\Tamano;
use Cafeteria\Excepciones\PedidoInvalidoException;

class PedidoControlador
{
    public function manejarPeticion()
    {
        $error = '';
        $dato = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dato = $_POST;

            try {
                $cliente = trim($_POST['cliente'] ?? '');
                $tipo = $_POST['tipo'] ?? '';
                $producto = trim($_POST['producto'] ?? '');
                $precioBase = filter_var($_POST['precioBase'] ?? null, FILTER_VALIDATE_FLOAT);
                $cantidad = filter_var($_POST['cantidad'] ?? null, FILTER_VALIDATE_INT);
                $tamano = $_POST['tamano'] ?? '';

                if (empty($cliente) || empty($producto)) {
                    throw new PedidoInvalidoException("Los campos nombre y producto no pueden ir vacios");
                }
                if ($tipo === 'bebida' && empty($tamano)) {
                    throw new PedidoInvalidoException("Las bebidas requieren de un tamano");
                }
                if ($precioBase === false || $precioBase <= 0) {
                    throw new PedidoInvalidoException("El precio base no puede ser texto ni menor a 0");
                }
                if ($tipo === 'postre' && !empty($tamano)) {
                    throw new PedidoInvalidoException("Los postres no llevan tamaño.");
                }
                if ($cantidad === false || $cantidad <= 0 || $cantidad > 20) {
                    throw new PedidoInvalidoException("La cantidad no puede ser texto, ni menor o igual a 0 ni mayor a 20");
                }
                // Iniciamos la sesión si no está activa
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }



                if ($tipo === 'bebida') {
                    $productoObj = new \Cafeteria\Modelos\Bebida(
                        $producto,
                        $precioBase,
                        Tamano::from($tamano)
                    );
                }
                else { 
                    $productoObj = new \Cafeteria\Modelos\Postre(
                        $producto,
                        $precioBase
                    );
                }

                if($productoObj instanceof \Cafeteria\Interface\Promocionable){
                    if($cantidad >= 3){
                        $productoObj->aplicarDescuento(10.0);
                    }
                }

                $_SESSION['pedidos'][] = [
                    'cliente' => $cliente,
                    'tipo' => $tipo,
                    'producto' => $productoObj->nombre,
                    'cantidad' => $cantidad,
                    'total' => $productoObj->precioFinal($cantidad)
                ];

                header('Location: listar.php');
                exit;
                    

            } catch (PedidoInvalidoException $e) {
                $error = $e->getMessage();
            }
        }
        include __DIR__ . '/../../vistas/formulario.php';
    }
    public function cargarListado() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $pedidos = $_SESSION['pedidos'] ?? [];

        include __DIR__ . '/../../vistas/listado.php';
    }
}
