<?php

namespace Cafeteria\Modelos;

class Postre extends Producto{
    public function precioFinal(int $cantidad): float {
        $total = $this->precioBase * $cantidad;

        if($cantidad > 3){
            $total = $total * 0.90;
        }

        return $total;
    }
}