<?php

namespace App\Livewire\Project;

use Livewire\Component;
use Auth;
use App\Models\Project;
use App\Models\Content;

class ProjectList extends Component
{
    // dialog control
    public $showDialog = false;
    public $showDeleteDialog = false;

    public $selectedData = ['name', 'description'];
    public $selectedDeleteId;

    protected $rules = [
        'selectedData.name' => 'required'
    ];

    public function create()
    {
        $this->resetErrorBag();
        $this->selectedData = ['name', 'description'];
        $this->showDialog = true;
    }

    public function select($project_id)
    {
        $this->resetErrorBag();
        $this->selectedData = $this->projects->where('id', $project_id)->first()->toArray();
        $this->showDialog = true;
    }

    public function selectDelete($project_id)
    {
        $this->selectedDeleteId = $project_id;
        $this->showDeleteDialog = true;
    }

    public function submit ()
    {
        $this->validate();

        if (!isset($this->selectedData['user_id'])) {
            $this->selectedData['user_id'] = Auth::user()->id;
            $this->selectedData['sn'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 9);
            $this->selectedData['id'] = NULL;
        }

        Project::updateOrCreate(['id' => $this->selectedData['id']], $this->selectedData);
        $this->showDialog = false;
    }

    public function delete ()
    {
        Project::find($this->selectedDeleteId)->delete();
        Content::where('project_id', $this->selectedDeleteId)->delete();
        $this->showDeleteDialog = false;
    }

    public function gotoContent($sn)
    {
        return redirect()->intended(route('project.content-page', $sn));
    }

    public function getProjectsProperty()
    {
        return Project::where('user_id', Auth::user()->id)->get();
    }

    public function render()
    {
        return view('livewire.project.project-list')->extends('layouts.app');
    }
}
