<?php

namespace Database\Factories;

use App\Models\Assessment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssessmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Assessment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'patient_id' => \App\Models\Patient::factory(),
        ];
    }
}
