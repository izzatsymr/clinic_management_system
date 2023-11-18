<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Assessment;

use App\Models\Patient;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssessmentControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_assessments()
    {
        $assessments = Assessment::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('assessments.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.assessments.index')
            ->assertViewHas('assessments');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_assessment()
    {
        $response = $this->get(route('assessments.create'));

        $response->assertOk()->assertViewIs('app.assessments.create');
    }

    /**
     * @test
     */
    public function it_stores_the_assessment()
    {
        $data = Assessment::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('assessments.store'), $data);

        $this->assertDatabaseHas('assessments', $data);

        $assessment = Assessment::latest('id')->first();

        $response->assertRedirect(route('assessments.edit', $assessment));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_assessment()
    {
        $assessment = Assessment::factory()->create();

        $response = $this->get(route('assessments.show', $assessment));

        $response
            ->assertOk()
            ->assertViewIs('app.assessments.show')
            ->assertViewHas('assessment');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_assessment()
    {
        $assessment = Assessment::factory()->create();

        $response = $this->get(route('assessments.edit', $assessment));

        $response
            ->assertOk()
            ->assertViewIs('app.assessments.edit')
            ->assertViewHas('assessment');
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

        $response = $this->put(route('assessments.update', $assessment), $data);

        $data['id'] = $assessment->id;

        $this->assertDatabaseHas('assessments', $data);

        $response->assertRedirect(route('assessments.edit', $assessment));
    }

    /**
     * @test
     */
    public function it_deletes_the_assessment()
    {
        $assessment = Assessment::factory()->create();

        $response = $this->delete(route('assessments.destroy', $assessment));

        $response->assertRedirect(route('assessments.index'));

        $this->assertModelMissing($assessment);
    }
}
