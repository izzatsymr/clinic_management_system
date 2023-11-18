<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Question;
use App\Models\Assessment;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssessmentQuestionsTest extends TestCase
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
    public function it_gets_assessment_questions()
    {
        $assessment = Assessment::factory()->create();
        $questions = Question::factory()
            ->count(2)
            ->create([
                'assessment_id' => $assessment->id,
            ]);

        $response = $this->getJson(
            route('api.assessments.questions.index', $assessment)
        );

        $response->assertOk()->assertSee($questions[0]->question_text);
    }

    /**
     * @test
     */
    public function it_stores_the_assessment_questions()
    {
        $assessment = Assessment::factory()->create();
        $data = Question::factory()
            ->make([
                'assessment_id' => $assessment->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.assessments.questions.store', $assessment),
            $data
        );

        $this->assertDatabaseHas('questions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $question = Question::latest('id')->first();

        $this->assertEquals($assessment->id, $question->assessment_id);
    }
}
