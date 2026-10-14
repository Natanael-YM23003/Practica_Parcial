<?php

namespace Cafeteria\Traits;

trait FormateadorMoneda {
    public function formatearPrecio(float $monto): string {
        return '$' . number_format($monto, 2);
    }
}