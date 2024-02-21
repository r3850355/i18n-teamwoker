<?php

namespace Tests\Feature\Livewire\Project;

use App\Livewire\Project\ContentPage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Content;
use App\Models\User;

class ContentPageTest extends TestCase
{
    use RefreshDatabase;
    
    private $user;
    private $project;

    public function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        $this->user = $user;
        $this->project = Project::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);
    }

    /** @test */
    public function renders_successfully()
    {
        Livewire::test(ContentPage::class, ['sn' => $this->project->sn])
            ->assertStatus(200);
    }

    /** @test */
    public function can_create()
    {
        $data = [
            'key' => 'msg.hello',
            'en_US' => 'Hello',
            'zh_TW' => '你好',
        ];

        Livewire::test(ContentPage::class, ['sn' => $this->project->sn])
            ->call('create')
            ->set('selectedData', $data)
            ->call('submit');

        $this->assertDatabaseHas('contents', ['project_id' => $this->project->id, 'key' => 'msg.hello']);
    }

    /** @test */
    public function can_edit()
    {

        $content = Content::factory()->create(['project_id' => $this->project->id]);

        Livewire::test(ContentPage::class, ['sn' => $this->project->sn])
            ->call('select', $content->id)
            ->set('selectedData.en_US', 'Hola')
            ->call('submit');

        $this->assertDatabaseHas('contents', ['id' => $content->id, 'en_US' => 'Hola']);
    }


    /** @test */
    public function can_delete()
    {

        $content = Content::factory()->create(['project_id' => $this->project->id]);

        Livewire::test(ContentPage::class, ['sn' => $this->project->sn])
            ->call('selectDelete', $content->id)
            ->call('delete');

        $this->assertDatabaseMissing('contents', ['id' => $content->id]);
    }
}
