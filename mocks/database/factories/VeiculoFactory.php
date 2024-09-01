<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Veiculo>
 */
class VeiculoFactory extends Factory
{
    private array $marcas = [
        'Chevrolet',
        'Fiat',
        'Ford',
        'Volkswagen',
        'Audi',
        'Mercedes-Benz',
        'Hyundai',
        'Jaguar',
        'Kia',
        'Nissan',
        'Renault',
        'Toyota',
        'Volvo',
        'Mitsubishi',
        'BMW',
        'Peugeot',
        'Citroen',
        'Ferrari',
        'Lamborghini',
        'Bugatti',
        'Cherry',
        'BYD',
    ];

    private array $modelos = [
        'Onix',
        'Cronos',
        'Fusion',
        'Gol',
        'Golf',
        'Siena',
        'Corsa',
        'Uno',
        'Celta',
        'Fiorino',
        'S10',
        'Civic',
        'Siena',
        'Cruze',
        'C3',
        'C4',
        'Kicks',
        'Mustang',
        'Camaro',
        'Jetta',
        'Ka',
        'Focus',
        'Fiesta',
    ];

    private array $versoes = [
        '1.0',
        '1.6',
        '2.0',
        '2.5',
        '3.0',
        '4.0',
        '5.0',
        '6.0',
        '1.0 Turbo',
        '1.6 Turbo',
        '2.0 Turbo',
        '2.5 Turbo',
        '3.0 Turbo',
        '4.0 Turbo',
        '5.0 Turbo',
        '6.0 Turbo',
        'LT',
        'LTZ',
        'Titanium',
        'Premium',
        'Premium Plus',
        'Plus',
    ];

    private array $cores = [
        'prata',
        'branco',
        'preto',
        'vermelho',
        'verde',
        'azul',
        'amarelo',
    ];

    private array $combustiveis = [
        'Gasolina',
        'Etanol',
        'Flex',
    ];

    private array $cambios = [
        'Manual',
        'Automático',
    ];

    private array $opcionais = [
        'Ar-condicionado',
        'Vidros eletronicos',
        'Alarme',
        'Trava eletrônica',
        'Banco de couro',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => $this->faker->biasedNumberBetween(max: 9999),
            'marca' => $this->faker->randomElement($this->marcas),
            'modelo' => $this->faker->randomElement($this->modelos),
            'ano' => $this->faker->biasedNumberBetween(min: 1990, max: 2025),
            'versao' => $this->faker->randomElement($this->versoes),
            'cor' => $this->faker->randomElement($this->cores),
            'quilometragem' => $this->faker->biasedNumberBetween(min: 0, max: 100000),
            'preco_venda' => $this->faker->numberBetween(1000, 10000),
            'ultima_atualizacao' => $this->faker->date(),
            'tipo_combustivel' => $this->faker->randomElement($this->combustiveis),
            'cambio' => $this->faker->randomElement($this->cambios),
            'portas' => $this->faker->numberBetween(2, 5),
            'opcionais' => implode(',', $this->faker->randomElements($this->opcionais, $this->faker->numberBetween(0, 4))),
        ];
    }
}
