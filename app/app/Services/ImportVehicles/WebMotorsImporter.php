<?php

namespace App\Services\ImportVehicles;

use App\Services\ImportVehicles\Contracts\ImportVehicles;
use App\Services\ImportVehicles\Contracts\KeysNames;

class WebMotorsImporter implements ImportVehicles
{
    public function getServiceName(): string
    {
        return 'WebMotors';
    }

    public function getKeysNames(): KeysNames
    {
        return new KeysNames(
            codigo: 'id',
            modelo: 'modelo',
            marca: 'marca',
            ano: 'ano',
            quilometragem: 'km',
            combustivel: 'combustivel',
            preco: 'preco',
        );
    }

    public function getParsedFileContent(string $content): array
    {
        return json_decode($content)->veiculos;
    }
}
