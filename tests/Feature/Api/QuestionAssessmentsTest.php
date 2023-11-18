<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Question;
use App\Models\Assessment;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuestionAssessmentsTest extends TestCase
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
    public function it_gets_question_assessments()
    {
        $question = Question::factory()->create();
        $assessment = Assessment::factory()->create();

        $question->assessments()->attach($assessment);

        $response = $this->getJson(
            route('api.questions.assessments.index', $question)
        );

        $response->assertOk()->assertSee($assessment->id);
    }

    /**
     * @test
     */
    public function it_can_attach_assessments_to_question()
    {
        $question = Question::factory()->create();
        $assessment = Assessment::factory()->create();

        $response = $this->postJson(
            route('api.questions.assessments.store', [$question, $assessment])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $question
                ->assessments()
                ->where('assessments.id', $assessment->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_assessments_from_question()
    {
        $question = Question::factory()->create();
        $assessment = Assessment::factory()->create();

        $response = $this->deleteJson(
            route('api.questions.assessments.store', [$question, $assessment])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $question
                ->assessments()
                ->where('assessments.id', $assessment->id)
                ->exists()
        );
    }
}
