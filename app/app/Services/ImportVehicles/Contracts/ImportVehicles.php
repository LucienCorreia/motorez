<?php

namespace App\Services\ImportVehicles\Contracts;

interface ImportVehicles
{
    public function getServiceName(): string;

    public function getKeysNames(): KeysNames;

    public function getParsedFileContent(String $content): array;
}
