<?php

namespace App\Services\ImportVehicles;

use App\Models\Veiculo;
use App\Services\ImportVehicles\Contracts\ImportVehicles;
use App\Services\ImportVehicles\Contracts\TypeFileEnum;
use App\Services\ImportVehicles\Contracts\Vehicle;
use Illuminate\Http\File;

class Importer
{
    public function __construct(private ImportVehicles $importVehicles)
    {
    }

    public function import(String $content): void
    {
        $data = $this->importVehicles->getParsedFileContent($content);

        foreach ($data as $vehicle) {
            $vehicle = (object) $vehicle;
            $keysNames = $this->importVehicles->getKeysNames();

            $vehicle = new Vehicle(
                modelo: $vehicle->{$keysNames->modelo},
                marca: $vehicle->{$keysNames->marca},
                ano: $vehicle->{$keysNames->ano},
                combustivel: $vehicle->{$keysNames->combustivel},
                preco: $vehicle->{$keysNames->preco},
                quilometragem: $vehicle->{$keysNames->quilometragem},
                codigo: $vehicle->{$keysNames->codigo},
                fornecedor: $this->importVehicles->getServiceName(),
            );

            Veiculo::updateOrCreate([
                'codigo' => $vehicle->codigo,
                'fornecedor' => $this->importVehicles->getServiceName(),
            ], [
                'modelo' => $vehicle->modelo,
                'marca' => $vehicle->marca,
                'ano' => $vehicle->ano,
                'combustivel' => $vehicle->combustivel,
                'preco' => $vehicle->preco,
                'quilometragem' => $vehicle->quilometragem,
            ]);
        }
    }
}
