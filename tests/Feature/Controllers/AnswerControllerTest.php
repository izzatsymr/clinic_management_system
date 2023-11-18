<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Answer;

use App\Models\Question;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnswerControllerTest extends TestCase
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
    public function it_displays_index_view_with_answers()
    {
        $answers = Answer::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('answers.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.answers.index')
            ->assertViewHas('answers');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_answer()
    {
        $response = $this->get(route('answers.create'));

        $response->assertOk()->assertViewIs('app.answers.create');
    }

    /**
     * @test
     */
    public function it_stores_the_answer()
    {
        $data = Answer::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('answers.store'), $data);

        $this->assertDatabaseHas('answers', $data);

        $answer = Answer::latest('id')->first();

        $response->assertRedirect(route('answers.edit', $answer));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_answer()
    {
        $answer = Answer::factory()->create();

        $response = $this->get(route('answers.show', $answer));

        $response
            ->assertOk()
            ->assertViewIs('app.answers.show')
            ->assertViewHas('answer');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_answer()
    {
        $answer = Answer::factory()->create();

        $response = $this->get(route('answers.edit', $answer));

        $response
            ->assertOk()
            ->assertViewIs('app.answers.edit')
            ->assertViewHas('answer');
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

        $response = $this->put(route('answers.update', $answer), $data);

        $data['id'] = $answer->id;

        $this->assertDatabaseHas('answers', $data);

        $response->assertRedirect(route('answers.edit', $answer));
    }

    /**
     * @test
     */
    public function it_deletes_the_answer()
    {
        $answer = Answer::factory()->create();

        $response = $this->delete(route('answers.destroy', $answer));

        $response->assertRedirect(route('answers.index'));

        $this->assertModelMissing($answer);
    }
}
