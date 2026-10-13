<?php

namespace Cafeteria\Modelos;

class Postre extends Producto
{
    public function precioFinal(int $cantidad): float
    {
        $precioFinal = $this->precioBase * $cantidad;
        if ($cantidad >= 3) {
            $precioFinal = $precioFinal * 0.90;
        }

        return $precioFinal;
    }
}
