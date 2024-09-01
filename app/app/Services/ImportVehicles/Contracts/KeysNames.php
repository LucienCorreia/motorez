<?php

namespace App\Services\ImportVehicles\Contracts;

class KeysNames
{
    public function __construct(
        public String $codigo,
        public string $modelo,
        public string $marca,
        public string $ano,
        public string $combustivel,
        public string $quilometragem,
        public string $preco,
    ) {
    }
}
