<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Question;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuestionTest extends TestCase
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
    public function it_gets_questions_list()
    {
        $questions = Question::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.questions.index'));

        $response->assertOk()->assertSee($questions[0]->question_text);
    }

    /**
     * @test
     */
    public function it_stores_the_question()
    {
        $data = Question::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.questions.store'), $data);

        $this->assertDatabaseHas('questions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_question()
    {
        $question = Question::factory()->create();

        $data = [
            'question_text' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.questions.update', $question),
            $data
        );

        $data['id'] = $question->id;

        $this->assertDatabaseHas('questions', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_question()
    {
        $question = Question::factory()->create();

        $response = $this->deleteJson(
            route('api.questions.destroy', $question)
        );

        $this->assertModelMissing($question);

        $response->assertNoContent();
    }
}
