<?php

namespace App\Livewire\Project\Components;

use Livewire\Component;
use App\Models\Content;

class ExportJsonDialog extends Component
{
    public $showExportDialog;
    public $project_id;

    public $exportLang = 'en_US';
    public $exportData = [];

    public function submit()
    {
        $contents = Content::where('project_id', $this->project_id)->get();
        $data = [];
        foreach ($contents as $content)
        {
            $data = array_merge($data, [$content['key'] => $content[$this->exportLang]]);
        }
        $this->exportData = json_encode($data, 320);
    }

    public function render()
    {
        return view('livewire.project.components.export-json-dialog');
    }
}
