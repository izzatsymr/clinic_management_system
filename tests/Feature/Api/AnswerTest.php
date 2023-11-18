<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Answer;

use App\Models\Question;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnswerTest extends TestCase
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
    public function it_gets_answers_list()
    {
        $answers = Answer::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.answers.index'));

        $response->assertOk()->assertSee($answers[0]->answer_text);
    }

    /**
     * @test
     */
    public function it_stores_the_answer()
    {
        $data = Answer::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.answers.store'), $data);

        $this->assertDatabaseHas('answers', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_answer()
    {
        $answer = Answer::factory()->create();

        $question = Question::factory()->create();

        $data = [
            'answer_text' => $this->faker->text(255),
            'question_id' => $question->id,
        ];

        $response = $this->putJson(route('api.answers.update', $answer), $data);

        $data['id'] = $answer->id;

        $this->assertDatabaseHas('answers', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_answer()
    {
        $answer = Answer::factory()->create();

        $response = $this->deleteJson(route('api.answers.destroy', $answer));

        $this->assertModelMissing($answer);

        $response->assertNoContent();
    }
}
