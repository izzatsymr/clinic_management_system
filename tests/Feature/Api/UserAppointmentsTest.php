<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Appointment;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserAppointmentsTest extends TestCase
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
    public function it_gets_user_appointments()
    {
        $user = User::factory()->create();
        $appointments = Appointment::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(
            route('api.users.appointments.index', $user)
        );

        $response->assertOk()->assertSee($appointments[0]->note);
    }

    /**
     * @test
     */
    public function it_stores_the_user_appointments()
    {
        $user = User::factory()->create();
        $data = Appointment::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.appointments.store', $user),
            $data
        );

        $this->assertDatabaseHas('appointments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $appointment = Appointment::latest('id')->first();

        $this->assertEquals($user->id, $appointment->user_id);
    }
}
