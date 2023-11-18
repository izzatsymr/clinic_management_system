<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date_time' => $this->faker->dateTime,
            'status' => 'scheduled',
            'note' => $this->faker->text(25),
            'patient_id' => \App\Models\Patient::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
