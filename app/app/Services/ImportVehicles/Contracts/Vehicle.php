<?php

namespace App\Services\ImportVehicles\Contracts;

readonly class Vehicle
{
    public function __construct(
        public string $codigo,
        public string $fornecedor,
        public string $modelo,
        public string $marca,
        public string $ano,
        public string $combustivel,
        public string $preco,
        public string $quilometragem,
    ) {
    }
}
