<?php

namespace Cafeteria\Interface;

interface Promocionable {
    public function aplicarDescuento(float $porcentaje): void;
}