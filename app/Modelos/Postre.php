<?php

namespace Cafeteria\Modelos;
use Cafeteria\Interface\Promocionable;
use Cafeteria\Traits\FormateadorMoneda;

class Postre extends Producto implements Promocionable
{
    use FormateadorMoneda;

    private float $descuento = 0.0;

    public function precioFinal(int $cantidad): float
    {
        return $this->precioBase * $cantidad * (1 - $this->descuento / 100);
    }

    public function aplicarDescuento(float $porcentaje): void
    {
        $this->descuento = $porcentaje;
    }

    public function obtenerPrecioFormateado(int $cantidad): string
    {
        $total = $this->precioFinal($cantidad);

        return $this->formatearPrecio($total);
    }
}
