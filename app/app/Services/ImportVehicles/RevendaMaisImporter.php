<?php

namespace App\Services\ImportVehicles;

use App\Services\ImportVehicles\Contracts\ImportVehicles;
use App\Services\ImportVehicles\Contracts\KeysNames;

class RevendaMaisImporter implements ImportVehicles
{
    public function getServiceName(): string
    {
        return 'RevendaMais';
    }

    public function getKeysNames(): KeysNames
    {
        return new KeysNames(
            codigo: 'codigoVeiculo',
            modelo: 'modelo',
            marca: 'marca',
            ano: 'ano',
            quilometragem: 'quilometragem',
            combustivel: 'tipoCombustivel',
            preco: 'precoVenda',
        );
    }

    public function getParsedFileContent(String $content): array
    {
        return json_decode(json_encode(simplexml_load_string($content)), true)['veiculos']['veiculo'];
    }
}
