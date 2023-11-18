<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Answer;
use App\Models\Question;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuestionAnswersTest extends TestCase
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
    public function it_gets_question_answers()
    {
        $question = Question::factory()->create();
        $answers = Answer::factory()
            ->count(2)
            ->create([
                'question_id' => $question->id,
            ]);

        $response = $this->getJson(
            route('api.questions.answers.index', $question)
        );

        $response->assertOk()->assertSee($answers[0]->answer_text);
    }

    /**
     * @test
     */
    public function it_stores_the_question_answers()
    {
        $question = Question::factory()->create();
        $data = Answer::factory()
            ->make([
                'question_id' => $question->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.questions.answers.store', $question),
            $data
        );

        $this->assertDatabaseHas('answers', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $answer = Answer::latest('id')->first();

        $this->assertEquals($question->id, $answer->question_id);
    }
}
