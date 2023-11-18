<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Patient;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PatientTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_patients_list()
    {
        $patients = Patient::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.patients.index'));

        $response->assertOk()->assertSee($patients[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_patient()
    {
        $data = Patient::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.patients.store'), $data);

        $this->assertDatabaseHas('patients', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_patient()
    {
        $patient = Patient::factory()->create();

        $data = [
            'name' => $this->faker->text(255),
            'contact_no' => $this->faker->text(255),
            'address' => $this->faker->address,
            'email' => $this->faker->email,
            'emergency_contact' => $this->faker->text(255),
            'date_of_birth' => $this->faker->date,
            'gender' => \Arr::random(['male', 'female', 'other']),
            'medical_history' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.patients.update', $patient),
            $data
        );

        $data['id'] = $patient->id;

        $this->assertDatabaseHas('patients', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_patient()
    {
        $patient = Patient::factory()->create();

        $response = $this->deleteJson(route('api.patients.destroy', $patient));

        $this->assertModelMissing($patient);

        $response->assertNoContent();
    }
}
