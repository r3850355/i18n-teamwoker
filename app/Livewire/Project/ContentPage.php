<?php

namespace App\Livewire\Project;

use Livewire\Component;
use Auth;
use App\Models\Content;
use App\Models\Project;

class ContentPage extends Component
{
    public $project;

    // dialog control
    public $showDialog = false;
    public $showDeleteDialog = false;
    public $showImportDialog = false;

    public $selectedData = [];
    public $selectedDeleteId;

    protected $rules = [
        'selectedData.key' => 'required'
    ];

    protected $listeners = ['closeImportDialog'];

    public function openImportDialog()
    {
        $this->showImportDialog = true;
    }

    public function closeImportDialog()
    {
        $this->showImportDialog = false;
    }


    public function create()
    {
        $this->resetErrorBag();
        $this->selectedData = ['key', 'en_US', 'zh_TW', 'zh_CN', 'ja_JP'];
        $this->showDialog = true;
    }

    public function select($id)
    {
        $this->resetErrorBag();
        $this->selectedData = $this->contents->where('id', $id)->first()->toArray();
        $this->showDialog = true;
    }

    public function selectDelete($content_id)
    {
        $this->selectedDeleteId = $content_id;
        $this->showDeleteDialog = true;
    }

    public function delete ()
    {
        Content::find($this->selectedDeleteId)->delete();
        $this->showDeleteDialog = false;
    }

    public function submit()
    {
        $this->validate();

        if (!isset($this->selectedData['project_id'])) {
            $this->selectedData['project_id'] = $this->project->id;
            $this->selectedData['id'] = NULL;
        }
        
        Content::updateOrCreate(['id' => $this->selectedData['id']], $this->selectedData);
        $this->showDialog = false;
    }

    /**
     * 
     */


    public function mount($sn)
    {
        $project = Project::where('sn', $sn)->where('user_id', Auth::user()->id)->first();
        if (!$project) return redirect()->intended(route('project.project-list'));
        $this->project = $project;
    }

    public function getContentsProperty()
    {
        return Content::where('project_id', $this->project->id)->get();
    }

    public function render()
    {
        return view('livewire.project.content-page')->extends('layouts.app');;
    }
}
