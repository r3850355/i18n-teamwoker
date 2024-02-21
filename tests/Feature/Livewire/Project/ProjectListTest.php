<?php

namespace Tests\Feature\Livewire\Project;

use App\Livewire\Project\ProjectList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use App\Models\Project;
use App\Models\User;

class ProjectListTest extends TestCase
{
    use RefreshDatabase;
    
    private $user;
    public function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        $this->user = $user;
        $this->actingAs($user);
    }

    /** @test */
    public function renders_successfully()
    {
        Livewire::test(ProjectList::class)
            ->assertStatus(200);
    }

    /** @test */
    public function can_create()
    {
        Livewire::test(ProjectList::class)
            ->call('create')
            ->set('selectedData.name', 'test-name')
            ->set('selectedData.description', fake()->text())
            ->call('submit');
        
        $this->assertDatabaseHas('projects', ['name' => 'test-name']);
    }

    /** @test */
    public function can_edit()
    {
        $project = Project::factory()->create(['user_id' => $this->user->id]);

        Livewire::test(ProjectList::class)
            ->call('select', $project->id)
            ->set('selectedData.name', 'test-name')
            ->set('selectedData.description', fake()->text())
            ->call('submit');
        
        $this->assertDatabaseHas('projects', ['id' => $project->id, 'name' => 'test-name']);
    }

    /** @test */
    public function can_delete()
    {
        $project = Project::factory()->create(['user_id' => $this->user->id]);

        Livewire::test(ProjectList::class)
            ->call('selectDelete', $project->id)
            ->call('delete');
        
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

}
