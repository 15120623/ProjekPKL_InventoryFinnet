<?php

namespace Database\Factories;

use App\Models\Formulir;
use Illuminate\Database\Eloquent\Factories\Factory;

class FormulirFactory extends Factory
{
    protected $model = Formulir::class;

    public function definition()
    {
        return [
            'status' => $this->faker->randomElement(['Active', 'No Active']),
            'response' => $this->faker->randomElement(['Accessible', 'Block', 'Error']),
            'domain' => $this->faker->domainName,
            'url' => $this->faker->url,
            'loc-a' => $this->faker->randomElement(['PROD', 'Development']),
            'loc-b' => $this->faker->randomElement(['On Prem', 'Cloud']),
            'dns-record' => $this->faker->text(50),
            'dns-formula' => $this->faker->text(50),
            'vapt' => $this->faker->randomElement(['Exclude', 'Include']),
            'credential' => $this->faker->text(20),
            'pentest' => $this->faker->randomElement(['Yes', 'No']),
            'date' => $this->faker->date(),
            'critical' => $this->faker->numberBetween(85, 150),
            'high' => $this->faker->numberBetween(50, 85),
            'medium' => $this->faker->numberBetween(25, 50),
            'low' => $this->faker->numberBetween(1, 25),
            'info' => $this->faker->text(50),
            'method' => $this->faker->randomElement(['Blackbox', 'Whitebox', 'Greybox']),
            'note' => $this->faker->text(50),
        ];
    }
}
