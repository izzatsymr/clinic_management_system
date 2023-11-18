<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Assessment;

use App\Models\Patient;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssessmentTest extends TestCase
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
    public function it_gets_assessments_list()
    {
        $assessments = Assessment::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.assessments.index'));

        $response->assertOk()->assertSee($assessments[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_assessment()
    {
        $data = Assessment::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.assessments.store'), $data);

        $this->assertDatabaseHas('assessments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_assessment()
    {
        $assessment = Assessment::factory()->create();

        $patient = Patient::factory()->create();

        $data = [
            'patient_id' => $patient->id,
        ];

        $response = $this->putJson(
            route('api.assessments.update', $assessment),
            $data
        );

        $data['id'] = $assessment->id;

        $this->assertDatabaseHas('assessments', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_assessment()
    {
        $assessment = Assessment::factory()->create();

        $response = $this->deleteJson(
            route('api.assessments.destroy', $assessment)
        );

        $this->assertModelMissing($assessment);

        $response->assertNoContent();
    }
}
