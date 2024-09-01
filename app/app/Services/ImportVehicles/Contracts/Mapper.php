<?php

namespace App\Services\ImportVehicles\Contracts;

interface Mapper
{
    public function parse(): array;
}
